<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class Company extends Model
{
    use InteractsWithMedia;

    //
    public function users(){
        return $this->belongsToMany('App\User', 'user_companies')->withTimestamps();
    }
    public function proposals(){
        return $this->hasMany('App\Proposal');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('logo')
            ->useFallbackUrl('/assets/user.png')
            ->singleFile();
    }

}
