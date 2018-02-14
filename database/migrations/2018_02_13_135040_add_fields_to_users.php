<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //se crean los nuevos campos
        Schema::table('users', function($table) {
            $table -> string('phone')->nullable(); //se deja nullable para el administsrador pero en la vista se debe pedir como requerido
            $table -> string('address')->nullable();//se deja nullable para el administsrador pero en la vista se debe pedir como requerido
            $table -> string('username'); //login
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
        Schema::table('users', function($table) {
            $table ->dropColumn([
                'phone' , 'address' ,'username'
            ]);
        });
    }
}
