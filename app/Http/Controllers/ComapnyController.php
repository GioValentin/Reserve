<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class ComapnyController extends Controller
{
    public function create(Request $request) {

    	$validate = $this->validate($request, [
        	'name' => 'required|max:255',
        	'email' => 'required',
        	'phone' => 'required',
    	]);

    	if($validate->valid()) {
    		$Company = new Company()
    	} else {
    		return $validate->errors()->toJson();
    	}
    }

    public function update(Request $request) {

    }

    public function get(Request $request) {

    }

    public function delete(Request $request) {

    }
}
