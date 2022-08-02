<?php

namespace App\Http\Livewire\Gaming;

use App\Models\Live\Challenge;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use App\Models\Live\User;
use App\Models\Live\Category;

class ChallengesTable extends LivewireDatatable
{
    public function builder()
    {
        return Challenge::query();
    }

    public function columns()
    {
        return
            [
                NumberColumn::name('id')
                    ->label('ID'),

                Column::callback(['user_id'], function ($user_id) {
                    $user = User::where('id', $user_id)->first();
                    if ($user == null) {
                        return ' ';
                    }
                    return $user->username;
                }, 'challenger')->label('Challenger')->searchable()->filterable(),

                Column::callback(['opponent_id'], function ($opponent_id) {
                    $user = User::where('id', $opponent_id)->first();
                    if ($user == null) {
                        return ' ';
                    }
                    return $user->username;
                }, 'opponent')->label('Opponent')->searchable()->filterable(),


                Column::callback(['category_id'], function ($category_id) {
                    $subcategory = Category::where('id', $category_id)->first();
                    return $subcategory->name;
                })->label('Subcategory')->searchable()->filterable(),

                Column::name('status')
                    ->label('Status'),

                Column::name('created_at')->label('Date Created')->filterable(),

                Column::name('updated_at')->label('Date Edited')->filterable(),
            ];
    }
}
