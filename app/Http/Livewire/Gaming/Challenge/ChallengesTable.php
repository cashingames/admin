<?php

namespace App\Http\Livewire\Gaming\Challenge;

use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use App\Models\Live\ChallengeRequest;
use Mediconesystems\LivewireDatatables\BooleanColumn;;

class ChallengesTable extends LivewireDatatable
{
    public $perPage = 100;
    public $persistPerPage = false;

    public function builder()
    {
        return ChallengeRequest::query()
            ->join('users', 'users.id', 'challenge_requests.user_id')
            ->join('categories', 'categories.id', 'challenge_requests.category_id')
        ;
    }

    public function columns()
    {
        return
            [
                Column::index($this),
                Column::name('session_token')->filterable(),
                Column::name('username')->filterable(),
                Column::name('users.phone_number')->filterable(),
                BooleanColumn::name('users.is_a_bot')->label('Bot')->filterable(),
                Column::name('categories.name')->label('Category')->filterable(),
                Column::name('amount')->label('Staked Amount')->filterable(),
                Column::name('amount_won')->filterable(),
                Column::name('status')->filterable(),
                Column::name('score')->filterable(),
                Column::name('created_at')->label('Played At')->filterable()
            ];
    }
}
