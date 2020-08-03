<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProposalSection extends Model
{
    public static $types= [
        'App\Text' => "Text",
        'App\Image' => "Image",
        'App\Video' => "Video",
    ];
    //
    public function mediable()
    {
        return $this->morphTo();
    }
    public function proposal()
    {
        return $this->belongsTo('App\Proposal');
    }
    public function getTypeAttribute()
    {
        return ProposalSection::$types[$this->mediable_type];
    }
}
