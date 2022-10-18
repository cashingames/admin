<?php

namespace App\Http\Livewire\Cms;

use App\Models\Live\Category;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Illuminate\Support\Carbon;


class CategoriesTable extends LivewireDatatable
{
    public function builder()
    {
        return Category::query();
    }

    public function columns()
    {
        return
            [
                NumberColumn::name('id')
                    ->label('ID'),
                
                Column::name('name')
                    ->label('Name')
                    ->searchable()
                    ->filterable(),

                Column::callback(['category_id'], function ($category_id) {
                    $category = Category::where('id', $category_id)->first();
                    if (is_null($category)){
                        return "None";
                    }
                    return $category->name;
                })->label('Parent Category')
                    ->searchable()
                    ->filterable(),

                Column::name('description')
                    ->label('Description'),

                Column::name('font_color')
                    ->label('Font Colour'),

                Column::name('background_color')
                    ->label('Background Colour'),

                Column::name('created_at')
                    ->label('Time Created'),

                // BooleanColumn::name('is_enabled')
                //     ->label('Is Enabled')
                //     ->filterable(),

                // DateColumn::name('created_at')->label('Date Created')->filterable(),

                // DateColumn::name('updated_at')->label('Date Edited')->filterable(),

                Column::callback(['id'], function ($id) {
                    return view('cms.categories-table-actions', ['id' => $id]);
                })->unsortable(),

            ];
    }
}
