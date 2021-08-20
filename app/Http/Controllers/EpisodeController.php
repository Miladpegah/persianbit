<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Episode;
use App\Models\Follow;


class EpisodeController extends Controller
{
    public function create(Lesson $lesson){
        $this->authorize('owner', $lesson);

    	return view('episodes.new-episode', compact('lesson'));
    }

    public function store(Request $request, Lesson $lesson){
        $this->authorize('owner', $lesson);

    	$this->validate($request,[
            'file' => 'required|mimes:mp4,mkv',
            'title' => 'required',
            'body' => 'required',
        ]);
    	Episode::saveAndUploadeEpisode($request, $lesson);

        $user = $lesson->user;

        $episode = $lesson->episodes()->where([['title', $request->title], ['body', $request->body]])->first();

        $userFollowers = Follow::where('following_id', $user->id)->get();
        foreach($userFollowers as $follower){
            $episode->messages()->create([
                'user_id' => $follower->user_id,
                'text' => 'New episod added in ' . $lesson->title
            ]);
        }
    	return redirect()->route('lessons.show', $lesson);
    }

    public function show(Episode $episode){
        return view('episodes.show', compact('episode'));
    }

    public function destroy($id){
        $this->authorize('teach');
    	$episode = Episode::findOrFail($id)->delete();
    	return back();
    }
}
