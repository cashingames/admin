<?php

namespace App\Http\Livewire\Gaming;

use App\Models\Live\Category;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use App\Models\Live\Trivia;
use Illuminate\Support\Carbon;


class TriviaTable extends LivewireDatatable
{

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

                Column::name('point_eligibility')
                    ->label('Points Required'),

                Column::name('game_duration')
                    ->label('Game Duration (Seconds)'),

                Column::name('start_time')
                    ->label('Start Time'),

                Column::name('end_time')
                    ->label('End Time'),

                Column::callback(['start_time', 'end_time'], function ($start_time, $end_time) {
                    if (($start_time <= Carbon::now('Africa/Lagos')) &&
                        ($end_time > Carbon::now('Africa/Lagos'))
                    ) {
                        return 'Active';
                    }
                    return 'Expired';
                })->label('Status')->filterable(),

                Column::name('created_at')
                    ->label('Date Created'),

            ];
    }
}
