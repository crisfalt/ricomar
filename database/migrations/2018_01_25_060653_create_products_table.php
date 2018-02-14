<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description',250);
            $table->text('long_description')->nullable();
            $table->float('price');
            //inicio foreign key
            $table->integer('category_id')->unsigned()->nullable();//foranea a autoincremental
            $table->foreign('category_id')->references('id')->on('categories');//id campo primario de tabla padre categories nombre tabla padre
            //fin foreignkey
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
        Schema::dropIfExists('products');
    }
}
