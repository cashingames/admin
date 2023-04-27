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

    public function builder()
    {
        $requestQuery = DB::table('challenge_requests')
            ->selectRaw('users.username as request_username, challenge_requests.created_at,
        session_token as request_session, amount_won as request_amount_won, score as request_score,
        user_id as request_user_id, users.phone_number as request_phone_number, users.email as request_email_address')
            ->join('users', 'users.id', '=', 'challenge_requests.user_id')
            ->groupBy('session_token');

        $opponentQuery = DB::table('challenge_requests')
            ->select('user_id', 'session_token', 'score', 'amount_won')
            ->whereColumn('session_token', '=', 'request.request_session')
            ->where('user_id', '<>', DB::raw('request.request_user_id'));

        $query = DB::table(DB::raw("({$requestQuery->toSql()}) as request"))
            ->mergeBindings($requestQuery)
            ->join(DB::raw("({$opponentQuery->toSql()}) as opponent"), 'request.request_session', '=', 'opponent.session_token')
            ->join('users as user_o', 'user_o.id', '=', 'opponent.user_id')
            ->select(
                'request.*',
                'opponent.user_id',
                'user_o.phone_number as opponent_phonenumber',
                'user_o.email as opponent_email',
                'user_o.username as opponet_username',
                'opponent.score as opponet_score',
                'opponent.amount_won as opponent_amount_won'
            );

        return $query;
    }

    public function columns()
    {
        return
            [
                Column::index($this),
                // Column::name('session_token')->filterable(),
                Column::name('users.username')->filterable()->label('Player 1 username'),
                // Column::name('opponent_requests.username')->filterable()->label('Player 2 username'),
                Column::name('users.phone_number')->filterable()->label('Player 1 Phone'),
                // Column::name('o_users.phone_number')->filterable()->label('Player 2 Phone'),
                // BooleanColumn::name('users.is_a_bot')->label('Bot')->filterable(),
                // Column::name('categories.name')->label('Category')->filterable(),
                // Column::name('amount')->label('Staked Amount')->filterable(),
                // Column::name('amount_won')->filterable(),
                // Column::name('status')->filterable(),
                // Column::name('score')->filterable(),
                // Column::name('created_at')->label('Played At')->filterable()
            ];
    }
}
