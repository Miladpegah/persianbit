<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Padcast extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'path',
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

    protected static function baseDir(){
    	return "padcastsVoice/";
    }

    protected static function filePath($file){
    	return static::baseDir() . DIRECTORY_SEPARATOR . static::fileName($file);
    }

    protected static function fileName($file){
    	$name = $file->getClientOriginalName();

        return "{$name}";
    }

    public static function saveAndUploadeEpisode($request){
    	
    	$file = $request->file('file');
    	$user = auth()->user();

    	$name = $file->getClientOriginalName();
    	$file->move(static::baseDIR(), $name);
        $path = static::filePath($file);

        $user->padcasts()->create([
            'title' => $request->title,
            'body' => $request->body,
            'path' => $path
        ]);
        
    }
}
