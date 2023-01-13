<?php

namespace App\Http\Livewire\Gaming\Staking;

use App\Models\Live\Category;
use App\Models\Live\GameSession;
use Illuminate\Support\Carbon;

use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;

class StakersTable extends LivewireDatatable
{
    public $complex = true;
    public $persistPerPage = false;
    public $persistSearch = false;
    public $persistSort = false;
    public $persistFilters = false;
    const TIMEZONE = 'Africa/Lagos';

    public function builder()
    {
        return GameSession::query()
            ->select(
                "game_sessions.correct_count as correct_count",
                "game_sessions.points_gained as points_gained",
                "game_sessions.created_at as played_at",
                "live_stakings.amount_won as amount_won"
            )
            ->join("exhibition_stakings as live_es", "live_es.game_session_id", "=", "game_sessions.id")
            ->join("stakings as live_stakings", "live_stakings.id", "=", "live_es.staking_id")
            ->join("users as live_users", "live_users.id", "=", "game_sessions.user_id")
            ->join("categories", "categories.id", "=", "game_sessions.category_id");
    }

    public function columns()
    {
        return
            [
                Column::index($this),

                Column::name('game_sessions.id'),

                DateColumn::callback(['created_at'], function ($createdAt) {
                    return Carbon::parse($createdAt)->setTimezone(self::TIMEZONE);
                })->label('Played At')->filterable(),

                Column::name('live_users.username')->searchable(),

                Column::name('live_users.phone_number')->hideable(),

                Column::name('live_users.email')->hideable(),

                Column::name('live_stakings.odd_applied_during_staking')
                    ->label('Odds'),

                NumberColumn::name('correct_count'),

                NumberColumn::name('points_gained')->hide(),

                NumberColumn::name('live_stakings.amount_staked')->enableSummary(),

                NumberColumn::name('live_stakings.amount_won')->enableSummary(),

                Column::name('categories.name')->label("Subcategory")->searchable()->hide(),

                NumberColumn::callback(['start_time', 'end_time'], function ($startTime, $endTime) {
                    return Carbon::parse($startTime)->diffInSeconds(Carbon::parse($endTime));
                })->label('Duration(s)')->filterable(),
            ];
    }
}
