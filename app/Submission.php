<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
         'title',
         'instruction', 
         'deadline_submission', 
         'active', 
         'year', 
    ];

    public function budget(){
        return $this->hasMany('App\Budget');
    }
}

