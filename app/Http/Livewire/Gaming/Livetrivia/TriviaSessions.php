<?php

namespace App\Http\Livewire\Gaming\Livetrivia;

use App\Models\Live\GameSession;
use Illuminate\Support\Carbon;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;

class TriviaSessions extends LivewireDatatable
{
    public $perPage = 100;
    public $persistPerPage = false;
    public $complex = true;

    public function builder()
    {
        $livedb = config('database.connections.mysqllive.database');
        return GameSession::query()->whereNotNull('trivia_id')->select(
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
    }

    public function columns()
    {
        return
            [
                Column::name('game_sessions.id'),

                Column::name('live_users.username')
                    ->filterable()
                    ->searchable(),

                Column::name('live_users.phone_number')->searchable()->hideable(),

                Column::name('live_users.email')->searchable()->hideable(),

                Column::name('session_token')
                    ->searchable()
                    ->hide(),

                DateColumn::name('live_users.created_at')
                    ->label('Joined On')
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
                    ->filterable()
                    ->searchable(),

                Column::name('correct_count')
                    ->label('Original Score')
                    ->filterable()
                    ->searchable(),

                Column::name('points_gained')
                    ->filterable()
                    ->searchable(),

                Column::callback(['start_time', 'end_time'], function ($start_time, $end_time) {
                    return Carbon::parse($start_time)->diffInSeconds(Carbon::parse($end_time));
                }, ['duration'])->label('Duration (in Seconds)'),

                Column::name('odd_multiplier')
                    ->label('Odds Applied')
                    ->filterable()
                    ->searchable(),

                Column::name('odd_condition')
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
