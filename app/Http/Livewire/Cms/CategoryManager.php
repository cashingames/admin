<?php

namespace App\Http\Livewire\Cms;

use App\Models\Live\Category;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Http;

class CategoryManager extends Component
{   
    use WithFileUploads;

    public $parentCategories, $parentCategory, $description, $name;
    public $bgColour, $fontColour, $icon;

    public function mount()
    {
        $this->parentCategories = Category::parentCategories()->get();
        $this->icon = null;
        $this->parentCategory = null;
    }

    public function save()
    {
        // dd($this->icon);
        $_parentCategory = Category::where('name', $this->parentCategory)->first();

        $category = new Category;
        $category->name =  $this->name;
        $category->description =  $this->description;
        $category->background_color = $this->bgColour;
        $category->font_color = $this->fontColour;

        $this->parentCategory == null ?
            $category->category_id = 0 :
            $category->category_id = $_parentCategory->id;

        $category->created_at = Carbon::now();
        $category->updated_at = Carbon::now();
        $category->save();

        
        if (!is_null($this->icon)) {
            Http::post(config('app.api_url').'/api/v3/category/icon/save', [
                'categoryName' => $this->name,
                'icon' => $this->icon,
            ]);
        }

        return redirect()->to('/cms/categories');
    }

    public function render()
    {
        return view('livewire.cms.category-manager');
    }
}
