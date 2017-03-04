<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = "reservations";
    protected $fillable = array('entity', 'name', 'start', 'end', 'type', 'option', );

    public function entity()
    {
        return $this->belongsTo('App\Entity', 'entity');
    }

    public function agreement() {
    	return $this->hasMany('App\Agreement','entity','entity');
    }

}
