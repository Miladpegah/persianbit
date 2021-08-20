<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'email',
        'phone',
        'address',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
