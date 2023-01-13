<?php

namespace App\Http\Livewire\Gaming\Challenge;

use App\Models\Live\ChallengeGameSession;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;

class ChallengeSessionsTable extends LivewireDatatable
{
    public $perPage = 100;
    public $persistPerPage = false;

    public function builder()
    {
        $livedb = config('database.connections.mysqllive.database');

        $query = ChallengeGameSession::query()
            ->select(
                "challenge_game_sessions.id",
                "challenge_game_sessions.created_at",
                "challenge_game_sessions.state",
                "challenge_game_sessions.start_time",
                "challenge_game_sessions.end_time",
                "challenge_game_sessions.category_id",
                "live_subcat.name as subcategory_name",
                "live_users.username as username",
            )
            ->join("{$livedb}.categories as live_subcat", "live_subcat.id", "=", "challenge_game_sessions.category_id")
            ->join("{$livedb}.users as live_users", "live_users.id", "=", "challenge_game_sessions.user_id")
            ->join("{$livedb}.challenges as live_challenges", "live_challenges.id", "=", "challenge_game_sessions.challenge_id");

        return $query;
    }

    public function columns()
    {
        return
            [
                Column::name('challenge_game_sessions.id'),

                Column::name('live_users.username')
                    ->filterable()
                    ->searchable(),

                Column::name('live_users.phone_number')->searchable()->hideable(),

                Column::name('live_users.email')->searchable()->hideable(),

                Column::name('live_subcat.name')
                    ->label('Subcategory')
                    ->filterable()
                    ->searchable(),

                Column::name('live_challenges.id')
                    ->label('Challenge Id')
                    ->filterable()
                    ->searchable(),

                Column::name('state'),

                Column::name('points_gained'),

                Column::name('start_time'),

                Column::name('end_time'),

                DateColumn::name('created_at')->label('Date Created')->filterable(),

            ];
    }
}
