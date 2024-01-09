<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        
        return view('admin.home');
    }

    public function client()
    {

        return view('admin.client.index');
    }

    public function editClientProduct(User $user)
    {
        return view('admin.client.edit',compact('user'));
    }
}
