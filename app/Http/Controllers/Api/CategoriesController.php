<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Traits\ApiTrait;

class CategoriesController extends Controller
{
	use ApiTrait; 
	
    public function index()
	{
		$data['categories'] = Category::select('id', 'name_' .app()->getLocale() . ' as name' )->get();
		
		$data['locale']     = app()->getLocale();
		
		return ApiTrait::returnData('data',$data,'success');
	}
}
