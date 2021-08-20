<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Intervention\Image\ImageManagerStatic as Image;
use File;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'source_email',
        'source_link',
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function messages()
    {
        return $this->morphMany(Message::class, 'messagetable');
    }

    public function baseDir(){
    	return "documents-poster/";
    }

    public function filePath($file){
    	return $this->baseDir() . DIRECTORY_SEPARATOR . $this->fileName($file);
    }

    public function fileName($file){
    	$name = $file->getClientOriginalName();

        return "{$name}";
    }

    public static function saveAndUploadeEpisode($request){
    	
    	$file = $request->file('file');
    	$user = auth()->user();

        $user->documents()->create([
            'title' => $request->title,
            'body' => $request->body,
            'source_email' => $request->source_email,
            'source_link' => $request->source_link
        ]);

        $article = $user->documents()->where([
            ['title', $request->title],
            ['body', $request->body],
            ['source_email', $request->source_email],
            ['source_link', $request->source_link]
        ])->first();

    	$name = $file->getClientOriginalName();
    	$file->move($article->baseDIR(), $name);
        
        $article->makeThumbailPhoto($file);

        $path = $article->fileThumbailPath($file);

        $article->poster_path = $path;
        $article->save();


        return $article;
    }

    public function fileThumbailPath($file){
        return $this->baseDir() . "/tn-" . $this->fileName($file);
    }

    public function makeThumbailPhoto($file){
        Image::make($this->filePath($file))->resize(740, 480)->save($this->fileThumbailPath($file));

        return $this;
    }

}
