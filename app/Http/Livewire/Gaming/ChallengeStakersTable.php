<?php

namespace App\Http\Livewire\Gaming;

use App\Models\Live\ChallengeGameSession;

use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;


class ChallengeStakersTable extends LivewireDatatable
{
    public function builder()
    {
        $livedb = config('database.connections.mysqllive.database');

        $query = ChallengeGameSession::query()
            ->select(
                "challenge_game_sessions.correct_count as correct_count",
                "challenge_game_sessions.points_gained as points_gained",
                "challenge_game_sessions.created_at as played_at",
                "live_stakings.amount_won as amount_won"
            )
          
            ->leftJoin("{$livedb}.challenge_stakings as live_cs",  function ($join){
                $join->on("live_cs.challenge_id", '=', "challenge_game_sessions.challenge_id");
                $join->on("live_cs.user_id" ,'=', "challenge_game_sessions.user_id");
            })
            ->leftJoin("{$livedb}.stakings as live_stakings", "live_stakings.id", "=", "live_cs.staking_id")
            ->leftJoin("{$livedb}.users as live_users", "live_users.id", "=", "challenge_game_sessions.user_id");

        return $query;
    }

    public function columns()
    {
        return
            [
                NumberColumn::name('live_stakings.amount_won')
                    ->label('Amount Won'),

                NumberColumn::name('live_stakings.amount_staked')
                    ->label('Amount Staked'),
                
                Column::name('live_cs.challenge_id')
                    ->label('Challenge Id')
                    ->filterable()
                    ->searchable(),

                Column::name('live_users.username')
                    ->label('Username')
                    ->filterable()
                    ->searchable(),

                Column::name('live_users.phone_number')
                    ->label('Phone Number')
                    ->filterable()
                    ->searchable(),

                Column::name('live_users.email')
                    ->label('Email')
                    ->filterable()
                    ->searchable(),

                NumberColumn::name('correct_count')
                    ->label('Correct Count'),

                NumberColumn::name('points_gained')
                    ->label('Points Gained'),

                Column::name('created_at')
                    ->label('Played At')
                    ->filterable()
                    ->searchable(),

                Column::name('live_users.created_at')
                    ->label('Joined On')
                    ->filterable()
                    ->searchable(),
            ];
    }
}
