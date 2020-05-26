<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $fillable = [
        'code',
        'general_description',
        'unit',
        'price',
        'mode_of_procurement_id',
        'category_id',
    ];

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function mode(){
        return $this->belongsTo('App\ModeOfProcurement', 'mode_of_procurement_id');
    }

    public function itemPlan(){
        return $this->belongsToMany('App\Plan')->withPivot('estimated_budget', 'quantity');
    }
}
