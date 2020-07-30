<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProposalSection extends Model
{
    //
    public function mediable()
    {
        return $this->morphTo();
    }
    public function proposal()
    {
        return $this->belongsTo('App\Proposal');
    }

}
