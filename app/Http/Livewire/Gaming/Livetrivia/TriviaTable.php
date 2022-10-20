<?php

namespace App\Http\Livewire\Gaming\Livetrivia;

use App\Models\Live\Category;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use App\Models\Live\Trivia;
use Illuminate\Support\Carbon;


class TriviaTable extends LivewireDatatable
{
    public $model = Trivia::class;

    public function builder()
    {
        return Trivia::query();
    }

    public function columns()
    {
        return
            [
                NumberColumn::name('id')
                    ->label('ID'),
                Column::name('name')
                    ->searchable()
                    ->filterable(),

                Column::callback(['category_id'], function ($category_id) {
                    return Category::where('id', $category_id)->first()->name;
                })->label('SubCategory')
                    ->searchable()
                    ->filterable(),

                Column::name('grand_price')
                    ->label('Grand Prize'),

                Column::name('point_eligibility')
                    ->label('Points Required'),

                Column::name('game_duration')
                    ->label('Game Duration (Seconds)'),

                Column::name('question_count')
                    ->label('Number of Questions'),

                DateColumn::callback(['start_time'], function ($start_time) {
                    return Carbon::parse($start_time)->setTimezone('Africa/Lagos');
                })->label('Start Time')->filterable(),

                DateColumn::callback(['end_time'], function ($end_time) {
                    return Carbon::parse($end_time)->setTimezone('Africa/Lagos');
                })->label('End Time')->filterable(),

                Column::callback(['start_time', 'end_time'], function ($start_time, $end_time) {
                    if ((Carbon::parse($start_time)->setTimezone('Africa/Lagos') <= Carbon::now('Africa/Lagos')) &&
                        (Carbon::parse($end_time)->setTimezone('Africa/Lagos') > Carbon::now('Africa/Lagos'))
                    ) {
                        return 'Active';
                    }
                    return 'Closed';
                })->label('Status')->filterable(),

                BooleanColumn::name('is_published')
                ->label('Published')
                ->filterable(),

                DateColumn::name('created_at')->label('Date Created')->filterable(),
               
                DateColumn::name('updated_at')->label('Date Edited')->filterable(),
                
                Column::callback(['id','is_published'], function ($id,$is_published) {
                    return view('gaming.livetrivia.trivia-table-actions', ['id' => $id, 'is_published'=>$is_published]);
                })->unsortable(),

            ];
    }
}
