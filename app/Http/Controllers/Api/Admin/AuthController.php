<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiTrait;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;
use Auth;

class AuthController extends Controller
{
	use ApiTrait;
	
    public function login(Request $request)
	{
		try {
			
			//validation
			$rules = [
				"email" => "required",
				"password" => "required"

			];

			$validator = Validator::make($request->all(), $rules);

			if ($validator->fails()) {
				$code = $this->returnCodeAccordingToInput($validator);
				return $this->returnValidationError($code, $validator);
				
			}
			
			//login
			
			$credentials = $request->only(['email', 'password']);
			
			$token = Auth::guard('admin_api')->attempt($credentials);
			

			if (!$token) {
				return $this->returnError('E001', 'Sign in credentials not correct');
			}
			
			$admin = Auth::guard('admin_api')->user();
			
			$admin->api_token = $token;
			
			//return admin with token
			return $this->returnData('admin', $admin);

        } catch (\Exception $ex) {
			
            return $this->returnError($ex->getCode(), $ex->getMessage());
			
        }
		
	}
	
	public function logout(Request $request)
	{
		$token  = $request->header('auth-token');
		
		if($token == JWTAuth::getToken()){
			JWTAuth::setToken($token)->invalidate();
			return $this->returnSuccess('msg' => 'You logged out');
		} else {
			$this->returnError('E0005','something went wrong');
		}
			
	}
}
