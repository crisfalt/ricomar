<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = auth() -> user() -> cart;
        $totalTemp = 0;
        //calcular el valor total que lleva el carrito hasta ahora
        foreach ($cart -> details as $detail) {
            # code...
            $totalTemp = $totalTemp + ( $detail -> product -> price * $detail -> quantity);
        }
        return view('home') -> with( compact('totalTemp') );
    }
}
