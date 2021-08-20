<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'vote',
        'answered',
        'solution',
        'block',
    ];

    public function answeres(){
    	return $this->hasMany(Answere::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function followQuestions(){
        return $this->hasMany(FollowQuestion::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function messages()
    {
        return $this->morphMany(Message::class, 'messagetable');
    }

    public function blocked(){
        $questions = $this->where('block', true)->get();
        return $questions;
    }

    public function terents(){
        $ternt = collect();
        $questions = $this->orderby('answere_count', 'desc')->get();
        foreach ($questions as $question) {
            if ($question->answeres->count() >= 2) {
                $ternt->push($question);
            }
        }
        $ternts = $ternt;
        return $ternts;
    }

    public function answerelesses(){
        $answerelesses = collect();
        $questions = $this->orderby('updated_at', 'desc')->get();
        foreach ($questions as $question) {
            if ($question->answeres->isEmpty()) {
                $answerelesses->push($question);
            }
        }
        return $answerelesses;
    }

    public function syncTags($skill, $question, $savedById, $savedByName){
        if (! empty($savedById) || !empty($savedByName)) {
            $question->tags()->detach($skill);
            $question->tags()->attach($skill);
            }
            if (empty($savedById) && empty($savedByName)) {
                $tag = new Tag();
                $tag->create(['name' => $skill]);
                $spacial = $tag->where('name', $skill)->first();
                $question->tags()->attach($spacial);  
            }
    }

    public function updateTags($skill, $question, $savedById, $savedByName){
        if (! empty($savedById) || !empty($savedByName)) {
            $question->tags()->detach($skill);
            $question->tags()->attach($skill);
            }
            if (empty($savedById) && empty($savedByName)) {
                $tag = new Tag();
                $tag->create(['name' => $skill]);
                $spacial = $tag->where('name', $skill)->first();
                $question->tags()->attach($spacial);  
            }
    }

}
