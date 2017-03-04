<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Entity;

class EntityController extends Controller
{
    public function create(Request $request) {
    	$validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'phone' => 'required',
            'email' => 'required'
        ]);

        if ($validator->fails()) {

            return response($validator->errors()->toJson(), 400)
            	->header('Content-Type', 'text/json');
        } 
    }

    public function update(Request $request) {

    }

    public function get(Request $request) {

    }

    public function delete(Request $request) {

    }
}
