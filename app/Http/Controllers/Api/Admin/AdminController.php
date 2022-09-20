<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiTrait;

class AdminController extends Controller
{
    use ApiTrait; 
	
	public function index()
	{
		return response()->json(['msg' => 'you are admin']);
	}
}
