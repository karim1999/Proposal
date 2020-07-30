<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    //
    public function company(){
        return $this->belongsTo('App\Company');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function sections(){
        return $this->hasMany('App\ProposalSection');
    }

    public function theme(){
        return $this->belongsTo('App\Theme');
    }
}
