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
    public $perPage = 100;
    public $persistPerPage = false;

    public function builder()
    {

        return Trivia::query()
            ->join('categories', 'categories.id', 'trivias.category_id')
            ->join('contests', 'contests.id', 'trivias.contest_id');
    }

    public function columns()
    {
        return
            [
                Column::index($this),

                Column::name('name')
                    ->searchable()
                    ->filterable(),

                Column::name('categories.name')
                    ->label('SubCategory')
                    ->searchable()
                    ->filterable(),

                Column::name('grand_price'),

                Column::name('entry_fee'),

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

                Column::callback(['id', 'is_published'], function ($id, $is_published) {
                    return view('gaming.livetrivia.trivia-table-actions', ['id' => $id, 'is_published' => $is_published]);
                })->unsortable(),

            ];
    }
}
