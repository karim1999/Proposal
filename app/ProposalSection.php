<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProposalSection extends Model
{
    public static $types= [
        'App\Text' => [
            "name" => "Text",
            "accept" => "",
        ],
        'App\Image' => [
            "name" => "Image",
            "accept" => "image/*",
        ],
        'App\Video' => [
            "name" => "Video",
            "accept" => "video/*",
        ],
        'App\Document' => [
            "name" => "Video",
            "accept" => ".pdf,.doc,.docx",
        ],
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
        return ProposalSection::$types[$this->mediable_type]["name"];
    }
}
