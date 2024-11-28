<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use SOS\SocialApi\Facades\SocialApiFacade as SocialApi;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request){
        $data = $request->all();
        $user = User::create($data);


    }
}
