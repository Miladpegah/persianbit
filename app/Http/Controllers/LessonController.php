<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lesson;
use App\Models\Follow;


class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Lesson $lesson)
    {
        $lessons = $lesson->where('accept', true)->orderby('updated_at', 'desc')->get();
        return view('lesson.index', compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('teach');

        return view('lesson.new-lesson');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('teach');

        $this->validate($request,[
            'title' => 'required',
            'body' => 'required'

        ]);

        $user = auth()->user();

        $user->lessons()->create([
            'title' => $request->title,
            'body' => $request->body
        ]);

        $lesson = $user->lessons()->where([['title', $request->title],['body', $request->body]])->first();
        
        $lesson->messages()->create([
                'user_id' => $lesson->user->id,
                'text' => $lesson->title . ' lesson has been created, please wait for admin acception.'
            ]);

        return redirect()->route('lessons.show', $lesson);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        return view('lesson.show-lesson', compact('lesson'));
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
    public function destroy($id)
    {
        //
    }

    public function updateStatus(Request $request, Lesson $lesson){
        $this->authorize('teach');
        
        $lesson->status = $request->status;
        $lesson->save();
        return back();
    }
}
