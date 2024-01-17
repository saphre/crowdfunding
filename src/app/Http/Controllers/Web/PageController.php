<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\Utilities\WebServiceAPI;

class PageController extends Controller
{
    public function home(){
        $webAPI = new WebServiceAPI();
        $response = \json_decode($webAPI->getDonations(null));
        unset($webAPI);
        $donations = $response->data;
        return view('welcome',compact('donations'));
    }
    public function login(){
        return view('auth.login');
    }

    
}
