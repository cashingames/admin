<?php

namespace App\Http\Livewire\Gaming\Exhibition;

use App\Models\Live\GameSession;
use Illuminate\Support\Carbon;
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
    const TIMEZONE = 'Africa/Lagos';
    
    public function builder()
    {
        $livedb = config('database.connections.mysqllive.database');
        return GameSession::query()
            ->join("categories", "categories.id", "=", "game_sessions.category_id")
            ->join("{$livedb}.users as users", "users.id", "=", "game_sessions.user_id")
            ->join("{$livedb}.plans as plans", "plans.id", "=", "game_sessions.plan_id")
            ->join("{$livedb}.game_modes as game_modes", "game_modes.id", "=", "game_sessions.game_mode_id")
            ->whereNull('trivia_id');
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

                Column::name('users.phone_number')->searchable()->hide(),

                Column::name('users.email')->searchable()->hide(),

                Column::name('categories.name')->label("Subcategory")->searchable()->hide(),

                Column::name('plans.name')->searchable()->hide(),

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
