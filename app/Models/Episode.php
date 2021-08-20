<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Intervention\Image\ImageManagerStatic as Image;
use File;

class Episode extends Model
{
    use HasFactory;
    protected $fillable = [
        'lesson_id',
        'title',
        'body',
        'path',
    ];

    public function lesson(){
        return $this->belongsTo(Lesson::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function messages()
    {
        return $this->morphMany(Message::class, 'messagetable');
    }

    public function baseDir($lesson){
    	return "video/" . $lesson->title;
    }

    public function filePath($lesson, $file){
    	return $this->baseDir($lesson) . DIRECTORY_SEPARATOR . $this->fileName($file);
    }

    public function fileName($file){
    	$name = $file->getClientOriginalName();
        $extention = $file->getClientOriginalExtension();

        return "{$name}";
    }

    public static function saveAndUploadeEpisode($request, $lesson){
    	
    	$file = $request->file('file');
        $episode = new Episode();
        $episode->lesson_id = $lesson->id;
        $episode->title = $request->title;
        $episode->body = $request->body;
        $episode->path = $episode->filePath($lesson, $file);
        $episode->save();

        $name = $file->getClientOriginalName();
        $file->move($episode->baseDIR($lesson), $name);
    }

    

}
