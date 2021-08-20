<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Spacialty extends Model
{
    use HasFactory;

     protected $fillable = [
        'name',
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function syncSpacialty($request, $user){
        $user->spacialties()->detach();
        foreach ($request->spatialties as $skill) {
            $savedById = $this->where('id', $skill)->first();
            $savedByName = $this->where('name', $skill)->first();

            User::syncSpacialty($skill, $user, $savedById, $savedByName);
        }
    }
}
