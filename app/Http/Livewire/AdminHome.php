<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Document;
use App\Models\Padcast;
use App\Models\Lesson;
use App\Models\Job;

class AdminHome extends Component
{
    public $users;
    public $admins;
    public $articles;
    public $padcasts;
    public $lessons;
    public $jobs;

    public function render()
    {
        $this->users = User::all();
        $this->admins = User::where('admin', 1)->get();
        $this->articles = Document::all();
        $this->padcasts = Padcast::all();
        $this->lessons = Lesson::all();
        $this->jobs = Job::all();

        return view('livewire.admin-home');
    }
}
