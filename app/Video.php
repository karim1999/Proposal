<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class Video extends Model
{
    use InteractsWithMedia;

    //
    public function section()
    {
        return $this->morphOne('App\ProposalSection', 'mediable');
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('file')->singleFile();
    }
}
