<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class TestController extends Controller
{
    //
    public function welcome() {
        // $products = Product::all();
        // return view('welcome')->with(compact('products')); //compact sirve para crear un arreglo a partir de una variabl
        $categories = Category::get(); //obtener todas las categoria
        return view('welcome')->with(compact('categories')); //listado de productos
    }
}
