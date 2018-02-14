<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //validar datos con reglas de laravel en documentacion hay mas
    //mensajes personalizados para cada campo
    public static $messages = [
        'name.required' => 'El nombre es un campo obligatorio',
        'name.min' => 'El nombre debe tener minimo 3 caracteres',
        'description.required' => 'La descripción es un campo obligatorio',
        'description.max' => 'La descripcion debe tener maximo 150 caracteres',
        'photocategory.required' => 'El campo imagen es obligatorio'
    ];
    public static $rules = [
            'name' => 'required|min:3',
            'description' => 'required|max:150',
            'photocategory' => 'required'
    ];

    //Category -> pructs
    public function products() {
        return $this->hasMany(Product::class); //1 categoria contiene muchas categorias
    }

}
