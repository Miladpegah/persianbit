<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\AppMailer;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, AppMailer $mailer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'verify_token' => Str::random(30),
        ]);

        $user = User::where('email', $request->email)->firstOrFail();
        $role = Role::where('name', 'Student')->firstOrFail();
        $user->roles()->sync($role->id);
        $mailer->sendEmailConfirmationTo($user);
        Auth::login($user);


        return redirect(RouteServiceProvider::HOME);

    }

    public function confirmEmail($id, $verify_token){

        $user = User::whereId($id)->firstOrFail();
        $user->verified = True;
        $user->verify_token = NULL;
        $user->save();

        

        // Auth::login($user);
        Auth::logout($user);
        return redirect(route('login'));
        // return redirect(RouteServiceProvider::HOME);

    }
}
