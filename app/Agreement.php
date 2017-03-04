<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
   	protected $table = "agreements";
   	protected $fillable = array('entity','required','link');

   	public function entity() {
   		return $this->belongsTo('App\Entity','entity');
   	}

}
