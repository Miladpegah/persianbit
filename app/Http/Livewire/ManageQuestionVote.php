<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class ManageQuestionVote extends Component
{

    public $question;

    public function mount($question){
        $this->question = $question;
    }


    public function render()
    {
        return view('livewire.manage-question-vote');
    }

    public function positiveVote(){
        if (Auth::check()) {
            $this->question->update([
                'vote' => $this->question->vote + 1
            ]);
            $user = $this->question->user;
            $user->reputation = $user->reputation + 2;
            $user->update([
                'reputation' => $user->reputation - 2
            ]);
            $this->question->messages()->create([
                'user_id' => $user->id,
                'text' => 'Your ' . $this->question->title .  '  question is useful for technology'
            ]);
        }
    }

    public function negativeVote(){
        if (Auth::check()) {
            $this->question->update([
            'vote' => $this->question->vote - 1
            ]);
            $user = $this->question->user;
            $user->update([
                'reputation' => $user->reputation - 2
            ]);
            $this->question->messages()->create([
                'user_id' => $user->id,
                'text' => 'Your ' . $this->question->title .  '  question is not useful for technology'
            ]);
        }
    }

    public function editQuestion(){
        return redirect()->route('question.edit', $this->question);
    }

    public function removeQuestion(){
        $this->question->delete();
        return redirect()->route('questions.index');
    }
}
