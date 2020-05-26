<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    protected $fillable = [
        'user_id',
        'plan_id',
        'remarks',
        'approved'
    ];
    
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function plan(){
        return $this->belongsTo('App\Plan', 'plan_id');
    }

}
