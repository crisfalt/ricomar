<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public static $messages = [
        'name.required' => 'El nombre es un campo obligatorio',
        'name.min' => 'El nombre debe tener minimo 3 caracteres',
        'description.required' => 'La descripción es un campo obligatorio',
        'description.max' => 'La descripcion debe tener maximo 200 caracteres',
        'price.required' => 'El precio es un campo obligatorio',
        'price.numeric' => 'El precio es un campo de solo numeros',
        'price.min' => 'El precio no debe ser menor de cero'
    ];

    public static $rules = [
            'name' => 'required|min:3',
            'description' => 'required|max:200',
            'price' => 'required|numeric|min:0'
    ];

    //$product -> Category
    public function category() {
        return $this->belongsTo(Category::class); //1 pdoducto pertene a una categoria
    }

    //$product -> $images
    public function images() {
        return $this->hasMany(ProductImage::class); //1 pdoducto pertene a una categoria
    }

    public function getFeaturedImageUrlAttribute() {
        $featuredImage = $this->images()->where( 'featured' , true ) -> first();
        if( !$featuredImage ) {
            $featuredImage = $this -> images() -> first();
        }
        if( $featuredImage ) {
            return $featuredImage -> url; //url segun la creada en el modelo ProductImage::getUrlAttribute
        }
        //si no entra a ningun if se pone una imagen por defecto
        return '/images/products/default2.jpg';
    }

    //obtener el nombre de la categoria
    public function getCategoryNameAttribute() {
        if( $this -> category ) return $this -> category -> name;
        return 'General';
    }

}
