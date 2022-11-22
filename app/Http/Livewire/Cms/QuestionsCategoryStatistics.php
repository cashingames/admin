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
            },'total')->label('Total Number Questions'),
           
            Column::callback(['id'], function ($id) {
                return Category::find($id)->unPublishedQuestions();
            }, 'unpublished')->label('Number of UnPublished Questions'),

            Column::callback(['id'], function ($id) {
                return Category::find($id)->easyQuestions();
            }, 'easy')->label('Number of Easy Questions'),

            Column::callback(['id'], function ($id) {
                return Category::find($id)->mediumQuestions();
            }, 'medium')->label('Number of Medium Questions'),

            Column::callback(['id'], function ($id) {
                return Category::find($id)->hardQuestions();
            }, 'hard')->label('Number of Hard Questions'),

            Column::callback(['id'], function ($id) {
                return Category::find($id)->publishedQuestions();
            }, 'published')->label('Number of Published Questions'),

        ];
    }
}
