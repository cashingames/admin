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
    public $perPage = 100;
    public $persistPerPage = false;
    
    public function builder()
    {
        $livedb = config('database.connections.mysqllive.database');
        $query = GameSession::query()->whereNull('trivia_id')
            ->select(
                "game_sessions.id",
                "game_sessions.created_at",
                "game_sessions.state",
                "game_sessions.start_time",
                "game_sessions.end_time",
                "game_sessions.category_id",
                "live_subcat.name as subcategory_name",
                "live_users.username as username",
            )
            ->join("{$livedb}.categories as live_subcat", "live_subcat.id", "=", "game_sessions.category_id")
            ->join("{$livedb}.users as live_users", "live_users.id", "=", "game_sessions.user_id")
            ->join("{$livedb}.plans as live_plans", "live_plans.id", "=", "game_sessions.plan_id")
            ->join("{$livedb}.game_modes as live_game_modes", "live_game_modes.id", "=", "game_sessions.game_mode_id");

        return $query;
    }

    public function columns()
    {
        return
            [
                Column::name('game_sessions.id'),


                Column::name('live_users.username')
                    ->searchable(),

                Column::name('session_token')
                    ->searchable()
                    ->hide(),

                Column::name('live_subcat.name')
                    ->label('Subcategory')
                    ->searchable(),

                Column::name('live_plans.name')
                    ->label('Plan')
                    ->searchable(),

                Column::name('live_game_modes.name')
                    ->label('Game Mode')
                    ->searchable(),

                Column::name('state')
                    ->searchable(),

                Column::name('correct_count')
                    ->label('Original Score')
                    ->searchable(),

                Column::name('points_gained')
                    ->searchable(),

                Column::name('odd_multiplier')
                    ->label('Odds Applied')
                    ->searchable(),

                Column::name('odd_condition')
                    ->searchable(),

                Column::callback(['start_time'], function ($start_time) {
                    return Carbon::parse($start_time)->setTimezone('Africa/Lagos');
                })->label('Start Time')->filterable(),

                Column::callback(['end_time'], function ($end_time) {
                    return Carbon::parse($end_time)->setTimezone('Africa/Lagos');
                })->label('End Time')->filterable(),

                DateColumn::callback(['created_at'], function ($created_at) {
                    return Carbon::parse($created_at)->setTimezone('Africa/Lagos');
                })->label('Date Created')->filterable(),

            ];
    }
}
