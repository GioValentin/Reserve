<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon/Carbon

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

    public function conflict() {

    	if(!$this->start) return false;
    	if(!$this->end) return false;
    	if(!$this->entity) return false;

    	$reservations = $this->where('entity',$this->entity)->get();

    	foreach ($reservations as $reservation) {
    		if(!$this->checkInRange($reservation->start, $reservation->end, $this->start)) {
    			if(!$this->checkInRange($reservation->end, $reservation->start, $this->end)){
    				return false;
    			}else {
    				return true;
    			}
    		} else {
    			return true;
    		}
    	}

    }

    public function checkInRange($start_date, $end_date, $date_from_user)
	{	

	  $start_ts = strtotime($start_date);
	  $end_ts = strtotime($end_date);
	  $user_ts = strtotime($date_from_user);
	  
	  return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
	}
}
