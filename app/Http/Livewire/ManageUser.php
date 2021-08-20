<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;

class ManageUser extends Component
{
    public $users;
    public $showtype = 'all';
    public $admins;
    public $writers;
    public $teachers;
    public $students;
    public $user;
    public $roles;
    public $messageForm = false;
    public $userMessageForm = null;

    public function render(User $user)
    {
        $this->users = $user->all();

        $this->admins = $this->findManager();

        $this->writers = $this->findWriter();

        $this->teachers = $this->findTeachers();

        $this->students = $this->findStudents();

        $this->roles = Role::all();

        return view('livewire.manage-user');
    }

    public function showAdmins(){
        $this->showtype = 'admin';
    }

    public function showWriters(){
        $this->showtype = 'writer';
    }

    public function showTeachers(){
        $this->showtype = 'teacher';
    }

    public function showStudents(){
        $this->showtype = 'student';
    }

    public function showAll(){
        $this->showtype = 'all';
    }

    public function findManager(){
        $manager = Role::where('name', 'manager')->first();
        return $manager->users->all();
    }

    public function findWriter(){
        $manager = Role::where('name', 'writer')->first();
        return $manager->users->all();
    }

    public function findTeachers(){
        $manager = Role::where('name', 'teacher')->first();
        return $manager->users->all();
    }

    public function findStudents(){
        $manager = Role::where('name', 'student')->first();
        return $manager->users->all();
    }

    public function removeUser($id){
        $user = User::whereId($id)->first();
        $user->delete();
    }

    public function userSyncRole($user_id, $role_id){
        $user = User::whereId($user_id)->first();
        $user->roles()->sync($role_id);
    }

    public function openMessageForm(){
        $this->messageForm = true;
    }

    public function closeMessageForm(){
        $this->messageForm = false;
    }

    public function showMessageUserFrom($user_id){
        $this->userMessageForm = $user_id;
    }

    public function hiddenMessageUserFrom(){
        $this->userMessageForm = null;
     
    }
}
