<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use App\Mail\AppMailer;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Photo;
use App\Models\Spacialty;
use App\Models\Question;
use App\Models\Follow;
use Illuminate\Support\Carbon;


use Intervention\Image\ImageManagerStatic as Image;





class UserController extends Controller
{
    
    public function index(){
        $user = auth()->user();
        $now = Carbon::now();
        $diff_joined_time = $now->diffInMonths($user->created_at);
        if($diff_joined_time > 0){
            if($diff_joined_time >= 12){
                $var = $diff_joined_time / 12;
                $exploded_var = explode('.', $var);
                if(count($exploded_var) > 1){
                    $current_year = $user->created_at->addYear($exploded_var[0]);
                    $months = $now->diffInMonths($current_year);
                    $diff_joined_time = intval($exploded_var[0]) . ' years and ' . intval($months) . ' months ago.';
                }else{
                    $diff_joined_time = $exploded_var[0] . ' years ago.';
                }

            }else{
                $diff_joined_time = $diff_joined_time . ' months ago.';
            }
        }else{
            $diff_joined_time = $now->diffInDays($user->created_at) . ' days ago';
        }
        
        return view('user.dashboard',compact('user', 'diff_joined_time'));
    }

    public function update(Request $request, User $user){
        if (! $request->name) {
            $user->name = $user->name;
        }

        if ($request->name){
            $user->name = $request->name;
        }

        if (! $request->email) {
            $user->email = $user->email;
        }

        if ($request->email){
            $user->email = $request->email;
        }

        if (! $request->password) {
            $user->password = $user->password;
        }

        if ($request->password && $request->password == $request->password_confirmation){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return back();
    }

    public function addPhoto(Request $request, User $user){
        $this->validate($request,[
            'file' => 'required|mimes:jpg,png,bmp'
        ]);

        $file = $request->file('file');

        $user->uploadeUserPhoto($file, $user);

        return $this;
    }

    public function confirmEmail(){
    	$user = auth()->user();
    	return view('send_verified_email', compact('user'));
    }

    public function sendConfirmEmail(AppMailer $mailer){
    	$user = auth()->user();
    	$mailer->sendEmailConfirmationTo($user);
        $user->verify_token = NULL;
        $user->save();

        Auth::logout($user);
        return back();
    }

    public function setting(User $user, Spacialty $spacialty){
        $spacialties = $spacialty->all();
        return view('user.setting', compact('user', 'spacialties'));

    }

    public function userQuestions(User $user){
        $questions = $user->questions()->orderby('updated_at', 'desc')->get();
        return view('user.questions', compact('user', 'questions'));
    }

    public function userAnsweres(User $user){
        $answeres = $user->answeres()->orderby('updated_at', 'desc')->get();
        return view('user.answeres', compact('user', 'answeres'));
    }

    public function markedQuestions(User $user){
        $followQuestions = $user->followQuestions()->orderby('updated_at', 'desc')->get();

        return view('user.markedQuestions', compact('user', 'followQuestions'));
    }

    public function showFollowers(User $user){
        $followers = $user->follows()->where('following_id', $user->id)->get();
        // foreach($followers as $follower){
        //     dd($follower->user->name);
        // }
        return view('user.followers', compact('user', 'followers'));
    }

    public function showFollowing(User $user){
        $followings = $user->follows;
        return view('user.following', compact('user', 'followings'));
    }

    public function unfollowQuestion(User $user, Question $question){
        $user->followQuestions($question->id)->delete();
        return back();
    }

    public function showArticles(User $user){
        $articles = $user->documents()->orderby('updated_at', 'desc')->get();

        return view('user.articles', compact('user', 'articles'));
    }

    public function showLessons(User $user){
        $lessons = $user->lessons()->orderby('updated_at', 'desc')->get();

        return view('user.lessons', compact('user', 'lessons'));
    }

    public function showJobs(User $user){
        $jobs = $user->jobs()->orderby('updated_at', 'desc')->get();

        return view('user.jobs', compact('user', 'jobs'));
    }

    public function showUser(User $selecteduser){
        $user = auth()->user();
        return view('user.show',compact('user', 'selecteduser'));
    }

    public function syncApacialties(Request $request, User $user, Spacialty $spacialty){
        
        $spacialty->syncSpacialty($request, $user);

        return back();
    }

    public function follow(User $user){
        $follower = auth()->user();
        $follower->follows()->create([
            'following_id' => $user->id,
        ]);
        return back();
    }

    public function unfollow(User $user,User $followed){
        $user->follows()->where('following_id', $followed->id)->first()->delete();
        return back();
    }
}
