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
        return User::query()->doesntHave('gameSessions');
       
    }  

    public function columns()
    {
        return
        [
            Column::name('username')
            ->searchable(),
            
            Column::name('email')
            ->searchable(),

            Column::name('phone_number')
            ->searchable(),

            Column::name('created_at')
            ->label('Time Registered')
            ->searchable()
            ->hideable()
            ->filterable(),
          
        ];
    }

    
}
