<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Cart extends Model
{
    //relacion carrito con detallercarrito
    public function details() {
        return $this -> hasMany(CartDetail::class);
    }
}
