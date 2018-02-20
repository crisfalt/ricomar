<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Cart;
use App\Mail\NewOrder;
use Mail;

class CartController extends Controller
{
    //actualizar el carrito de compras a confirmado por el cliente
    public function update( Request $request ) {
        $notification = 'No se puede realizar tu pedido. El carrito esta vacio';
        //$cartActual = auth() -> user() -> cart; //traigo el carrito que pertenece al usuario logueado
        $client;
        $cartActual;
        if( auth() -> check() ) {
            $client = auth()->user();
            $cartActual = $client->cart;
            if( $cartActual -> details -> count() > 0 ) {
                $cartActual -> status = 'Pending'; //cambio el estado del carrito de este usuario a pendiente
                $cartActual -> orderdate = Carbon::now(); //obtener fecha actual
                $cartActual -> total = $request -> input('total');
                $cartActual -> save(); //atualizo el carrito
                $notification = 'Tu Pedido se ha registrado Exitosamente. Te contactaremos via Email!';
            }
        }
        else {
            if( ( \Cache::has('detailsTemp') ) ) { //si hay detalles temporales en la cache
                $detallesTemporales = \Cache::get('detailsTemp');
                if( count( $detallesTemporales ) > 0 ) { // si en los detalles temporales hay mas de 0 producto
                    //usuario temporal
                    $client = new User();
                    $client -> name = $request -> input('name');
                    $client -> email = $request -> input('email');
                    $client -> phone = $request -> input('phone');
                    $client -> address = $request -> input('address');
                    //crear carrito de compras en bd para asignar a los detalles de compra
                    $lastCart = Cart::all() -> last();
                    $cartActual = new Cart();
                    $cartActual -> status = 'Pending';
                    $cartActual -> id = ( ( $lastCart -> id ) + 1 );
                    $cartActual -> orderdate = Carbon::now(); //obtener fecha actual
                    $cartActual -> total = $request -> input('total');
                    $cartActual -> user_id = 3;
                    $cartActual -> save(); //guardo el carrito
                    //detalles temporales a los detalles de la bd
                    foreach( $detallesTemporales as $detalle ) {
                        $detalle -> cart_id = $cartActual -> id;
                        $detalle -> save();
                    }
                    \Cache::forget('detailsTemp');
                    $arrayToSave = array();
                    \Cache::put('detailsTemp', $arrayToSave , 20);
                    $notification = 'Tu Pedido se ha registrado Exitosamente. Te contactaremos via Email!';
                }
            }
        }
        $admins = User::where('admin', true)->get(); //busco todos los administradores para q les llegue correo
        //clase neworder de maiable recibe usuario y carrito se le pasa por parametro
        Mail::to($admins)->send(new NewOrder($client, $cartActual));
        return back() -> with( compact('notification') );
    }
}
