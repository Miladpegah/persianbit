<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Answere;
use App\Models\Question;
use App\Models\Follow;

class AnswereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // handeling messages
        // $user = auth()->user();
        // $messages = $user->messages;
        // foreach($messages as $message){
        //     dd($message->messagetable->id);

        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Question $question)
    {
        $this->validate($request,[
            'body' => 'required|min:100'
        ]);

        $user = auth()->user();
        $question->answeres()->create([
            'user_id' => $user->id,
            'body' => $request->body
        ]);
        $questionOwner = $question->user;
        $question->messages()->create([
            'user_id' => $questionOwner->id,
            'text' => 'New answer to your question by ' . $user->name
        ]);
        $followers = $question->followQuestions;
        foreach($followers as $follower){
            $question->messages()->create([
                'user_id' => $follower->id,
                'text' => 'New answer to the conversation that you are a member of by ' . $user->name
            ]);
        }

        $userFollowers = Follow::where('following_id', $user->id)->get();
        foreach($userFollowers as $follower){
            $question->messages()->create([
                'user_id' => $follower->user_id,
                'text' => 'New answere from ' . $user->name . ' to ' . $question->title
            ]);
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answere $answere){
        $answere->delete();
        $question = $answere->question;
        $question->answere_count = $question->answeres->count();
        $question->save();
        return back();
    }

    public function positiveVote(Answere $answere){
        $answere->vote = $answere->vote + 1;
        $answere->save();
        $user = $answere->user;
        $user->reputation = $user->reputation + 2;
        $user->save();
        $answere->messages()->create([
            'user_id' => $user->id,
            'text' => 'Your answere is useful in ' . $answere->question->title . ' conversation'
        ]);

        return back();
    }

    public function negativeVote(Answere $answere){
        $answere->vote = $answere->vote - 1;
        $answere->save();
        $user = $answere->user;
        $user->reputation = $user->reputation - 2;
        $user->save();
        $answere->messages()->create([
            'user_id' => $user->id,
            'text' => 'Your answere is harmful in ' . $answere->question->title . ' conversation'
        ]);
        return back();
    }

    public function bestAnswere(Answere $answere){
        $question = $answere->question;
        $question->answered = true;
        $question->solution = $answere->id;
        $question->save();
        $user = $answere->user;
        $user->reputation = $user->reputation + 10;
        $user->save();
        $answere->messages()->create([
            'user_id' => $user->id,
            'text' => 'Your answere Was recognized as the best in ' . $answere->question->title . ' conversation'
        ]);
        return back();
    }

    public function cancelBestAnswere(Answere $answere){
        $question = $answere->question;
        $question->answered = false;
        $question->solution = null;
        $question->save();
        $answere->messages()->create([
            'user_id' => $user->id,
            'text' => 'A better answer was found than your answer in ' . $answere->question->title . ' conversation'
        ]);
        return back();
    }

    public function addComment(Request $request,Answere $answere){
        $this->validate($request,[
            'text'=>'required'
            ]);
        $answere->comments()->create(['text' => $request->text]);
        $answere->messages()->create([
            'user_id' => $user->id,
            'text' => 'New comment to your answere in ' . $answere->question->title . ' conversation'
        ]);
        return back();
    }
}
