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
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalTemp = 0;
        $notification= "";
        if( auth() -> check() ) {
            $cart = auth() -> user() -> cart;
            foreach ($cart -> details as $detail) {
                # code...
                $totalTemp = $totalTemp + ( $detail -> product -> price * $detail -> quantity);
            }
        }
        else {
            if( ( \Cache::has('detailsTemp') ) ) {
                $detailsTemp = \Cache::get('detailsTemp');
                foreach( $detailsTemp as $detail ) {
                    $totalTemp = $totalTemp + ( $detail -> product -> price * $detail -> quantity);
                }
            }
            else {
                $notification = "Si no confirmas en 20 minutos tu carrito se elimina , debes volver a seleccionar los productos y confirmar tu compra";
            }
        }
        //calcular el valor total que lleva el carrito hasta ahora
        
        return view('home') -> with( compact('notification') );
    }
}
