<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    //Mostrar get
    public function show( Category $category ) {
        $products = $category -> products() -> paginate(9); //paginar los productos de una categoria de 10
        return view('categories.show') -> with( compact( 'category' , 'products' ) );
    }
}
