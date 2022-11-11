<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
     function register(RegisterUserRequest $request){

        // dd($request);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =  Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->save();

        return redirect()->route('index')->with('success', 'Registeration Successfull');

     }

     public function destroy()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logout Successfully');
    }
}
