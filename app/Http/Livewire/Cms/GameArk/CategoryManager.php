<?php

namespace App\Http\Livewire\Cms\GameArk;

use Livewire\Component;
use App\Models\Live\GameArk\Category;
use Illuminate\Support\Carbon;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class CategoryManager extends Component
{   
    use WithFileUploads;

    public $parentCategories;

    public function mount()
    {
        $this->parentCategories = Category::parentCategories()->get();
    }

    public function addCategory(Request $request)
    {

        $category = new Category;
        $category->name = $request->categoryName;
        $category->description = $request->description;
        $category->background_color = $request->bgColour;
        $category->font_color = $request->fontColour;

        $_parentCategory = Category::where('name', $request->parentCategory)->first();

        $request->has('parentCategory') ?
            $category->category_id = 0 :
            $category->category_id = $_parentCategory->id;

        $category->created_at = Carbon::now();
        $category->updated_at = Carbon::now();
        $category->save();

        if($request->hasFile('icon') ){

            $icon = $request->file('icon');

            Http::attach('icon', file_get_contents($icon), 'icon.jpg')
            ->post(config('app.gameark_api_url') . '/api/v3/category/icon/save',  $request->all());

        }
          
        return redirect()->to('/cms/gameark/categories');
    }

    public function render()
    {
        return view('cms.gameark.categories');
    }
}
