<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginUserRequest;

class UserController extends Controller
{
    public function login(LoginUserRequest $request)
    {

        // dd($request);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            if (Auth::user()->role_id ==  User::ROLE_NORMAL_USER || Auth::user()->role_id ==  User::ROLE_PREMIUM_USER) {
                return redirect()->route('index')->with('success', 'Login Success');
            } 
          
            if (Auth::user()->role_id == User::ROLE_ADMIN) {
                return redirect()->route('productList');
            }
    
        } else {
            return redirect()->back()->with('message', 'Incorrect Email or Password');
        }
    }
}
