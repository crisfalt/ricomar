<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->increments('id');

            $table->string('image');
            //inicio foreign key
            $table->integer('product_id')->unsigned();//foranea a autoincremental
            $table->foreign('product_id')->references('id')->on('products');//id campo primario de tabla padre categories nombre tabla padre
            //fin foreignkey
            $table->boolean('featured')->default(false);//default de una columna

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
        Schema::dropIfExists('product_images');
    }
}
