<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = "reservations";

    public function entity()
    {
        return $this->belongsTo('App\Entity');
    }

    public function agreement() {
    	return $this->hasMany('App\Agreement','entity','entity');
    }
    
}
