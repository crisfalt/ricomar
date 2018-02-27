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
    public function index( Request $request )
    {
        $totalTemp = 0;
        $notification= "";
        $cartDetails = array();
		$countProducts = 0;
        if( auth() -> check() ) {
            // $cart = auth() -> user() -> cart;
            $cartDetails = auth() -> user() -> cart -> details;
            foreach ($cartDetails as $detail) {
                # code...
                $totalTemp = $totalTemp + ( $detail -> product -> price * $detail -> quantity);
            }
			$countProducts= $cartDetails -> count();
        }
        else {
            if( ($request->session()->has('detailsTemp') ) ) {
                $cartDetails = $request->session()->get('detailsTemp');
                foreach( $cartDetails as $detail ) {
                    $totalTemp = $totalTemp + ( $detail -> product -> price * $detail -> quantity);
                }
                $countProducts = count($cartDetails);
            }
            else {
                // $notification = "Si no confirmas en 20 minutos tu carrito se elimina , debes volver a seleccionar los productos y confirmar tu compra";
                $notification = "El carrito esta vacio";
            }
        }
        //calcular el valor total que lleva el carrito hasta ahora
        
        return view('home') -> with( compact('notification','cartDetails','countProducts') );
    }
}
