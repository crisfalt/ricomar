<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class CartDetail extends Model
{
    public function product() {
        return $this -> belongsTo(Product::class);
    }
}
