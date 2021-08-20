<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AnswereAddComment extends Component
{
    public $show = false;
    public $answere;



    public function mount($answere){
        $this->answere = $answere;
    }


    public function render()
    {
        return view('livewire.answere-add-comment');
    }

    public function show(){
        $this->show = true;
    }
}

