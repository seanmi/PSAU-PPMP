<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = ['amount', 'submission_id', 'user_id','remaining'];

    public function submission(){
        return $this->belongsTo('App\Submission', 'submission_id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function plan(){
        return $this->hasOne('App\Plan');
    }
    

}
