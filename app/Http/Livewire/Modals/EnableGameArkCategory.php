<?php

namespace App\Http\Livewire\Modals;

use App\Models\Live\GameArk\Category;
use LivewireUI\Modal\ModalComponent;

class EnableGameArkCategory extends ModalComponent
{   
    public $category;

    public function mount($id){
        $this->category = Category::find($id);
    }

    public function toggleEnabled(){
        if($this->category->is_enabled){
           $this->category->is_enabled = false;
           $this->category->save();
        }else{
           $this->category->is_enabled = true;
           $this->category->save();
        }
        return redirect()->to('/cms/gameark/categories');
    }

    public function render()
    {
        return view('livewire.modals.enable-game-ark-category');
    }
}
