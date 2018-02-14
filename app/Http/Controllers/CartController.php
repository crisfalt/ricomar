<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Mail\NewOrder;
use Mail;

class CartController extends Controller
{
    //actualizar el carrito de compras a confirmado por el cliente
    public function update( Request $request ) {
        $notification = 'No se puede realizar tu pedido. El carrito esta vacio';
        //$cartActual = auth() -> user() -> cart; //traigo el carrito que pertenece al usuario logueado
        $client = auth()->user();
    	$cartActual = $client->cart;
        if( $cartActual -> details -> count() > 0 ) {
            $cartActual -> status = 'Pending'; //cambio el estado del carrito de este usuario a pendiente
            $cartActual -> orderdate = Carbon::now(); //obtener fecha actual
            $cartActual -> total = $request -> input('total');
            $cartActual -> save(); //atualizo el carrito
            $notification = 'Tu Pedido se ha registrado correctamente. Te contactaremos via Email!';
        }
        $admins = User::where('admin', true)->get(); //busco todos los administradores para q les llegue correo
        //clase neworder de maiable recibe usuario y carrito se le pasa por parametro
        Mail::to($admins)->send(new NewOrder($client, $cartActual));
        return back() -> with( compact('notification') );
    }
}
