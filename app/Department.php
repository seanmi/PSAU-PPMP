<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name', 'group_id'
    ];

    public function user(){
        return $this->hasMany('App\User');
    }

    public function group(){
        return $this->belongsTo('App\Group', 'group_id');
    }
}
