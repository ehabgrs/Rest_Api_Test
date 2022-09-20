<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Traits\ApiTrait;
use Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
	use ApiTrait;
	
    public function index()
	{
		//because we used auth_guard:api middleware at the route
		//so the the function inside the middleware will parse the user and the token 
		//so we can get the authenticated user
		return Auth::user();
	}
	
	public function login(Request $request)
	{
		try{
			$rules = [
				'email' => 'required',
				'password' => 'required',
			];
			
			$validator = Validator::make($request->all(),$rules);
			
			if ($validator->fails()) {
				$code = $this->returnCodeAccordingToInput($validator);
				return $this->returnValidationError($code, $validator);	
			}
			
			$credentials = $request->only(['email', 'password']);
				
			$token = Auth::guard('api')->attempt($credentials);
			
			if (!$token) {
				return $this->returnError('E001', 'Sign in credentials not correct');
			}
			
			$user = Auth::guard('api')->user();
				
			$user->api_token = $token;
				
			return $this->returnData('user', $user);
			
		} catch (\Exception $ex) {
			
            return $this->returnError($ex->getCode(), $ex->getMessage());
			
        }
			
	}
	
	
	public function logout(Request $request)
	{
		$token  = $request->header('auth-token');
		//in the middleware auth_guard:api , we parsed the user so we will get the token for user not admin , depend on the guard
		if($token == JWTAuth::getToken()){
			JWTAuth::setToken($token)->invalidate();
			return $this->returnSuccess('','You logged out');
		} else {
			$this->returnError('E0005','something went wrong');
		}		
	}
	
}
