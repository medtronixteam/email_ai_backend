<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class MultiStepForm extends Component
{
    public $currentStep = 1;
    public $name, $email, $country, $date_of_birth, $password,$username;



    public function render()
    {
        return view('livewire.multi-step-form');
    }

    public function nextStep()
    {

        if($this->currentStep==1){
            $this->validate([
                'name' => 'required|min:3',
                'email' => 'required|email:rfc,dns|unique:users',

            ]);
            $this->currentStep++;
        }elseif($this->currentStep==2){

                $this->validate([
                    'country' => 'required',
                    'date_of_birth' => 'required',

                ]);
                $this->currentStep++;

        }

    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function submit()
    {
        $this->validate([
            'username' => 'max:25|required|alpha_num|unique:users,username',
            'password' => 'required',
        ]);

        $userCreated=User::create([
            'username' =>strtolower($this->username),
            'password' => Hash::make($this->password),
            'country' =>$this->country,
            'date_of_birth' =>$this->date_of_birth,
            'name' => $this->name,
            'email' =>$this->email,
            'role'=>'buyer',
            'status'=>1,
            'profile_photo'=>'assets/images/user/avatar-1.jpg',
        ]);
        Auth::login($userCreated);
        return redirect()->route('account.page');
        session()->flash('message', 'Registration successful!');
    }
}
