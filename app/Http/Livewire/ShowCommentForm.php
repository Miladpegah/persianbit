<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowCommentForm extends Component
{
    public $show = false;
    public $question;



    public function mount($question){
        $this->question = $question;
    }


    public function render()
    {
        return view('livewire.show-comment-form');
    }

    public function show(){
        $this->show = true;
    }
}
