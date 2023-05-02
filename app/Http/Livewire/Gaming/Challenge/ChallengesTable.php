<?php

namespace App\Http\Livewire\Gaming\Challenge;

use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use App\Models\Live\ChallengeRequest;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

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
        return ChallengeRequest::select('request.*', 'opponent.user_id', 'user_o.phone_number as opponent_phonenumber', 'user_o.email as opponent_email', 'user_o.username as opponet_username', 'opponent.score as opponet_score', 'opponent.amount_won as opponent_amount_won')
            ->join(DB::raw('(select users.username as request_username, challenge_requests.created_at, session_token as request_session, amount as request_amount_staked, amount_won as request_amount_won, score as request_score, user_id as request_user_id, users.phone_number as request_phone_number, users.email as request_email_address, users.is_a_bot as request_bot, users.created_at as request_joined_on from challenge_requests, users where users.id = challenge_requests.user_id group by session_token) as request'), 'request.request_session', '=', 'challenge_requests.session_token')
            ->join('users as user_o', 'user_o.id', '=', 'challenge_requests.user_id')
            ->join('categories', 'categories.id', '=', 'challenge_requests.category_id')
            ->join('challenge_requests as opponent', function ($join) {
                $join->on('request.request_session', '=', 'opponent.session_token')
                    ->on('request.request_user_id', '<>', 'opponent.user_id');
            })->join('users as user_op', 'user_op.id', '=', 'opponent.user_id')->groupBy('request.request_session');
    }

    public function columns()
    {
        return
            [
                Column::name('request.created_at')->filterable()->label('Time Played'),
                Column::name('categories.name')->filterable()->label('Category'),
                BooleanColumn::name('request.request_bot')->label('Player 1 Bot Status')->filterable(),
                Column::name('request.request_username')->filterable()->label('Player 1 username'),
                Column::name('request.request_phone_number')->filterable()->label('Player 1 Phone')->hide(),
                Column::name('request.request_email_address')->filterable()->label('Player 1 Email')->hide(),
                Column::name('request.request_amount_staked')->filterable()->label('Player 1 Amount Staked'),
                Column::name('request.request_amount_won')->filterable()->label('Player 1 Amount Won'),
                Column::name('request.request_score')->filterable()->label('Player 1 Score'),
                Column::name('request.request_joined_on')->filterable()->label('Player 1 Joined On')->hide(),

                BooleanColumn::name('user_op.is_a_bot')->label('Player 2 Bot Status')->filterable()->group('opponent'),
                Column::name('opponent.username')->filterable()->label('Player 2 username')->group('opponent'),
                Column::name('user_op.phone_number')->filterable()->label('Player 2 Phone')->group('opponent')->hide(),
                Column::name('user_op.email')->filterable()->label('Player 2 Email')->group('opponent')->hide(),
                Column::name('opponent.amount')->filterable()->label('Player 2 Amount Staked')->group('opponent'),
                Column::name('opponent.amount_won')->filterable()->label('Player 2 Amount Won')->group('opponent'),
                Column::name('opponent.score')->filterable()->label('Player 2 Score')->group('opponent'),
                Column::name('user_op.created_at')->filterable()->label('Player 2 Joied On')->group('opponent')->hide(),
            ];
    }
}
