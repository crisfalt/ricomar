<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use File; //clase file php

class CategoryController extends Controller
{
    //listar categorias GET
    public function index() {
        //orderBy para que me los traiga de forma ascendente segun el parametro id
        $categories = Category::orderBy('name') -> paginate(5); //para paginar los productos de 15 en 15
        return view('admin.categories.index')->with(compact('categories')); //listado de productos
    }

    //mostrar una sola categoria por la id
    public function show( $id ) {
        $category = Category::find( $id );
        return view('admin.categories.show')->with(compact('category'));
    }

    //GET
    public function create() {
        return view('admin.categories.create'); //formulario de registro de categorias
    }

    //Almacenar CAtegoria POST
    public function store( Request $request ) {
        $this->validate($request,Category::$rules,Category::$messages);
        //crear un prodcuto nuevo
        $category = new Category();
        $category -> name = $request->input('name'); //obtener nombre de la categoria
        $category -> description = $request->input('description'); //obtener descripcio de la categoria
        $file = $request->file('photocategory');
        $path = public_path() . '/images/categories'; //concatena public_path la ruta absoluta a public y concatena la carpeta para imagenes
        $fileName = uniqid() . $file->getClientOriginalName();//crea una imagen asi sea igual no la sobreescribe
        $moved = $file->move( $path , $fileName );//dar la orden al archivo para que se guarde en la ruta indicada la sube al servidor
        if( $moved ) {
            $category -> image = $fileName;
            $category -> save(); //registrar categoria
            $notification = 'Categoria Agregada Exitosamente';
            return redirect('/admin/categories') -> with( compact('notification') );
        }
        else {
            $notification = 'No se logro guardar la categoria por la imagen';
            return redirect('/admin/categories') -> with( compact('notification') );
        }
    }

    //GET buscar la cateogira con la id y retorna la vista cargando la categoria
    public function edit( $id ) {
//        $categories = Category::all(); //traer categorias
        // return "Mostrar aqui formulario para producto con id $id";
        $category = Category::find( $id );
        return view('admin.categories.edit')->with(compact('category')); //formulario de registro
    }

    //Metodo POST para actualizar categoria
    public function update( Request $request , $id ) {
        //validar datos con reglas de laravel en documentacion hay mas
        //mensajes personalizados para cada campo
        $messages = [
            'name.required' => 'El nombre es un campo obligatorio',
            'name.min' => 'El nombre debe tener minimo 3 caracteres',
            'description.required' => 'La descripción es un campo obligatorio',
            'description.max' => 'La descripcion debe tener maximo 150 caracteres'
        ];
        $rules = [
                'name' => 'required|min:3',
                'description' => 'required|max:150'
        ];
        //se valida segun las reglas y mensajes creados en el modelo Category
        $this->validate($request,$rules,$messages);
        //crear producto para actualizar buscandolo por su id
        $category = Category::find( $id );
        $category -> name = $request->input('name');
        $category -> description = $request->input('description');
        if( $request -> hasFile('photocategory') ) { //si el campo image tiene un archivo
            $file = $request->file('photocategory');
            $path = public_path() . '/images/categories'; //concatena public_path la ruta absoluta a public y concatena la carpeta para imagenes
            $fileName = uniqid() . $file->getClientOriginalName();//crea una imagen asi sea igual no la sobreescribe
            $moved = $file->move( $path , $fileName );//dar la orden al archivo para que se guarde en la ruta indicada la sube al servidor
            if( $moved ) {
                $previousPath = $path  . '/' . $category -> image; //obtener el antiguo path de la imagen para eliminar
                $category -> image = $fileName;
                $saved = $category -> save(); //registrar categoria , atributo saved para guardar el valor del save
                //codigo para eliminar la imagen anterior
                if( $saved ) File::delete($previousPath); //if la cateogira se guardo elimine la imagen anterior
            }
        }
        $notification = 'Categoria ' . $category -> name . ' Actualizada Exitosamente';
        return redirect('/admin/categories') -> with( compact('notification') );
    }

    //Metodo DELETE
    public function destroy( $id ) {
//        $categories = Category::all(); //traer categorias
        // return "Mostrar aqui formulario para producto con id $id";
        $category = Category::find( $id );
        $category -> delete(); //ELIMINAR

        $notification = 'Categoria '.$category -> name.' Eliminada Exitosamente';
        return redirect('/admin/categories') -> with( compact( 'notification' ) );
        // return back(); //nos devuelve a la pagina anterior
    }

}
