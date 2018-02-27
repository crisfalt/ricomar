<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class TestController extends Controller
{
    //
    public function welcome( Request $request ) {
        // $products = Product::all();
        // return view('welcome')->with(compact('products')); //compact sirve para crear un arreglo a partir de una variabl
        // if( !( \Cache::has('detailsTemp') ) ) { //si hay detalles temporales en la cache
        //     $arrayToSave = array();
        //     \Cache::put('detailsTemp', $arrayToSave , 20);
        // }
        // if( !($request->session()->has('detailsTemp') ) ) {
        //     $arrayToSave = array();
        //     $request->session()->put('detailsTemp', $arrayToSave );
        // }
        $categories = Category::orderBy('name', 'ASC') -> get(); //obtener todas las categoria
        return view('welcome')->with(compact('categories')); //listado de productos
    }
}
