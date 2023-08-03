<?php

namespace App\Http\Livewire\Players\Gameark;

use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use App\Models\Live\GameArk\User;
use Mediconesystems\LivewireDatatables\DateColumn;

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

            DateColumn::name('created_at')
            ->label('Time Registered')
            ->searchable()
            ->hideable()
            ->filterable(),
          
        ];
    }

    
}
