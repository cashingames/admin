<?php

namespace App\Http\Livewire\Modals;

use App\Models\Question as AdminQuestion;
use App\Models\Live\Question as LiveQuestion;
use App\Models\Live\Category;
use App\Models\Live\GameType;
use App\Models\Live\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Question\Question;

class AddQuestion extends ModalComponent
{

    public $subcategories, $gameTypes, $selectedSubcategories;
    public $type, $level, $question, $keyWords, $questionHints, $hasSearched;

    public function mount()
    {
        $this->subcategories = Category::where('category_id', '>', 0)->get();
        $this->gameTypes = GameType::all();
        $this->selectedSubcategories = [];
        $this->questionHints = [];
        $this->hasSearched = false;
    }

    public function selectSubcategory($subcategory)
    {

        if (count(array_keys($this->selectedSubcategories, $subcategory)) == 0) {
            return array_push($this->selectedSubcategories, $subcategory);
        }
        $key = array_search($subcategory, $this->selectedSubcategories);
        unset($this->selectedSubcategories[$key]);
        $this->selectedSubcategories = array_values($this->selectedSubcategories);
        return;
    }

    public function addQuestion(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'question' => 'required',
            'level' => 'required',
            'options' => 'required',
            'isCorrect' => 'required',
            'selectedSubcategories' => 'required'
        ]);

        $hasDuplicateCorrectAnswers = $this->has_duplicate_correct_options($request->isCorrect);
        $hasNoCorrectAnswers = $this->has_no_correct_option($request->isCorrect);

        $validator->after(function ($validator) use ($hasDuplicateCorrectAnswers, $hasNoCorrectAnswers, $request) {
            if (in_array(null, $request->options, true)) {
                $validator->errors()->add(
                    'optionCount',
                    'Incomplete question options'
                );
            }
            if ($hasDuplicateCorrectAnswers) {
                $validator->errors()->add(
                    'correctOptions',
                    'A question should not have more than one correct option'
                );
            }
            if ($hasNoCorrectAnswers) {
                $validator->errors()->add(
                    'correctOptions',
                    'A question must have one correct option'
                );
            }
        });

        if ($validator->fails()) {
            return redirect()->to('/cms/questions/unreviewed')->withErrors($validator);
        }

        $question = new LiveQuestion;
        $gameType = GameType::where('display_name', $request->type)->first();
        $question->level = $request->level;
        $question->label = $request->question;
        $question->game_type_id = $gameType->id;
        $question->category_id = $request->selectedSubcategories[0];
        $question->created_by = auth()->user()->id;
        $question->save();

        $data = [];

        foreach ($request->selectedSubcategories as $subcategory) {
            $data[] = [
                'category_id' => $subcategory,
                'question_id' => $question->id,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::connection('mysqllive')->table('categories_questions')->insert($data);

        $adminQuestion = new AdminQuestion;
        $adminQuestion->user_id = auth()->user()->id;
        $adminQuestion->question_id = $question->id;
        $adminQuestion->save();

        $inputOptions = array_combine($request->options, $request->isCorrect);

        foreach ($inputOptions as $key => $value) {
            $option = new Option;
            $option->question_id = $question->id;
            $option->title = $key;
            if ($value === 'yes' || $value === null) {
                $option->is_correct = true;
            } else {
                $option->is_correct = false;
            }
            $option->save();
        }

        return redirect()->to('/cms/questions/unreviewed');
    }

    public function updated()
    {   
        if (strlen($this->keyWords) == 0) {
            $this->questionHints = array();
            $this->hasSearched = false;
        }

        if(!$this->hasSearched){
            if (strlen($this->keyWords) >= 20) {
                $this->query();
                $this->hasSearched = true;
            }
        }
        
    }

    public function query()
    {
        $hints = LiveQuestion::search($this->keyWords)->get();
        foreach ($hints as $hint) {
            if (!in_array($hint->label, $this->questionHints)) {
                $this->questionHints[] = $hint->label;
            }
        }
    }

    public function render()
    {
        return view('livewire.modals.add-question');
    }

    private function has_duplicate_correct_options($array)
    {
        if (count(array_keys($array, "yes")) > 1) {
            return true;
        } else {
            return false;
        }
    }

    private function has_no_correct_option($array)
    {
        if (count(array_keys($array, "yes")) < 1) {
            return true;
        } else {
            return false;
        }
    }
}
