<?php

namespace App\Http\Livewire\Cms;

use App\Models\Live\Category;
use App\Models\Live\CategoryQuestion;
use App\Models\Live\Question;
use App\Models\Live\Option;
use App\Models\Live\GameArk\Category as GameArkCategory;
use App\Models\Live\GameArk\CategoryQuestion as GameArkCategoryQuestion;
use App\Models\Live\GameArk\Question as GameArkQuestion;
use App\Models\Live\GameArk\Option as GameArkOption;
use App\Models\Question as AdminQuestion;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class UploadQuestions extends Component
{
    use WithFileUploads;
    public $file;
    public $category;
    public $categories;
    public $info;

    public $appDestination;
    public function mount()
    {
        $this->categories = Category::where('category_id', '>', 0)->get();
        $this->info = '';
        $this->appDestination = ' ';
    }
    public function upload()
    {

        $this->validate([
            'file' => 'required|mimes:xlsx, csv, xls'
        ]);

        $this->file->storeAs('questions', 'questionFile.xlsx');

        $inputFileName = storage_path('app/questions/questionFile.xlsx');

        $reader = IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(TRUE);
        $spreadsheet = $reader->load($inputFileName);

        foreach ($spreadsheet->getAllSheets() as $currentSheet) {

            $this->readWorkSheet($currentSheet);
        }
    }

    private function readWorkSheet(Worksheet $workSheet)
    {
        $category = null;
        if ($this->appDestination == "GameArk") {
            $category = GameArkCategory::where('name', $this->category)->first();
        } else {
            $category = Category::where('name', $this->category)->first();
        }

        if ($category == null) {
            $this->info = "Category cannot be found";
            return;
        }

        $highestRow = $workSheet->getHighestRow(); // e.g. 10
        for ($i = 2; $i <= $highestRow; $i++) {

            $level = trim($workSheet->getCell([1, $i])->getValue());
            if ($level == '' || ctype_space($level)) {
                $this->info = "Row " . $i . " level is empty \n";
                continue;
            }

            $label = trim($workSheet->getCell([2, $i])->getValue());
            if ($label == '' || ctype_space($label)) {
                $this->info = "Row " . $i . " question is empty \n";
                continue;
            }

            $answer = trim($workSheet->getCell([7, $i])->getValue());
            if ($answer == '' || ctype_space($answer)) {
                $this->info = "Row " . $i . " answer is empty \n";
                continue;
            }

            $question = null;

            if ($this->appDestination == "GameArk") {
                $question = new GameArkQuestion;
            } else {
                $question = new Question;
            }

            $question->game_type_id = 2;
            $question->level = strtolower($level);
            $question->label = $label;
            $question->is_published = true;

            $options = [];
            $hasCorrectAnswer = false;

            for ($j = 3; $j <= 6; $j++) {
                $optionLabel = trim($workSheet->getCell([$j, $i])->getValue());

                if (ctype_space($optionLabel) || $optionLabel == '') {
                    // echo "Option on R".$i."C".$j." is empty \n";
                    continue;
                }

                $isCorrect = $optionLabel == $answer;
                if ($isCorrect) {
                    $hasCorrectAnswer = true;
                }

                $option = null;

                if ($this->appDestination == "GameArk") {
                    $option = new GameArkOption;
                } else {
                    $option = new Option;
                }

                $option->title = $optionLabel;
                $option->is_correct = $isCorrect;

                if ($option)

                    array_push($options, $option);
            }

            if ($hasCorrectAnswer) {

                $categoryQuestion = null;

                if ($this->appDestination == "GameArk") {
                    $categoryQuestion = new GameArkCategoryQuestion;
                } else {
                    $categoryQuestion = new CategoryQuestion;
                }

                $adminQuestion = new AdminQuestion;

                DB::transaction(function () use ($question, $options) {
                    $question->save();
                    $question->options()->saveMany($options);
                });
                $categoryQuestion->category_id = $category->id;
                $categoryQuestion->question_id = $question->id;

                $adminQuestion->user_id = auth()->user()->id;
                $adminQuestion->question_id = $question->id;
                $categoryQuestion->save();

                if ($this->appDestination == "Cashingames") {
                    $adminQuestion->app_destination = "cashingames";
                } else {
                    $adminQuestion->app_destination = "gameark";
                }

                $adminQuestion->save();
                $this->info = "Upload Complete";
            } else {
                $this->info = "R" . $i . " does not have a correct answer \n";
                continue;
            }
        }
    }

    public function updated()
    {
        $this->info = " ";
    }

    public function updatedAppDestination()
    {
        if ($this->appDestination == "GameArk") {
            $this->categories = GameArkCategory::where('category_id', '>', 0)->get();
        }
        if ($this->appDestination == "Cashingames") {
            $this->categories = Category::where('category_id', '>', 0)->get();
        }
    }
    public function render()
    {
        return view('livewire.cms.upload-questions');
    }
}
