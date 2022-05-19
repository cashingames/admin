<?php

namespace App\Http\Livewire\Players;

use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use App\Models\Live\User;
use App\Models\Live\Profile;
use App\Models\Live\GameSession;

class UsersWithNoGames extends LivewireDatatable
{
    public function builder()
    {   
        $usersWithGames = GameSession::pluck('user_id')->all();
        return User::query()->whereNotIn('id', $usersWithGames);
    }  

    public function columns()
    {
        return
        [
            Column::name('username')
            ->label('Username')
            ->searchable(),

            Column::callback(['id'], function ($id) {
                $profile = Profile::where('user_id',$id)->first();
                return ($profile->first_name . ' ' . $profile->last_name);
            })->label('Full Name')
            ->searchable(),

            Column::name('email')
            ->label('Email')
            ->searchable(),

            Column::name('phone_number')
            ->label('Phone')
            ->searchable(),

            Column::name('created_at')
            ->label('Time Registered')
            ->searchable()
            ->hideable()
            ->filterable(),
          
        ];
    }

    
}
