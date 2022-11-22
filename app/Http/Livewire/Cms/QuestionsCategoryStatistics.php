<?php

namespace App\Http\Livewire\Cms;

use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use App\Models\Live\Category;
use App\Models\Live\CategoryQuestion;
use App\Models\Live\Question;

class QuestionsCategoryStatistics extends LivewireDatatable
{   

    public function builder()
    {   
        return Category::query()->where('category_id', '!=', 0);
      
    }

    public function columns()
    {
        return
        [   
            Column::name('name')
            ->label('Subcategory')
            ->filterable(),

            Column::callback(['id'], function ($id) {
                return Category::find($id)->questions()->count();
            },'total')->label('Total Questions Count'),
           
            Column::callback(['id'], function ($id) {
                return Category::find($id)->unPublishedQuestions();
            }, 'unpublished')->label('UnPublished Questions Count'),

            Column::callback(['id'], function ($id) {
                return Category::find($id)->publishedQuestions();
            }, 'published')->label('Published Questions Count'),

            Column::callback(['id'], function ($id) {
                return Category::find($id)->easyQuestions();
            }, 'easy')->label('Easy Questions Count'),

            Column::callback(['id'], function ($id) {
                return Category::find($id)->mediumQuestions();
            }, 'medium')->label('Medium Questions Count'),

            Column::callback(['id'], function ($id) {
                return Category::find($id)->hardQuestions();
            }, 'hard')->label('Hard Questions Count'),

          
        ];
    }
}
