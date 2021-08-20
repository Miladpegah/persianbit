<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Lesson;
use App\Models\Follow;

class ManageLesson extends Component
{
    public $showtype = 'all';
    public $lessons;
    public $approved;
    public $unapproved;
    public $show = null;


    public function render()
    {
        $this->lessons = Lesson::all();
        $this->approved = $this->lessons->where('accept', true)->all();
        $this->unapproved = $this->lessons->where('accept', false)->all();

        return view('livewire.manage-lesson');
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

    public function lessonAccept($id){
        $lesson = Lesson::whereId($id)->firstOrFail();
        $lesson->accept = true;
        $lesson->update(['accept' => true]);

        $userFollowers = Follow::where('following_id', $lesson->user->id)->get();
        foreach($userFollowers as $follower){
            $lesson->messages()->create([
                'user_id' => $follower->user_id,
                'text' => $lesson->title . ' lesson maked by ' . $user->name
            ]);
        }
    }

    public function lessonUnaccept($id){
        $lesson = Lesson::whereId($id)->firstOrFail();
        $lesson->accept = false;
        $lesson->update(['accept' => false]);
    }

    public function lessonRemove($id){
        $lesson = Lesson::whereId($id)->firstOrFail();
        $lesson->delete();
    }

    public function lessonShow($id){
        $this->show = $id;
    }

    public function lessonHidden(){
        $this->show = null;
    }
}
