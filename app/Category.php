<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name'
    ];

    public function item(){
        return $this->hasMany('App\Item');
    }

    public function procurementCategory(){
        return $this->hasMany('App\ProcurementCategory');
    }
}
