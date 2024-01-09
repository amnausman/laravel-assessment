<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ClientProduct;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $client_products = ClientProduct::with('product','client')->where('user_id',auth()->id())->get();


        return view('client.home',compact('client_products'));
    }
}
