<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;

class UserList extends Component
{

use WithPagination;

// public $users=[];
public $name;
public $email;
public $password;
public $addUserPortion=false;
public $addUserPortionText='Add User';
        public function toggleList(){
            $this->addUserPortion=!$this->addUserPortion;
            $this->addUserPortionText=(!$this->addUserPortion) ?'Add User':'User List';

        }
    public function addUser()  {
        $this->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
        session()->flash('success', 'User created successfully!');
        $this->reset(['name', 'email', 'password']);
    }

    public function render()
    {

        $users=User::latest()->paginate(10);
        return view('livewire.user-list', compact('users'));
    }
}
