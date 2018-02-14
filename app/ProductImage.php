<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    //$image -> $product
    public function product() {
        return $this->belongsTo(Product::class); //1 pdoducto pertene a una categoria
    }

    //metodo que muestra la nueva image subida en el foreach donde tambien se cargan imagenes
    public function getUrlAttribute() {
        if( substr( $this->image , 0 , 4 ) == "http" ) {
            return $this -> image;
        }
        return '/images/products/' . $this -> image;
    }

}
