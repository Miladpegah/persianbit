<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Document;
use App\Models\Follow;

class ManageArticle extends Component
{
    public $showtype = 'all';
    public $articles;
    public $approved;
    public $unapproved;
    public $show = null;


    public function render()
    {
        $this->articles = Document::all();
        $this->approved = $this->articles->where('accept', true)->all();
        $this->unapproved = $this->articles->where('accept', false)->all();

        return view('livewire.manage-article');
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

    public function articleAccept($id){
        $article = Document::whereId($id)->firstOrFail();
        $article->accept = true;
        $article->update(['accept' => true]);
        
        $userFollowers = Follow::where('following_id', $article->user->id)->get();
        foreach($userFollowers as $follower){
            $article->messages()->create([
                'user_id' => $follower->user_id,
                'text' => 'New article from ' . $user->name
            ]);
        }
    }

    public function articleUnaccept($id){
        $article = Document::whereId($id)->firstOrFail();
        $article->accept = false;
        $article->update(['accept' => false]);
    }

    public function articleRemove($id){
        $article = Document::whereId($id)->firstOrFail();
        $article->delete();
    }

    public function articleShow($id){
        $this->show = $id;
    }

    public function articleHidden(){
        $this->show = null;
    }
}
