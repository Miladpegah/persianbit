<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Follow;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Document $article)
    {
        $articles = $article->where('accept', true)->orderby('updated_at', 'desc')->get();
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('write');
        
        return view('articles.new-article');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('write');
        $this->validate($request,[
            'title' => 'required|max:40',
            'body' => 'required',
            'file' => 'required',

        ]);

        $user = auth()->user();


        Document::saveAndUploadeEpisode($request);

        $doc = $user->documents()->where([
            ['title', $request->title],
            ['body', $request->body],
            ['source_email', $request->source_email],
            ['source_link', $request->source_link]
        ])->first();

        $doc->messages()->create([
                'user_id' => $doc->user->id,
                'text' => ' Your article has benn created pleas wait for admin acception.'
            ]);

        return redirect()->route('show.articles', $user);
        // return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Document $article)
    {
        return view('articles.show', compact('article'));
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
}
