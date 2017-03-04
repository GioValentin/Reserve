<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = "companies";
    protected $fillable = array('name','email','description','phone');

    public function enities() {
    	return $this->hasMany('App\Entity', 'id', 'company');
    }

    public function managers() {
    	return $this->hasMany('App\Manager','id','company');
    }
}
