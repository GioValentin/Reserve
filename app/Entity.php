<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    protected $table = "entities";
    public $primarykey = 'id';
    protected $fillable = array('title','description','company');

    public function company() {
    	return $this->belongsTo('App\Company','company','id');
    }

    public function reservations() {
    	return $this->hasMany('App\Reservation', 'id', 'entity');
    }

    public function options() {
    	return $this->hasMany('App\Option','id','entity');
    }
}
