<?php

namespace App\Http\Livewire\Gaming\Exhibition;

use App\Enums\PlatformType;
use App\Models\Live\ExhibitionBoost;
use App\Models\Live\GameSession;
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
        $livedb = config('database.connections.mysqllive.database');

        return GameSession::query()
            ->with('exhibitionBoosts')
            ->whereNull('trivia_id')
            ->join("categories", "categories.id", "=", "game_sessions.category_id")
            ->join("{$livedb}.users as users", "users.id", "=", "game_sessions.user_id")
            ->leftJoin("{$livedb}.plans as plans", "plans.id", "=", "game_sessions.plan_id")
            ->join("{$livedb}.game_modes as game_modes", "game_modes.id", "=", "game_sessions.game_mode_id")
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

                Column::name('users.username')
                    ->searchable(),

                Column::name('users.phone_number')->searchable()->hideable(),

                Column::name('users.email')->searchable()->hideable(),

                Column::name('users.brand_id')
                    ->searchable()
                    ->filterable()->label('Source ID'),

                Column::callback(['users.brand_id'], function ($brand_id) {
                    $brand = '';
                    if ($brand_id == 1) {
                        $brand = PlatformType::V1->value;
                    }
                    if ($brand_id == 2) {
                        $brand = PlatformType::Cashingames->value;
                    }
                    if ($brand_id == 10) {
                        $brand = PlatformType::GameArk->value;
                    }
                    return $brand;
                })->label('Source'),

                DateColumn::name('users.created_at')->label('Joined On')->filterable()->hideable(),

                Column::name('categories.name')->label("Subcategory")->searchable()->hide(),

                Column::name('plans.name')->label("Plan")->searchable()->hide(),

                Column::name('boosts.name')->label("Used Boost")->searchable()->hide(),

                Column::name('game_modes.name')->label("Game Mode")->hide(),

                Column::name('state')->label('Progress')->searchable(),

                NumberColumn::name('correct_count'),

                NumberColumn::name('points_gained'),

                Column::name('odd_multiplier'),

                Column::name('odd_condition'),

                NumberColumn::callback(['start_time', 'end_time'], function ($startTime, $endTime) {
                    return Carbon::parse($startTime)->diffInSeconds(Carbon::parse($endTime));
                })->label('Time(s)')->filterable(),

            ];
    }
}
