<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use App\Models\Spacialty;
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'verify_token',
        'verified',
        'block',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function questions(){
        return $this->hasMany(Question::class);
    }

    public function followQuestions(){
        return $this->hasMany(FollowQuestion::class);
    }

    public function answeres(){
        return $this->hasMany(Answere::class);
    }

    public function lessons(){
        return $this->hasMany(Lesson::class);
    }

    public function documents(){
        return $this->hasMany(Document::class);
    }

    public function padcasts(){
        return $this->hasMany(Padcast::class);
    }

    public function jobs(){
        return $this->hasMany(Job::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function follows(){
        return $this->hasMany(Follow::class);
    }

    public function admin(){
        return $this->hasMany(Admin::class);
    }

    /**
        follow is maked, I use this package => https://github.com/hypefactors/laravel-follow
        the source is in vendor/hypefactors
    */

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function spacialties(){
        return $this->belongsToMany(Spacialty::class);
    }

    public function fiveLastAnswers(){
    }

    public function uploadeUserPhoto($file, $user){
        $name = $this->filename($file);
        $path = $this->fileThumbailPath($file);

        $file->move($this->baseDIR(), $name);

        $this->makeThumbailPhoto($file);

        $this->savePhotoPath($user, $path);

        return $this;
    }

    public function fileName($file){
        $name = sha1(time() . $file->getClientOriginalName());
        $extention = $file->getClientOriginalExtension();

        return "{$name}.{$extention}";
    }

    public function baseDIR(){
        return "images/users";
    }

    public function filePath($file){
        return $this->baseDIR() . DIRECTORY_SEPARATOR . $this->fileName($file);
    }

    public function fileThumbailPath($file){
        return $this->baseDir() . "/tn-" . $this->fileName($file);
    }

    public function makeThumbailPhoto($file){
        Image::make($this->filePath($file))->resize(100, 140)->save($this->fileThumbailPath($file));

        return $this;
    }

    public function savePhotoPath($user, $path){
        $user->photo_path = DIRECTORY_SEPARATOR . $path;
        $user->save();
    }

    public static function syncSpacialty($skill, $user, $savedById, $savedByName){
        if (! empty($savedById) && empty($savedByName)) {
            $user->spacialties()->detach($skill);
            $user->spacialties()->attach($skill);
        }
        if (empty($savedById) && empty($savedByName)) {
            $spacialty = new Spacialty();
            $spacialty->create(['name' => $skill]);
            $spacial = $spacialty->where('name', $skill)->first();
            $user->spacialties()->attach($spacial);  
        }
    }

    public function owns($related){
        return $this->id == $related->user_id;
    }

    public function hasRole($role){
        if (is_string($role)) {
            return $this->roles->contain('name', $role);
        }

        return !! $role->intersect($this->roles)->count();
    }




}
