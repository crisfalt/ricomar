<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CartDetail;
use App\Globales;

class CartDetailController extends Controller
{
    //Constructor de esta clase que primero identifica si hay un usuario logueado
    //si existe un usuario logueado entonces puede acceder a los metodos es decir
    //antes de acceder al metodo store o destroy primero entra al constructor y valida si un
    //usuario inicio sesion , si no no deje hacer los metodos
    public function __construct() {
        //$this -> middleware('auth');//verificar si alguien a iniciado sesion
    }

    //metodo /cart post
    public function store( Request $request ) {
        $cartDetail = new CartDetail();
        $cartDetail -> product_id = $request -> product_id;
        $cartDetail -> quantity = $request -> quantity;
        $bomb = $request -> input('bomb');
        $patacon = $request -> input('patacon');
        $observationIn = $request -> input('observation');
        $observation = "";
        if( $bomb != null ) $observation = $bomb; 
        if( $patacon != null ) $observation = $patacon;
        if( $observationIn != null ) $observation = $observationIn;
        if( ( $patacon != null ) && ( $bomb != null ) ) $observation = $bomb.";".$patacon;
        if( ( $patacon != null ) && ( $observationIn != null ) ) $observation = $patacon.";".$observationIn;
        if( ( $bomb != null ) && ( $observationIn != null ) ) $observation = $bomb.";".$observationIn;
        if( ( $patacon != null ) && ( $bomb != null ) && ( $observationIn != null ) ) $observation = $bomb.";".$patacon.";".$observationIn;
        $cartDetail -> observation = $observation;
        if( auth() -> check() ) {
            $cartDetail -> cart_id = auth() -> user() -> cart -> id;
            $cartDetail -> save();
        }
        else {
            if( !($request->session()->has('detailsTemp') ) ) {
                $arrayToSave = array();
                array_push( $arrayToSave , $cartDetail );
                $request->session()->put('detailsTemp', $arrayToSave );
            }
            else {
                $arraySave = $request->session()->get('detailsTemp');
                array_push( $arraySave , $cartDetail );
                $request->session()->put('detailsTemp', $arraySave );
            }
            // if( !( \Cache::has('detailsTemp') ) ) {
            //     $arrayToSave = array();
            //     array_push( $arrayToSave , $cartDetail );
            //     \Cache::put('detailsTemp', $arrayToSave , 20); //creo en cache la variable por 20 minutos
            // }
            // else {
            //     $arraySave = \Cache::get('detailsTemp');
            //     array_push( $arraySave , $cartDetail );
            //     \Cache::put('detailsTemp', $arraySave , 20); //creo en cache la variable por 20 minutos
            // }
            // $arraySave = \Cache::get('detailsTemp');
            // foreach( $arraySave as $safety ) {
            //     dd( $safety -> product_id );
            // }
        }
        $notification = 'El producto se ha agregado a tu Carrito de Compras';
        return back() -> with( compact('notification') );
    }

    //eliminar el producto del carrito de compras tradiccional
    public function destroy( Request $request) {
        $notification = ''; //variable para devolver una notificacion a la vista
        $id_cart_detail = $request -> cart_detail_id ;//obtengo la id del detalle a eliminar
        //dd($id_cart_detail);
        if( auth() -> check() ) {
            $cartDetail = CartDetail::find( $id_cart_detail ); //lo busco en la tabla
            //pregunto si el detalle pertenece al carrito de compras del usuario logueado
            if( $cartDetail -> cart_id == auth() -> user() -> cart -> id ) {
                $cartDetail -> delete(); //elimino
                $notification = 'El producto se ha eliminado de la orden Correctamente';
            }
            else {
                $notification = 'El producto no se puede eliminar de la orden';
            }
        }
        else {
            // $detallesCache = \Cache::get('detailsTemp');
            // unset($detallesCache[ $id_cart_detail ] ); //eilimino el producto de la cache
            // \Cache::put('detailsTemp', $detallesCache , 20); //meto el array a la cache pero el prodcuto eliminado
            // $notification = 'El producto se ha eliminado de la orden Correctamente';
            $detallesCache = $request->session()->get('detailsTemp');
            unset($detallesCache[ $id_cart_detail ] ); //eilimino el producto de la cache
            $request -> session() -> put('detailsTemp', $detallesCache); //meto el array a la cache pero el prodcuto eliminado
            $notification = 'El producto se ha eliminado de la orden Correctamente';
        }

        return back() -> with( compact('notification') );
    }

    //eliminar el producto del carrito de compras con jquery-confimr
    public function destroyPlato( Request $request , $idDelete ) {
        dd($idDelete);
        $notification = ''; //variable para devolver una notificacion a la vista
        $id_cart_detail = $idDelete;//obtengo la id del detalle a eliminar
        //dd($id_cart_detail);
        if( auth() -> check() ) {
            $cartDetail = CartDetail::find( $id_cart_detail ); //lo busco en la tabla
            //pregunto si el detalle pertenece al carrito de compras del usuario logueado
            if( $cartDetail -> cart_id == auth() -> user() -> cart -> id ) {
                $cartDetail -> delete(); //elimino
                $notification = 'El producto se ha eliminado de la orden Correctamente';
            }
            else {
                $notification = 'El producto no se puede eliminar de la orden';
            }
        }
        else {
            $detallesCache = $request->session()->get('detailsTemp');
            unset($detallesCache[ $id_cart_detail ] ); //eilimino el producto de la cache
            $request -> session() -> put('detailsTemp', $detallesCache); //meto el array a la cache pero el prodcuto eliminado
            $notification = 'El producto se ha eliminado de la orden Correctamente';
        }

        return back() -> with( compact('notification') );
    }

}
