<?php

namespace App\Http\Livewire\Gaming;

use App\Models\Live\GameSession;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use App\Models\Live\User;
use App\Models\Live\Category;
use App\Models\Live\GameMode;
use App\Models\Live\Plan;
use Mediconesystems\LivewireDatatables\DateColumn;

class SessionsTable extends LivewireDatatable
{
    public function builder()
    {
        return GameSession::query();
    }

    public function columns()
    {
        return
            [
                NumberColumn::name('id')
                    ->label('ID'),

                Column::callback(['user_id'], function ($user_id) {
                    $user = User::where('id', $user_id)->first();
                    if ($user === null) {
                        return ' ';
                    }
                    return $user->username;
                })->label('Username')->searchable()->filterable(),

                Column::callback(['category_id'], function ($category_id) {
                    $subcategory = Category::where('id', $category_id)->first();
                    return $subcategory->name;
                })->label('Subcategory')->searchable()->filterable(),

                Column::callback(['game_mode_id'], function ($mode_id) {
                    $gameMode = GameMode::where('id', $mode_id)->first();
                    return $gameMode->name;
                })->label('Game Mode')->searchable()->filterable(),

                Column::callback(['plan_id'], function ($plan_id) {
                    $plan = Plan::where('id', $plan_id)->first();
                    if ($plan === null) {
                        return ' ';
                    }
                    return $plan->name;
                })->label('Plan')->searchable()->filterable(),

                Column::name('state')
                    ->label('State'),

                Column::name('start_time')
                    ->label('Start Time'),

                Column::name('end_time')
                    ->label('End Time'),
                
                DateColumn::name('created_at')->label('Date Created')->filterable(),

            ];
    }
}
