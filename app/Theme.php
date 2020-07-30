<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    //
    public function proposals(){
        return $this->hasMany('App\Proposal');
    }
}
