<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('id');
            $table->date('orderdate') -> nullable();
            $table->date('entregadate') -> nullable();
            $table->string('status'); // Active, Pending, Approved, Cancelled, Finished
            $table->double('total', 8, 2) -> nullable(); //el total del carrito de compras 8 enteros 2 decimales
            // user_id (FK) al cliente
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
