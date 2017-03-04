<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table = "options";
    protected $fillable = array('name','entity', 'config');

    public function entity() {
    	return $this->belongsTo('App\Entity', 'entity');
    }
}
