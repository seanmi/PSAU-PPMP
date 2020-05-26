<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name' ,
        'budget_id' ,
        'plan_year' ,
        'state',
        'submitted',
        'remarks',
    ];

    public function budget(){
        return $this->belongsTo('App\Budget');
    }

    public function approval(){
        return $this->hasMany('App\Approval');
    }

    public function planItem(){
        return $this->belongsToMany('App\Item')->withPivot('estimated_budget', 'quantity', 'q1', 'q2', 'q3' ,'q4');
    }


}

