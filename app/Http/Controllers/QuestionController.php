<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tag;
use App\Models\Question;
use App\Models\FollowQuestion;
use App\Models\Follow;
use Gate;


class QuestionController extends Controller
{
    public function index(Question $question){
    	$questions = $question->orderby('updated_at', 'desc')->get();
    	return view('questions.allQuestions', compact('questions'));
    }

    public function create(){
        $user = auth()->user();
        $tags = Tag::all();
        return view('questions.ask', compact('user', 'tags'));
    }

    public function store(Request $request, User $user, Tag $tag){
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required|min:120',
            'tags' => 'required',
        ]);
        $user->questions()->create(['title' => $request->title, 'body' => $request->body]);
        $question = $user->questions()->where([['title', $request->title], ['body', $request->body]])->first();
        $tag->syncTags($request, $question);

        $userFollowers = Follow::where('following_id', $user->id)->get();
        foreach($userFollowers as $follower){
            $question->messages()->create([
                'user_id' => $follower->user_id,
                'text' =>  $user->name . ' maked new conversation'
            ]);
        }
        return redirect()->route('questions.show', $question);
    }

    public function show(Question $question){

    	return view('questions.show-question',compact('question'));
    }

    public function edit(Question $question){
        $this->authorize('update', $question);

        $tags = Tag::all();
        $user = auth()->user();
        return view('questions.edit', compact('user', 'question', 'tags'));
    }

    public function update(Request  $request, Question $question, Tag $tag){
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required|min:120',
            'tags' => 'required',
        ]);
        $question->update(['title' => $request->title, 'body' => $request->body]);
        $tag->updateTags($request, $question);

        $userFollowers = Follow::where('following_id', $question->user->id)->get();
        foreach($userFollowers as $follower){
            $question->messages()->create([
                'user_id' => $follower->user_id,
                'text' =>  $user->name . ' edit ' . $question->title
            ]);
        }
        return redirect()->route('questions.show', $question);
    }

    public function destroy(Question $question){
        $this->authorize('update', $question);

    	$question->delete();
    	return redirect()->route('questions.index');
    }

    public function positiveVote(Question $question){
        $question->vote = $question->vote + 1;
        $question->save();
        $user = $question->user;
        $user->reputation = $user->reputation + 2;
        $user->save();
        $question->messages()->create([
            'user_id' => $user->id,
            'text' => 'Your ' . $question->title .  '  question is useful for technology'
        ]);
        return back();
    }

    public function negativeVote(Question $question){
        $question->vote = $question->vote - 1;
        $question->save();
        $user = $question->user;
        $user->reputation = $user->reputation - 2;
        $user->save();
        $question->messages()->create([
            'user_id' => $user->id,
            'text' => 'Your ' . $question->title .  ' question is in vain for technology'
        ]);
        return back();
    }

    public function blockQuestion(Question $question){
        $this->authorize('update', $question);

        $question->block = true;
        $question->save();
        $question->messages()->create([
            'user_id' => $question->user->id,
            'text' => 'Your ' . $question->title .  ' question is blocked'
        ]);

        $userFollowers = Follow::where('following_id', $user->id)->get();
        foreach($userFollowers as $follower){
            $question->messages()->create([
                'user_id' => $follower->user_id,
                'text' =>  $question->title . ' is blocked'
            ]);
        }
        return back();
    }

    public function unblockQuestion(Question $question){
        $this->authorize('update', $question);

        $question->block = false;
        $question->save();
        $question->messages()->create([
            'user_id' => $question->user->id,
            'text' => 'Your ' . $question->title .  ' question is unblocked'
        ]);

        $userFollowers = Follow::where('following_id', $user->id)->get();
        foreach($userFollowers as $follower){
            $question->messages()->create([
                'user_id' => $follower->user_id,
                'text' =>  $question->title . ' is unblocked'
            ]);
        }
        return back();
    }

    public function followquestion(Question $question){
        $user = auth()->user();
        $question->followQuestions()->create(['user_id' => $user->id]);
        return back();
    }

    public function addComment(Request $request,Question $question){
        $this->validate($request,[
            'text'=>'required'
            ]);
        $question->comments()->create(['text' => $request->text]);
        return back();
    }

    public function myQuestion(User $user){
        $questions = $user->questions()->orderby('updated_at', 'desc')->get();
        return view('questions.my-questions', compact('questions'));
    }

    public function solvedQuestion(Question $question){
        $questions = $question->where('answered', true)->get();
        return view('questions.allQuestions', compact('questions'));
    }

    public function notSolvedQuestion(Question $question){
        $questions = $question->where('answered', false)->get();
        return view('questions.allQuestions', compact('questions'));
    }

    public function blockedQuestion(Question $question){
        $questions = $question->blocked();
        return view('questions.allQuestions', compact('questions'));
    }

    public function markedQuestions(user $user){
        $user;
        return view('questions.marked-questions', compact('user'));
    }

    public function answereless(Question $question){
        $questions = $question->answerelesses();
        return view('questions.allQuestions', compact('questions'));
    }

    public function terents(Question $question){
        $questions = $question->terents();
        return view('questions.allQuestions', compact('questions'));
    }


}
