<?php

namespace App\Http\Livewire\Gaming\Challenge;

use App\Models\Live\Challenge;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use App\Models\Live\User;
use App\Models\Live\Category;

class ChallengesUserDataTable extends LivewireDatatable
{
    public function builder()
    {
        return User::query()->has('challenges');
    }

    public function columns()
    {
        return
            [
                NumberColumn::name('id')
                    ->label('ID'),

                Column::name('username')
                    ->searchable()
                    ->filterable(),

                Column::name('email')
                    ->label('Email')
                    ->filterable()
                    ->searchable(),

                Column::name('phone_number')
                    ->label('Phone Number')
                    ->filterable()
                    ->searchable(),

                Column::callback(['id'], function ($id) {
                    $user = User::find($id);
                    return $user->initiatedChallenges()->count();
                },'challenger')->label('Number Of Challenges Initiated'),

                Column::callback(['id'], function ($id) {
                    $user = User::find($id);
                    return $user->recievedChallenges()->count();
                },'opponent')->label('Number Of Challenges Recieved'),

                Column::callback(['id'], function ($id) {
                    $user = User::find($id);
                    return $user->challengeGameSessions()->where('state','COMPLETED')->count();
                },'challenge_sessions')->label('Number Of Completed Challenges'),
            ];
    }
}
