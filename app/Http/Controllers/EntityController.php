<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Validator;
use Illuminate\Http\Request;
use App\Entity;
use App\Option;

class EntityController extends Controller
{
    public function create(Request $request) {
    	$validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required',
            'company' => 'required'
        ]);

        if ($validator->fails()) {

            return response($validator->errors()->toJson(), 400)
            	->header('Content-Type', 'text/json');
        } 

        $entity = new Entity($request->all());

        try {

		 $entity->company()->findOrFail($request->input('company'));

		} catch (ModelNotFoundException $ex) {
		  	return response(json_encode(array('Company not found.')), 400)
    			->header('Content-Type', 'text/json');
		}

		$entity->save();

		return response($entity->toJson(), 200)
			->header('Content-Type', 'text/json');

    }

    public function addOption(Request $request) {
    	$validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'entity' => 'required',
            'config' => 'required',
        ]);

    	$option = new Option($request->all());

        try {
        	
        	$option->entity()->findOrFail($option->entity)->get();

        } catch (ModelNotFoundException $ex) {
		  	return response(json_encode(array('Entity was not found.')), 400)
    			->header('Content-Type', 'text/json');
		}

		$option->save();

		return response($option->toJson(), 200)
			->header('Content-Type', 'text/json');
    }

    public function updateOption($id, Request $request) {
    	$validator = Validator::make($request->all(), [
            'entity' => 'required',
        ]);

    	$option = Option::find($id);

    	if($option == NULL) {
    		return response(json_encode(Array('Could not update current option.')), 200)
				->header('Content-Type', 'text/json');
    	}

		$option->save();

		return response($option->toJson(), 200)
			->header('Content-Type', 'text/json');
    }

    public function update($id, Request $request) {

    	try {
        	
        	$entity = Entity::findOrFail($id);

        } catch (ModelNotFoundException $ex) {
		  	return response(json_encode(array('Entity was not found.')), 400)
    			->header('Content-Type', 'text/json');
		}

		if($entity->company != $request->input('company')) {
			return response(json_encode(array('Company does not own this entity.')), 400)
    			->header('Content-Type', 'text/json');
		}

		$entity->update($request->all());
		$entity->save();

		return response($entity->toJson(), 200)
			->header('Content-Type', 'text/json');
    }

    public function get($id, Request $request) {
    	try {
        	
        	$entity = Entity::findOrFail($id);

        } catch (ModelNotFoundException $ex) {
		  	return response(json_encode(array('Entity was not found.')), 400)
    			->header('Content-Type', 'text/json');
		}

		$entity->reservations;

		return response($entity->toJson(), 200)
			->header('Content-Type', 'text/json');
    }

    public function delete(Request $request) {
    	
    }
}
