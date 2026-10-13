<?php

namespace App\Livewire\Panel\Admin;

use App\Enums\Userstatus;
use App\Helpers\ImageHelper;
use App\Models\User as ModelsUser;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class User extends Component
{

    use WithFileUploads , WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $userId;
    public $search;
    public   $modalStatus = 'close';  //close or open
     public string $name = '';
    public string $user_name = '';
    public string $email = '';

    public $password = '';
    public $mobile ='';
    public $password_confirmation ='' ;
    public $file = '';
    public $currentProfile;

     protected  function rules(){
        return  [
            'name' => 'required|min:3|max:25',
            'user_name' => 'required|min:3|max:25',
            'email'   => 'required|email|unique:users,email',
            'mobile' => 'required|digits:11',
            'password'   => 'required|confirmed',
            'file'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ];
     }

     protected function updateRules()
    {
    return [
        'name'      => 'required|min:3|max:25',
        'user_name' => 'required|min:3|max:25',
        'email'     => 'required|email|unique:users,email,' . $this->userId,
        'mobile'    => 'required|digits:11,'. $this->userId,
        'password'  => 'nullable|confirmed|min:6',
        'file'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ];
    }

      public function addUser() {
         $this->validate();
        $profilePath  = null;
        if ($this->file) {
        $image = ImageHelper::store($this->file, 'profile', [
            'width'   => 400,
            'height'  => 400,
            'quality' => 80,
            'format'  => 'webp',
        ]);

        $profilePath = $image['path'];

         }
         $user = [
           'name' => $this->name,
           'user_name' => $this->user_name,
           'password' => bcrypt($this->password),
           'email' => $this->email,
           'mobile' => $this->mobile,
           'image'   => $profilePath
         ];

          $result = ModelsUser::create($user);
          if($result){
            $this->reset('name','user_name','password','email','mobile','password_confirmation','file');
            $this->modalStatus = 'close';
          }
      }

      public function editUser($id)
    {
    $user = ModelsUser::findOrFail($id);

    $this->userId          = $user->id;
    $this->name            = $user->name;
    $this->user_name       = $user->user_name;
    $this->email           = $user->email;
    $this->mobile          = $user->mobile;
    $this->currentProfile  = $user->profile;
    $this->password        = null;
    $this->password_confirmation = null;
    $this->file            = null;

    $this->resetValidation();

    $this->dispatch('open-edit-modal');
    }

     public function closeEditModal()
    {
    $this->reset([
        'userId', 'name', 'user_name', 'email', 'mobile',
        'password', 'password_confirmation', 'file', 'currentProfile'
    ]);
    $this->resetValidation();
    }


    public function updateUser()
{
    $this->validate($this->updateRules());

    $user = ModelsUser::findOrFail($this->userId);

    $data = [
        'name'      => $this->name,
        'user_name' => $this->user_name,
        'email'     => $this->email,
        'mobile'    => $this->mobile,
    ];

    // اگر پسورد وارد شده بود
    if ($this->password) {
        $data['password'] = bcrypt($this->password);
    }


    if ($this->file) {

        if ($user->profile) {
            ImageHelper::delete($user->profile);
        }

        $image = ImageHelper::store($this->file, 'profile', [
            'width'   => 400,
            'height'  => 400,
            'quality' => 80,
            'format'  => 'webp',
        ]);

        $data['image'] = $image['path'];
    }

    $user->update($data);

    $this->closeEditModal();
    $this->dispatch('close-edit-modal');
   }



    public function changeStatus($id){

            $user = ModelsUser::findOrFail($id);

            if($user->status == Userstatus::Active->value){
              $updated =   $user->update([
                     'status' => Userstatus::InActive->value
                  ]);
            }else{
              $updated = $user->update([
                      'status' => Userstatus::Active->value
                  ]);
            }


    }

    public function render()
    {
        $users = ModelsUser::query()
        ->where('name','like','%'.$this->search.'%')
        ->orWhere('email','like','%'.$this->search.'%')
        ->orWhere('mobile','like','%'.$this->search.'%')
        ->paginate(5);

        return view('livewire.panel.admin.user',['users' => $users]);
    }
}
