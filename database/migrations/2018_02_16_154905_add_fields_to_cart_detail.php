<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToCartDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //se crean los nuevos campos
        Schema::table('cart_details', function($table) {
            $table -> string('observation')->nullable(); //se deja nullable para el administsrador pero en la vista se debe pedir como requerido
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //operacion contraria al metodo up
        Schema::table('cart_details', function($table) {
            $table ->dropColumn([
                'observation'
            ]);
        });
    }
}
