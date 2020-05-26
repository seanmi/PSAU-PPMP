<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcurementCategory extends Model
{
    protected $fillable = [
        'mode_of_procurement_id',
        'submission_id',
        'category_id'
    ];

    public function category(){
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function submission(){
        return $this->belongsTo('App\Submission', 'submission_id');
    }

    public function mode(){
        return $this->belongsTo('App\ModeOfProcurement', 'mode_of_procurement_if');
    }

}
