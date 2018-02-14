<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ProductController extends Controller
{

    private $categories;
    //
    public function index() {
        $products = Product::orderBy('id' , 'DESC') -> paginate(10); //para paginar los productos de 15 en 15
        return view('admin.products.index')->with(compact('products')); //listado de productos
    }

    public function create() {
        // $categories = Category::all(); //traer todas las categorias
        $categories = Category::orderBy( 'name' ) -> get(); //traer todas las categorias pero ordenadas por nombre
        return view('admin.products.create') -> with( compact( 'categories' ) ); //formulario de registro de categorias
    }

    public function store( Request $request ) {
        //dd($request->all());//el metodo permite imprimir todos los datos del request
        // return view(); //almacenar el registro de un producto
        //validar datos con reglas de laravel en documentacion hay mas
        //mensajes personalizados para cada campo
        $this->validate($request,Product::$rules,Product::$messages);
        //crear un prodcuto nuevo
        $product = new Product();
        $product -> name = $request->input('name');
        $product -> description = $request->input('description');
        $product -> price = $request->input('price');
        $product -> long_description = $request->input('long_description');
        $product -> category_id = $request -> input( 'category_id' );
        $product -> save(); //registrar producto
        $notification = 'Producto Agregado Exitosamente';
        return redirect('/admin/products') -> with( compact( 'notification' ) );
    }

    public function edit( $id ) {
//        $categories = Category::all(); //traer categorias
        // return "Mostrar aqui formulario para producto con id $id";
        $product = Product::find( $id );
        $categories = Category::orderBy( 'name' ) -> get(); //traer todas las categorias pero ordenadas por nombre
        return view('admin.products.edit')->with(compact('product','categories')); //formulario de registro
    }

    public function update( Request $request , $id ) {
        //dd($request->all());//el metodo permite imprimir todos los datos del request
        // return view(); //almacenar el registro de un producto
        //validar datos con reglas de laravel en documentacion hay mas
        //mensajes personalizados para cada campo
        $this->validate($request,Product::$rules,Product::$messages);
        //crear producto para actualizar buscandolo por su id
        $product = Product::find( $id );
        $product -> name = $request->input('name');
        $product -> description = $request->input('description');
        $product -> price = $request->input('price');
        $product -> long_description = $request->input('long_description');
        $product -> category_id = $request -> input( 'category_id' );
        $product -> save(); //actualizar producto

        $notification = 'Producto ' . $request->input('name') . ' Actualizado Exitosamente';
        return redirect('/admin/products') -> with( compact( 'notification' ) );
    }

    public function destroy( $id ) {
//        $categories = Category::all(); //traer categorias
        // return "Mostrar aqui formulario para producto con id $id";
        $product = Product::find( $id );
        $product -> delete(); //ELIMINAR
        $notification = 'Producto ' . $product -> name . ' Eliminado Exitosamente';
        return back() -> with( compact( 'notification' ) ); //nos devuelve a la pagina anterior
    }

}
