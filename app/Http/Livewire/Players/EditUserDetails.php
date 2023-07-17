<?php

namespace App\Http\Livewire\Players;

use App\Models\Live\User;
use Livewire\Component;
use Illuminate\Support\Facades\Route;

class EditUserDetails extends Component
{
    public $user, $firstName, $lastName, $username, $email, $phone;
    public function mount()
    {
        $id = Route::current()->parameter('id');
        $this->user = User::find($id);
        $this->firstName = $this->user->profile->first_name;
        $this->lastName = $this->user->profile->last_name;
        $this->username = $this->user->username;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone_number;
    }

    public function editUser()
    {

        $user = $this->user;
        $user->profile->first_name = $this->firstName;
        $user->profile->last_name = $this->lastName;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->phone_number = $this->phone;

        $user->profile->save();
        $user->save();
        return redirect()->to('/cashingames/users/edit/' . $this->user->id);
    }

    public function render()
    {
        return view('livewire.players.edit-user-details');
    }
}
