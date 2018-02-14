<?php

use Faker\Generator as Faker;
use App\Category;

$factory->define(Category::class, function (Faker $faker) {
    return [
        //
        'name' => ucfirst($faker->word), //ucfirst la primer vocal mayuscula en palabras
        'description' => $faker->sentence(10)
    ];
});
