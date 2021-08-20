<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Padcast;
use Illuminate\Http\Request;

class ManagePadcast extends Component
{
    public $padcasts;
    public $new = false;
    public $listen = null;


    public function render()
    {
        $this->padcasts = Padcast::all();
        $this->approved = $this->padcasts->where('accept', true)->all();
        $this->unapproved = $this->padcasts->where('accept', false)->all();

        return view('livewire.manage-padcast');
    }

    public function newPadcast(){
        $this->new = true;
        $this->listen = null;
    }

    public function closeForm(){
        $this->new = false;
    }

    public function padcastRemove($id){
        $padcast = Padcast::whereId($id)->firstOrFail();
        $padcast->delete();
    }

    public function padcastShow($id){
        $this->listen = $id;
    }

    public function padcastHidden(){
        $this->listen = null;
    }
}
