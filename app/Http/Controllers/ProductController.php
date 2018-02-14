<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    //mostrar un prodcuto a un visitante
    public function show( $idProduct ) {
        $product = Product::find( $idProduct );
        $images = $product -> images;
        $imagesLeft = collect();
        $imagesRight = collect();
        foreach ($images as $index => $image) {
            # code...
            if( $index % 2 == 0 ) {
                $imagesLeft -> push( $image );
            }
            else {
                $imagesRight -> push( $image );
            }
        }
        return view('products.show')->with(compact('product','imagesLeft' , 'imagesRight'));
    }
}
