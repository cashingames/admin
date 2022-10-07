<?php

namespace App\Http\Livewire\Modals;

use App\Models\Live\Question;
use App\Models\Live\Category;
use App\Models\Live\Option;
use App\Models\QuestionsReviewLog;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Question as AdminQuestion;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class EditQuestion extends ModalComponent
{
    public $question;
    public $subcategories;
    public $addOption, $editSubcategory;
    public $newOptionIndex = -1;


    public function mount($question)
    {
        $this->question = Question::find($question);
        $this->subcategories = Category::where('category_id', '>', 0)->get();
        $this->addOption = false;
        $this->editSubcategory = false;
    }

    public function editQuestion(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'question' => 'required',
            'level' => 'required',
            'selectedSubcategories' => 'nullable',
        ]);
        $correctOptions = array();

        foreach ($request->option as $o) {
            $correctOptions[] = $o['is_correct'];
        }

        $hasDuplicateCorrectAnswers = $this->has_duplicate_correct_options($correctOptions);

        $validator->after(function ($validator) use ($hasDuplicateCorrectAnswers) {
            if ($hasDuplicateCorrectAnswers) {
                $validator->errors()->add(
                    'correctOptions',
                    'A question should not have more than one correct option'
                );
            }
        });

        if ($validator->fails()) {
            return redirect()->to('/cms/questions/unreviewed')->withErrors($validator);
        }

        $question = Question::find($request->question_id);
        $question->label = $request->question;
        $question->level = $request->level;

        if ($request->has('selectedSubcategories')) {
            $questionCategories = $question->categories()->get()->pluck('categories_questions.category_id')->toArray();

            if (count($questionCategories) > count($request->selectedSubcategories)) {
                $categoryQuestions =  $question->categories()->whereNotIn('categories_questions.category_id', $request->selectedSubcategories)->get();
               
                foreach ($categoryQuestions  as $c) {
                    $question->categories()->detach($c->pivot->category_id);
                  
                }
            }
            foreach ($request->selectedSubcategories as $subcategory) {
                $findCategory = DB::connection('mysqllive')->table('categories_questions')
                    ->where('question_id', $question->id)->where('category_id', $subcategory)
                    ->first();

                if ($findCategory == null) {
                    $question->categories()->attach($subcategory);
                }
            
            }
        }

        $options = $question->options()->get();

        foreach ($options as $key => $_option) {
            $_option->title = $request->option[$key]['title'];

            if ($request->option[$key]['is_correct'] === 'yes') {
                $_option->is_correct = true;
            } else {
                $_option->is_correct = false;
            }
            $_option->save();
        }

        if ($request->has('newOption')) {
            foreach ($request->newOption as $key => $o) {
                $newOption = new Option;
                $newOption->question_id = $question->id;
                $newOption->title = $request->newOption[$key]['title'];

                if ($request->newOption[$key]['is_correct'] === 'yes') {
                    $newOption->is_correct = true;
                } else {
                    $newOption->is_correct = false;
                }
                $newOption->save();
            }
        }

        $question->save();

        AdminQuestion::where('question_id', $question->id)
            ->update([
                'deleted_at' => null, 'published_at' => null,
                'approved_at' => null, 'rejected_at' => null
            ]);

        QuestionsReviewLog::create(['question_id' => $question->id, 'review_type' => 'EDITED']);

        return redirect()->to('/cms/questions/unreviewed');
    }

    public function shouldAddOption()
    {
        $this->addOption = true;
        $this->newOptionIndex += 1;
    }

    public function  shouldEditSubcategory()
    {
        $this->editSubcategory ?
            $this->editSubcategory = false
            : $this->editSubcategory = true;
    }

    public function render()
    {
        return view('livewire.modals.edit-question');
    }

    private function has_duplicate_correct_options($array)
    {
        if (count(array_keys($array, "yes")) > 1) {
            return true;
        } else {
            return false;
        }
    }
}
