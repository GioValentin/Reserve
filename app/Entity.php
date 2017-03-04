<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    protected $table = "entities";
    protected $fillable = array('title','description','company');

    public function company() {
    	return $this->belongsTo('App\Company','company','id');
    }

    public function reservations() {
    	return $this->hasMany('App\Reservations', 'id', 'entity');
    }

    public function options() {
    	return $this->hasMany('App\Options','id','entity');
    }
}
