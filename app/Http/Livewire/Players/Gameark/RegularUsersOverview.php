<?php

namespace App\Http\Livewire\Players\Gameark;

use App\Models\Live\GameArk\GameSession;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use App\Models\Live\GameArk\User;
use App\Models\Live\Profile;
use App\Models\Live\UserBoost;
use App\Models\Live\UserPlan;
use App\Models\Live\WalletTransaction;

class RegularUsersOverview extends LivewireDatatable
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
                   return User::find($id)->gameSessions()->count();
                    
                }, ['games'])->label('No Of Games Played'),

                Column::callback(['id'], function ($id) {
                    return User::find($id)->transactions()->where('transaction_action', 'BOOST_BOUGHT')->count();
                }, ['boost'])->label('Number of Boosts Bought')

            ];
    }
}
