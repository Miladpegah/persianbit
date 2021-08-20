<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Job;
use App\Models\Follow;

class ManageJob extends Component
{
    public $showtype = 'all';
    public $jobs;
    public $approved;
    public $unapproved;
    public $show = null;


    public function render()
    {
        $this->jobs = Job::all();
        $this->approved = $this->jobs->where('accept', true)->all();
        $this->unapproved = $this->jobs->where('accept', false)->all();

        return view('livewire.manage-job');
    }

    public function showAll(){
        $this->showtype = 'all';
        $this->show = null;
    }

    public function showAccepted(){
        $this->showtype = 'approved';
        $this->show = null;
    }

    public function showUnaccepted(){
        $this->showtype = 'unapproved';
        $this->show = null;
    }

    public function jobAccept($id){
        $job = Job::whereId($id)->firstOrFail();
        $job->accept = true;
        $job->update(['accept' => true]);
        
        $userFollowers = Follow::where('following_id', $job->user->id)->get();
        foreach($userFollowers as $follower){
            $job->messages()->create([
                'user_id' => $follower->user_id,
                'text' => 'New article from ' . $user->name
            ]);
        }
    }

    public function jobUnaccept($id){
        $job = Job::whereId($id)->firstOrFail();
        $job->accept = false;
        $job->update(['accept' => false]);
    }

    public function jobRemove($id){
        $job = Job::whereId($id)->firstOrFail();
        $job->delete();
    }

    public function jobShow($id){
        $this->show = $id;
    }

    public function jobHidden(){
        $this->show = null;
    }
}
