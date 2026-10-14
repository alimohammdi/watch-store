<?php

namespace App\Livewire\Panel\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use App\Enums\RolesEnum;
use App\Models\User;

class Roles extends Component
{
    public array $selectedRoles = [];
    public $roles ;
    public $userId;

    public function mount(User $user)
    {

    $this->userId = $user->id;
    $this->selectedRoles = $user->roles->pluck('name')->toArray();
    }
    // public function mount($id)
    // {
    // $this->userId = $id;

    // $user = User::findOrFail($id);

    // // اگر چک باکس با name بود
    // // $this->selectedRoles = $user->roles->pluck('name')->toArray();
    //  $this->selectedRoles = $user->roles->pluck('id')->toArray();
    // }


    public function saveRoles()
    {

    $user = User::findOrFail($this->userId);

    $user->syncRoles($this->selectedRoles); // وقتی value = name باشد

    }


    public function render()
    {
        $this->roles = Role::all();
        return view('livewire.panel.admin.roles',[
            'roles' => $this->roles
        ]);
    }
}
