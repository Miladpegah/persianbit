<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Models\User;
class UserMessageShow extends Component
{
    public $show = false;
    public $user;
    public $messages;
    public $informations;
    public $announcements;
    public $userTable;
    public $message_type = false;
    public function render()
    {
        $this->user = auth()->user();
        $this->messages = $this->user->messages()->orderby('updated_at', 'desc')->get();
        $this->informations = $this->user->messages()->where('announcement', false)->orderby('updated_at', 'desc')->get();
        $this->announcements = $this->user->messages()->where('announcement', true)->orderby('updated_at', 'desc')->get();
        return view('livewire.user-message-show');
    }

    public function showMessages(){
        $this->show = true;
    }

    public function hiddenMessages(){
        $this->show = false;
    }

    public function showInformations(){
        $this->message_type = false;
    }

    public function showAnnouncements(){
        $this->message_type = true;
    }

    public function clearInformations(){
        $this->user->messages()->where('announcement', false)->delete();
    }
}
