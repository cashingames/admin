<?php

namespace App\Http\Livewire\Gaming\Challenge;

use App\Models\Live\ChallengeGameSession;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;

class ChallengeSessionsTable extends LivewireDatatable
{   
    public $complex = true;

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

                Column::name('live_challenges.id')
                    ->label('Challenge Id')
                    ->filterable()
                    ->searchable(),
                    
                Column::name('state')
                    ->label('State'),
                
                Column::name('points_gained')
                    ->label('Points Gained'),

                Column::name('start_time')
                    ->label('Start Time'),

                Column::name('end_time')
                    ->label('End Time'),

                DateColumn::name('created_at')->label('Date Created')->filterable(),

            ];
    }
}
