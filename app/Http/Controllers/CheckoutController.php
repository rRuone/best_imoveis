<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    // Exibe o checkout
    public function index(Request $request){
       
        return view('checkout.index');
    }
}
