<?php

namespace App\Http\Livewire\Gaming;

use App\Models\Live\GameSession;
use Illuminate\Support\Carbon;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;

class TriviaSessions extends LivewireDatatable
{
    public function builder()
    {
        $livedb = config('database.connections.mysqllive.database');
        $query = GameSession::query()->whereNotNull('trivia_id')->select(
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
            ->join("{$livedb}.trivias as live_trivias", "live_trivias.id", "=", "game_sessions.trivia_id");

        return $query;
    }

    public function columns()
    {
        return
            [
                NumberColumn::name('id')
                    ->label('ID'),

                Column::name('live_users.username')
                    ->label('Username')
                    ->filterable()
                    ->searchable(),

                Column::name('live_subcat.name')
                    ->label('Subcategory')
                    ->filterable()
                    ->searchable(),
                
                Column::name('live_trivias.id')
                    ->label('Live Trivia ID')
                    ->filterable()
                    ->searchable(),

                Column::name('live_trivias.name')
                    ->label('Live Trivia Name')
                    ->filterable()
                    ->searchable(),

                Column::name('state')
                    ->label('State')
                    ->filterable()
                    ->searchable(),

                Column::name('correct_count')
                    ->label('Original Score')
                    ->filterable()
                    ->searchable(),

                Column::name('points_gained')
                    ->label('Points Gained')
                    ->filterable()
                    ->searchable(),

                Column::name('odd_multiplier')
                    ->label('Odds Applied')
                    ->filterable()
                    ->searchable(),

                Column::name('odd_condition')
                    ->label('Odd Condition Met')
                    ->filterable()
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
