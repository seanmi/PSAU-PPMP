<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','department_id','position_id','contact_no','user_lvl'
    ];

    public function department(){
        return $this->belongsTo('App\Department', 'department_id');
    }

    public function position(){
        return $this->belongsTo('App\Position', 'position_id');
    }

    public function budget(){
        return $this->hasMany('App\Budget');
    }

    public function approval(){
        return $this->hasMany('App\Approval');
    }


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
