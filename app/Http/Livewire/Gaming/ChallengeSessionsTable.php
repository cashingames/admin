<?php

namespace App\Http\Livewire\Gaming;

use App\Models\Live\ChallengeGameSession;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use App\Models\Live\User;
use App\Models\Live\Category;
use App\Models\Live\Challenge;
use Mediconesystems\LivewireDatatables\DateColumn;

class ChallengeSessionsTable extends LivewireDatatable
{
    public function builder()
    {
        return ChallengeGameSession::query();
    }

    public function columns()
    {
        return
            [
                NumberColumn::name('id')
                    ->label('ID'),

                Column::callback(['user_id'], function ($user_id) {
                    $user = User::where('id', $user_id)->first();
                    if ($user == null) {
                        return ' ';
                    }
                    return $user->username;
                }, 'username')->label('Username')->searchable()->filterable(),

                Column::callback(['challenge_id'], function ($challenge_id) {
                    $challenge = Challenge::where('id', $challenge_id)->first();
                    if ($challenge == null) {
                        return ' ';
                    }
                    return $challenge->id;
                })->label('Challenge Id')->searchable()->filterable(),

                Column::callback(['category_id'], function ($category_id) {
                    $subcategory = Category::where('id', $category_id)->first();
                    return $subcategory->name;
                })->label('Subcategory')->searchable()->filterable(),

                Column::name('state')
                    ->label('State'),

                Column::name('start_time')
                    ->label('Start Time'),

                Column::name('end_time')
                    ->label('End Time'),
                    
                DateColumn::name('created_at')->label('Date Created')->filterable(),

                DateColumn::name('updated_at')->label('Date Edited')->filterable(),

            ];
    }
}
