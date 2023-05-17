<?php

namespace App\Http\Livewire\Modals;

use App\Models\Live\GameArk\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use LivewireUI\Modal\ModalComponent;


class EditGameArkCategory extends ModalComponent
{   
    public $category, $parentCategory, $parentCategories;

    public function mount($id)
    {
        $this->category = Category::find($id);
        $this->parentCategories = Category::where('category_id', 0)->get();
        $this->parentCategory = Category::where('id', $this->category->category_id)->first();
    }


    public function editCategory(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'parentCategory' => 'nullable|string',
            'fontColour' => 'nullable|string',
            'bgColour' => 'nullable|string'
        ]);
      

        if ($validator->fails()) {
            return redirect()->to('/cms/gameark/categories')->withErrors($validator);
        }

        $category = Category::find($request->category_id);
        $category->name = $request->name;
        $category->description = $request->description;

        if ($request->has('parentCategory')) {
            $_parentCategory = Category::where('name', $request->parentCategory)->first();
            $category->category_id = $_parentCategory->id ?? 0;
        }
        if ($request->has('fontColour')) {
            $category->font_color = $request->fontColour;
        }
        if ($request->has('bgColour')) {
            $category->background_color = $request->bgColour;
        }

        $category->save();

        return redirect()->to('/cms/gameark/categories');
    }

    public function render()
    {
        return view('livewire.modals.edit-game-ark-category');
    }
}
