<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class loginController extends Controller
{
    public function validate(Request $request){

    	if ($request->ajax()) {
    		$data = 'cipta';
    		return response($data);
    	}
    }
}
