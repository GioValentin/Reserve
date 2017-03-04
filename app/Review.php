<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = "reviews";
    protected $fillable = array('name', 'entity', 'votes');

    public function entity(){
    	return $this->belongsTo('App\Company');
    }
}
