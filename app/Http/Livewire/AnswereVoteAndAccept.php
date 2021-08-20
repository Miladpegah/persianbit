<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AnswereVoteAndAccept extends Component
{
    
    public $answere;

    public function mount($answere){
        $this->answere = $answere;
    }


    public function render()
    {
        return view('livewire.answere-vote-and-accept');
    }


    public function positiveVote(){
        $this->answere->vote = $this->answere->vote + 1;
        $this->answere->update([
            'vote' => $this->answere->vote + 1
        ]);
        $user = $this->answere->user;
        $user->reputation = $user->reputation + 2;
        $user->update([
            'reputation' => $user->reputation + 2
        ]);
        $this->answere->messages()->create([
            'user_id' => $user->id,
            'text' => 'Your answere is useful in ' . $this->answere->question->title . ' conversation'
        ]);
    }

    public function negativeVote(){
        $this->question->update([
            'vote' => $this->question->vote - 1
        ]);
        $user = $this->question->user;
        $user->update([
            'reputation' => $user->reputation - 2
        ]);
        $this->question->messages()->create([
            'user_id' => $user->id,
            'text' => 'Your answere is harmful in ' . $this->answere->question->title . ' conversation'
        ]);
    }

    public function bestAnswere(){
        $question = $this->answere->question;
        $question->update([
            'answered' => true,
            'solution' => $this->answere->id
        ]);

        $user = $this->answere->user;
        $user->update([
            'reputation' => $user->reputation + 10
        ]);

        $this->answere->messages()->create([
            'user_id' => $user->id,
            'text' => 'Your answere Was recognized as the best in ' . $this->answere->question->title . ' conversation'
        ]);

    }

    public function notBestAnswere(){
        $question = $this->answere->question;
        $question->update([
            'answered' => false,
            'solution' => null
        ]);

         $user = $this->answere->user;

        $this->answere->messages()->create([
            'user_id' => $user->id,
            'text' => 'A better answer was found than your answer in ' . $this->answere->question->title . ' conversation'
        ]);
    }
}
