<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id'); //clave autoincremental
            //por defecto los campos son no null
            $table->string('name');
            $table->string('description')->nullable(); //nullable para que sea null
            $table->string('image')->nullable(); //nullable para que sea null
            $table->timestamps(); //añade dos columnas datatime createup y updateup
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
