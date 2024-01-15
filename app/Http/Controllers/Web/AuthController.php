<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Utilities\WebServiceAPI;

use App\Models\User;

class AuthController extends Controller
{
    /**
     * Login
     */
    public function login(Request $request)
    {
        $webAPI = new WebServiceAPI();
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        try {
            $login_details = [
                "email" => $request['email'],
                "password" => $request['password'],
            ];
            $login_details = \json_encode($login_details);

            $response = \json_decode($webAPI->login($login_details));

            unset($webAPI);

            if ($response->status) {
                $user = $response->data->user;
                // Assigning Token
                $user->token = $response->data->token;;
                session([$user]);
                return redirect()->route('home');
            } else {
                return redirect()->route('login')->withInput()->with('status', "$response->message");
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 422);
        }
    }
}