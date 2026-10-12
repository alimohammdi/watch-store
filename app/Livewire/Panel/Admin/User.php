<?php

namespace App\Livewire\Panel\Admin;

use App\Models\User as ModelsUser;

use Livewire\Component;

class User extends Component
{

    public   $modalStatus = 'close';  //close or open
     public string $name = '';
    public string $user_name = '';
    public string $email = '';

    public $password = '';
    public $mobile ='';
    public $password_confirmation ='' ;


     protected  function rules(){
        return  [
            'name' => 'required|min:3|max:25',
            'user_name' => 'required|min:3|max:25',
            'email'   => 'required|email|unique:users,email',
            'mobile' => 'required|min:11|max:11',
            'password'   => 'required|confirmed',
        ];
     }

      public function addUser() {
         $this->validate();

         $user = [
           'name' => $this->name,
           'user_name' => $this->user_name,
           'password' => $this->password,
           'email' => $this->email,
           'mobile' => $this->mobile
         ];

          $result = ModelsUser::create($user);
          if($result){
            $this->reset('name','user_name','password','email','mobile','password_confirmation');
            $this->modalStatus = 'close';
          }else{
            return  redirect()->route('login');
          }
      }

    public function render()
    {
        $users = ModelsUser::paginate(10);

        return view('livewire.panel.admin.user',['users' => $users]);
    }
}
