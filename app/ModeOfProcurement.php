<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModeOfProcurement extends Model
{
    protected $fillable = [
        'name'
    ];

    public function item(){
        return $this->belongsToMany('App\Item');
    }
}
