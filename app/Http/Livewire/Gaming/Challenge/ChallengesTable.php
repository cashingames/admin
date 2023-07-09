<?php

namespace App\Http\Livewire\Gaming\Challenge;

use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use App\Models\Live\ChallengeRequest;
use Illuminate\Support\Facades\DB;

class ChallengesTable extends LivewireDatatable
{
    public $perPage = 100;
    public $persistPerPage = false;

    public $exportable = true;
    public $hideable = 'select';
    public $complex = true;
    public $persistHiddenColumns = false;
    public $defaultSortColumn = 'created_at';

    public $groupLabels = [
        'opponent' => 'TOGGLE OPPONENT DETAILS'
    ];

    public function builder()
    {
        return ChallengeRequest::query()->select(
            'challenge_requests.created_at',
            'categories.name as category_name',
            'challenge_requests.request_mode',
            DB::raw('(CASE WHEN cr2.user_id = 1 then "BOT" else cr2.username end) player'),
            'cr2.score as player_score',
            DB::raw('(CASE WHEN challenge_requests.user_id = 1 then "BOT" else challenge_requests.username end) opponent'),
            'challenge_requests.score as opponent_score',
            'challenge_requests.status as opponent_status',
            'cr2.status as player_status',
            'cr2.amount_won as player_won',
            'challenge_requests.amount_won as opponent_won'
        )->leftJoin('challenge_requests as cr2', function ($join) {
            $join->on('challenge_requests.session_token', '=', 'cr2.session_token');
            $join->on('challenge_requests.user_id', '!=', 'cr2.user_id');
        })
        ->join('categories', 'categories.id', '=', 'challenge_requests.category_id')
        ->groupBy('challenge_requests.session_token');
       
    }



    public function columns()
    {
        return
            [
                Column::name('challenge_requests.created_at')->filterable()->label('Time Played'),
                Column::name('categories.name')->filterable()->label('Category'),
                Column::name('challenge_requests.request_mode')->filterable()->label('Mode'),
                Column::name('cr2.username')->filterable()->label('Player')->searchable(),
                Column::name('cr2.score')->filterable()->label('Player Score')->searchable(),
                Column::name('cr2.status')->filterable()->label('Player Status')->searchable(),
                Column::name('cr2.amount_won')->filterable()->label('Player Won')->searchable(),
                Column::name('challenge_requests.username')->filterable()->label('Opponent')->searchable(),
                Column::name('challenge_requests.score')->filterable()->label('Opponent Score')->searchable(),
                Column::name('challenge_requests.status')->filterable()->label('Opponent Status')->searchable(),
                Column::name('challenge_requests.amount_won')->filterable()->label('Opponent Won')->searchable(),
            ];
    }
}
