<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


//Traits
use App\Traits\HttpResponses;
// Models
use App\Models\User;
// Requests
use App\Http\Requests\LoginUserRequest;

class AuthController extends Controller
{

    use HttpResponses;
    
      /**
     * Login The User
     * @param Request $request
     * @return Array
     */
    public function login(Request $request)
    {
        
        $user_login_request = new LoginUserRequest();
        try {
            $validateUser = Validator::make(
                $request->all(),
                $user_login_request->rules()
            );

            if ($validateUser->fails()) {
                return $this->error('','Validation error',$validateUser->errors(),422);
            }

            unset($user_login_request);

            // Checking if username exists
            if ( DB::table('users')->where('email',   $request->email)->exists() ){
                // Checking if passwords match
                $user = User::findOrFail(DB::table('users')->where('email', $request->email)->get()[0]->id);
                $hashedPassword = $user->password;
                if (Hash::check($request->password, $hashedPassword)) {
                    return $this->success([
                        'user' => $user,
                        'token' => $user->createToken('Authentication API Token of : ' . $user->name)->plainTextToken
                    ],'Authentication Successful');

                }else {
                    return $this->error('','Credentials do not match',"INVALID CREDENTIALS",401);
                }

            }else {
                return $this->error('','Credentials do not match',"INVALID CREDENTIALS",401);
            }

        } catch (\Throwable $th) {
            return $this->error('',"ERROR",$th->getMessage(),500);
        }
    }

    /**
     * Logs out the user
     * @param Request $request
     * 
     */
    public function logout(Request $request)
    {
        try {
            // Revoke the token that was used to authenticate the current request...
            $request->user()->currentAccessToken()->delete();
            return $this->success('','You have successfully been logged out');
        } catch (\Throwable $th) {
            return $this->error(null, 'Please Provide Access Token', 'TOKEN_FALSE', 401);
        }
    }

}
