<?php

namespace App\Http\Livewire;

use App\Models\Live\GameSession;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use App\Models\Live\User;
use App\Models\Live\Profile;
use App\Models\Live\UserBoost;
use App\Models\Live\UserPlan;
use App\Models\Live\WalletTransaction;

class GeneralData extends LivewireDatatable
{

    public function builder()
    {
        return User::query()->has('gameSessions', '>=' , 200);
    }


    public function columns()
    {
        return
            [
                NumberColumn::name('id')
                    ->label('ID'),
                // Column::callback(['id'], function ($id) {
                //     $profile = Profile::where('user_id', $id)->first();
                //     return $profile->first_name;
                // }, 'first_name')->label('First Name'),

                // Column::callback(['id'], function ($id) {
                //     $profile = Profile::where('user_id', $id)->first();
                //     return $profile->last_name;
                // }, 'last_name')->label('Last Name'),

                Column::name('username')
                    ->searchable()
                    ->filterable(),

                Column::name('email')
                    ->label('Email')
                    ->filterable()
                    ->searchable(),

                Column::name('phone_number')
                    ->label('Phone Number')
                    ->filterable()
                    ->searchable(),

                Column::callback(['id'], function ($id) {
                   return GameSession::where('user_id', $id)->count();
                    
                }, 'games')->label('No Of Games Played'),

                Column::callback(['id'], function ($id) {
                    return GameSession::where('user_id', $id)->whereNotNull('trivia_id')->count();
                     
                }, 'trivia')->label('No Of Trivia played'),

                Column::callback(['id'], function ($id) {
                    return WalletTransaction::where('wallet_id', $id)
                    ->where(function ($query) {
                        $query->where('description', 'Bought TIME FREEZE boosts')
                            ->orWhere('description', 'Bought SKIP boosts')
                            ->orWhere('description', 'Bought BOMB boosts');
                    })->count();
                }, 'boost')->label('Number of Boosts Bought'),

                Column::callback(['id'], function ($id) {
                    return UserPlan::where('plan_id', '>', 1)
                    ->where('user_id', $id)->count();

                }, 'games_bought')->label('Number of Bought Games'),

                Column::callback(['id'], function ($id) {
                   return WalletTransaction::where('wallet_id', $id)->where('transaction_type', "DEBIT")->sum('amount');
                }, 'amount_spent')->label('Amount Spent'),

           

            ];
    }
}
