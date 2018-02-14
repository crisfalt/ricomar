<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CartDetail;

class CartDetailController extends Controller
{
    //Constructor de esta clase que primero identifica si hay un usuario logueado
    //si existe un usuario logueado entonces puede acceder a los metodos es decir
    //antes de acceder al metodo store o destroy primero entra al constructor y valida si un
    //usuario inicio sesion , si no no deje hacer los metodos
    public function __construct() {
        $this -> middleware('auth');//verificar si alguien a iniciado sesion
    }


    public function store( Request $request ) {
        $cartDetail = new CartDetail();
        $cartDetail -> cart_id = auth() -> user() -> cart -> id;
        $cartDetail -> product_id = $request -> product_id;
        $cartDetail -> quantity = $request -> quantity;
        $cartDetail -> save();
        $notification = 'El producto se ha agregado a tu Carrito de Compras';
        return back() -> with( compact('notification') );
    }

    public function destroy( Request $request ) {
        $notification = ''; //variable para devolver una notificacion a la vista
        $id_cart_detail = $request -> cart_detail_id;//obtengo la id del detalle a eliminar
        $cartDetail = CartDetail::find( $id_cart_detail ); //lo busco en la tabla
        //pregunto si el detalle pertenece al carrito de compras del usuario logueado
        if( $cartDetail -> cart_id == auth() -> user() -> cart -> id ) {
            $cartDetail -> delete(); //elimino
            $notification = 'El producto se ha eliminado de la orden Correctamente';
        }
        else {
            $notification = 'El producto no se puede eliminar de la orden';
        }

        return back() -> with( compact('notification') );
    }

}
