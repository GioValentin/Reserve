<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Reservation;

class ReservationController extends Controller
{
    public function create($company, $entity, Request $request) {

    	$validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'start' => 'required|date|after:tomorrow',
            'end' => 'required|date|after:start',
            'type' => 'required',
        ]);

        if ($validator->fails()) {

            return response($validator->errors()->toJson(), 400)
            	->header('Content-Type', 'text/json');
        } 

        switch ($request->input('type')) {
        	case 'request':
        	case 'unavailable':
        		break;
        	case 'available':
        		break;
        	
        	default:
        		return response(json_encode(array('Provide a valid reservation type: request, unavailable, available.')), 400)
    				->header('Content-Type', 'text/json');
        		break;
        }

        try {

			$reservation = new Reservation($request->all());
			$company = $reservation->company()->findOrFail($company);
			$entity = $reservation->entity()->findOrFail($entity);

			if($company->id == $entity->company) {
				return response(json_encode(array('Company does not own this entity.')), 400)
    				->header('Content-Type', 'text/json');
			}

		} catch (ModelNotFoundException $ex) {
		  	return response(json_encode(array('Company not found.')), 400)
    			->header('Content-Type', 'text/json');
		}

        $reservation->company = $company;
        $reservation->entity = $entity;

        if(!$reservation->conflict()){

        	$reservation->save();

        	return response($reservation->toJson(), 200)
				->header('Content-Type', 'text/json');
        } else {
        	return response(json_encode(array('Time conflict')), 400)
				->header('Content-Type', 'text/json');
        }

    }

    public function getAvaiablilty(Request $request) {

    }

    public function update(Request $request) {

    }

    public function get(Request $request) {

    }

    public function delete(Request $request) {

    }
}
