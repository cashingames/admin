<?php

namespace App\Http\Livewire\Cms;

use App\Models\Live\Category;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

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

        $_parentCategory = Category::where('name', $this->parentCategory)->first();

        $category = new Category;
        $category->name =  $this->name;
        $category->description =  $this->description;
        $category->background_color = $this->bgColour;
        $category->font_color = $this->fontColour;

        $this->parentCategory == null ?
            $category->category_id = 0 :
            $category->category_id = $_parentCategory->id;

        // if (!is_null($this->icon)) {
        //     $_icon = $this->icon;
        //     $name =str_replace(' ', '_', $this->name) . "." . $_icon->guessExtension();
        //     $destinationPath = 'https://stg-api.cashingames.com/icons';
        //     $category->icon = 'icons/' . $name;
        //     $_icon->move($destinationPath, $name);
        // }else{
        //     $category->icon = null;
        // }
        
        $category->icon = null;
        $category->created_at = Carbon::now();
        $category->updated_at = Carbon::now();
        $category->save();

        return redirect()->to('/cms/categories');
    }

    public function render()
    {
        return view('livewire.cms.category-manager');
    }
}
