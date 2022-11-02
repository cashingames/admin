<?php

namespace App\Http\Livewire\Gaming\Staking;

use App\Models\Live\Category;
use App\Models\Live\GameSession;

use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;

class StakersTable extends LivewireDatatable
{
    public function builder()
    {
        $livedb = config('database.connections.mysqllive.database');

        $query = GameSession::query()
            ->select(
                "game_sessions.correct_count as correct_count",
                "game_sessions.points_gained as points_gained",
                "game_sessions.created_at as played_at",
                "live_stakings.amount_won as amount_won"
            )
            ->join("{$livedb}.exhibition_stakings as live_es", "live_es.game_session_id", "=", "game_sessions.id")
            ->join("{$livedb}.stakings as live_stakings", "live_stakings.id", "=", "live_es.staking_id")
            ->join("{$livedb}.users as live_users", "live_users.id", "=", "game_sessions.user_id");

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

                Column::name('live_stakings.odd_applied_during_staking')
                    ->label('Odd Applied At Staking'),

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

                Column::callback(['category_id'], function ($category_id) {
                    return Category::find($category_id)->name;
                })->label('Subcategory')->filterable(),

                NumberColumn::name('correct_count')
                    ->label('Correct Count'),

                NumberColumn::name('points_gained')
                    ->label('Points Gained'),

                DateColumn::name('created_at')
                    ->label('Played At')
                    ->filterable()
                    ->searchable()
                    ->defaultSort('desc'),

                DateColumn::name('live_users.created_at')
                    ->label('Joined On')
                    ->filterable()
                    ->searchable(),
            ];
    }
}
