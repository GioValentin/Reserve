<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    protected $table = "managers";
    protected $fillable = array('user','permission','company');

    public function user() {
    	return $this->belongsTo('App\User','user', 'id');
    }

    public function company() {
    	return $this->hasOne('App\Company','company', 'id');
    }

    public function entities() {
    	return $this->hasMany('App\Entity','company','company');
    }
}
