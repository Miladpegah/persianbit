<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function questions(){
        return $this->belongsToMany(Question::class);
    }

    public function syncTags($request, $question){
        foreach ($request->tags as $skill) {
            $savedById = $this->where('id', $skill)->first();
            $savedByName = $this->where('name', $skill)->first();

            $question->syncTags($skill, $question, $savedById, $savedByName);
        }
    }

    public function updateTags($request, $question){
        $question->tags()->detach();

        foreach ($request->tags as $skill) {
            $savedById = $this->where('id', $skill)->first();
            $savedByName = $this->where('name', $skill)->first();

            $question->updateTags($skill, $question, $savedById, $savedByName);

        }
    }
}
