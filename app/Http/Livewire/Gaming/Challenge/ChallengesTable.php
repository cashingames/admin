<?php

namespace App\Http\Livewire\Gaming\Challenge;

use App\Models\Live\Challenge;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use App\Models\Live\User;
use App\Models\Live\Category;
use App\Models\Live\ChallengeGameSession;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;

class ChallengesTable extends LivewireDatatable
{   
    public $perPage = 100;
    public $persistPerPage = false;

    public function builder()
    {   
        // return WalletTransaction::query()
        // ->leftJoin('wallets', 'wallets.id', 'wallet_transactions.wallet_id')
        // ->leftJoin('users', 'users.id', 'wallets.user_id');

        return Challenge::query()
        ->join('users as c_users', 'c_users.id', 'challenges.user_id')
        ->join('users as o_users', 'o_users.id', 'challenges.opponent_id')
        ;
    }

    public function columns()
    {
        return
            [
                Column::index($this),

                Column::callback(['user_id'], function ($user_id) {
                    $user = User::where('id', $user_id)->first();
                    if ($user == null) {
                        return ' ';
                    }
                    return $user->username;
                }, ['challenger'])->label('Challenger')->searchable()->filterable(),

                Column::name('c_users.username')
                    ->label('Challenger')->searchable()->filterable(),

                Column::callback(['opponent_id'], function ($opponent_id) {
                    $user = User::where('id', $opponent_id)->first();
                    if ($user == null) {
                        return ' ';
                    }
                    return $user->username;
                }, ['opponent'])->label('Opponent')->searchable()->filterable(),


                Column::callback(['category_id'], function ($category_id) {
                    $subcategory = Category::where('id', $category_id)->first();
                    return $subcategory->name;
                })->label('Subcategory')->searchable()->filterable(),

                Column::name('status')
                    ->label("Opponent's Response")->searchable()->filterable(),

                Column::callback(['id'], function ($id) {
                    $challenge = Challenge::find($id);
                    if(!is_null($challenge) && !is_null($challenge->expired_at)){
                        return 'EXPIRED';
                    }
                    $sessionCount= ChallengeGameSession::where('challenge_id', $id)->count();
                    
                    if($sessionCount == 1){
                        return 'ONGOING';
                    }
                    
                    if($sessionCount == 0){
                        return 'PENDING';
                    }

                    if($sessionCount == 2){
                        return 'COMPLETED';
                    }

                   
                }, ['challenge_status'])->label('Challenge Status'),
                Column::name('expired_at')->label('Date Expired')->filterable(),

                DateColumn::name('created_at')->label('Date Created')->filterable(),

                DateColumn::name('updated_at')->label('Date Edited')->filterable(),
            ];
    }
}
