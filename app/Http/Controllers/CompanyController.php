<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Company;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class CompanyController extends Controller
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

        $company = new Company($request->all());

        $company->save();

        return response($company->toJson(), 200)
        	->header('Content-Type', 'text/json');

    }

    public function update($id, Request $request) {

    	try {

		  $company = Company::findOrFail($id);

		} catch (ModelNotFoundException $ex) {
		  	return response(json_encode(array('Company not found.')), 400)
    			->header('Content-Type', 'text/json');
		}

    	$company->update($request->all());
    	$company->save();

    	return response($company->toJson(), 200)
    		->header('Content-Type', 'text/json');

    }

    public function get($company,$id, Request $request) {
    	try {

			$company = Company::findOrFail($id);

		} catch (ModelNotFoundException $ex) {
		  	return response(json_encode(array('Company not found.')), 400)
    			->header('Content-Type', 'text/json');
		}

		$company->enities;
		$company->managers;

		return response($company->toJson(), 200)
			->header('Content-Type', 'text/json');

    }

    public function delete(Request $request) {

    }
}
