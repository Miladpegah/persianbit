<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Models\Role;

class MessageController extends Controller
{
    public function store(Request $request){
        $this->validate($request,[
            'message' => 'required',
            'audiences' => 'required',
        ]);

        if ($request->audiences == 'all') {
            $users = User::all();
            $admin = auth()->user()->admin()->where('user_id', auth()->user()->id)->firstOrFail();
            foreach ($users as $user) {
                $admin->messages()->create([
                    'user_id' => $user->id,
                    'text' => $request->message,
                    'announcement' => true
                ]);
            }
            return back()->with('message', 'Messages sent');
        }

        if ($request->audiences != 'all'){
            $role = Role::whereId($request->audiences)->first();
            $users = $role->users()->get();
            $admin = auth()->user()->admin()->where('user_id', auth()->user()->id)->firstOrFail();
            if (count($users) > 0) {
                foreach ($users as $user) {
                    $admin->messages()->create([
                        'user_id' => $user->id,
                        'text' => $request->message,
                        'announcement' => true
                    ]);
                }
                return back()->with('message', 'Messages sent to ' . $role->name . "'s");
            }
            if (count($users) <= 0) {
                return back()->withErrors('None of the users are ' . $role->name . ',you can not send They message');
            }
        }
    }

    public function userStore(Request $request, User $user){
        $this->validate($request,[
            'message' => 'required',
        ]);

        $admin = auth()->user()->admin()->where('user_id', auth()->user()->id)->firstOrFail();
        $admin->messages()->create([
            'user_id' => $user->id,
            'text' => $request->message,
            'announcement' => true
        ]);

        return back()->with('message', 'Message sent to ' . $user->name);
    }
}
