<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class SearchController extends Controller
{
    //buscar los productos en este metodo Search
    public function search( Request $request ) {
        $query = $request -> search;
        //encontrar productos por coincidencias segun el campo name de la bd y el query que llega
        //de la vista
        $products = Product::where('name' , 'like' , "%$query%" ) -> paginate(6);
        if( $products -> count() == 1 ) {
            $id = $products -> first() -> id;
            return redirect( "/products/".$id);
        }
        return view( 'search.show' ) -> with( compact( 'products' , 'query') );
    }

    //datos cargados
    public function data() {
        $products = Product::pluck( 'name' );//pluck para obtener el json del producto
        return $products;
    }

}
