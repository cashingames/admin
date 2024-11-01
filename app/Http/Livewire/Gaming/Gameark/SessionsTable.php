<?php

namespace App\Http\Livewire\Gaming\Gameark;

use App\Enums\PlatformType;
use App\Models\Live\ExhibitionBoost;
use App\Models\Live\GameArk\GameSession;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;

class SessionsTable extends LivewireDatatable
{
    public $persistPerPage = false;
    public $persistSearch = false;
    public $persistSort = false;
    public $persistFilters = false;
    public $complex = true;
    const TIMEZONE = 'Africa/Lagos';

    public function builder()
    {
        $livedb = config('database.connections.mysqlGameark.database');

        return GameSession::query()
            ->with('exhibitionBoosts')
            ->join("categories", "categories.id", "=", "game_sessions.category_id")
            ->join("{$livedb}.users as users", "users.id", "=", "game_sessions.user_id")
            ->leftJoin("{$livedb}.exhibition_boosts as exhibition_boosts", "exhibition_boosts.game_session_id", "=", "game_sessions.id")
            ->leftJoin("{$livedb}.boosts as boosts", "exhibition_boosts.boost_id", "=", "boosts.id")
            ->groupBy('game_sessions.id');
    }

    public function columns()
    {
        return
            [
                Column::index($this),

                Column::name('game_sessions.id'),

                Column::name('game_sessions.session_token')->searchable()->hide(),

                DateColumn::callback(['created_at'], function ($createdAt) {
                    return Carbon::parse($createdAt)->setTimezone(self::TIMEZONE);
                })->label('Played At')->filterable(),

                Column::name('users.user_type')
                    ->searchable()->filterable(),

                Column::name('users.username')
                    ->searchable(),

                Column::name('users.email')->searchable()->hideable(),

                DateColumn::name('users.created_at')->label('Joined On')->filterable()->hideable(),

                Column::name('categories.name')->label("Subcategory")->searchable()->hideable(),

                Column::name('boosts.name')->label("Used Boost")->searchable()->hide(),

                Column::name('state')->label('Progress')->searchable(),

                NumberColumn::name('correct_count'),

                NumberColumn::name('points_gained'),

                NumberColumn::callback(['start_time', 'end_time'], function ($startTime, $endTime) {
                    return Carbon::parse($startTime)->diffInSeconds(Carbon::parse($endTime));
                })->label('Time(s)')->filterable(),

            ];
    }
}
