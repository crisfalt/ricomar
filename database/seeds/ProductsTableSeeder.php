<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\ProductImage;
use App\Category;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //model factories
        // factory(Category::class,5)->create();
        // factory(Product::class,100)->create();
        // factory(ProductImage::class,300)->create();
        $categories = factory(Category::class, 4)->create();
        $categories->each(function ($category) {
            $products = factory(Product::class, 10)->make();
            $category->products()->saveMany($products);

            $products->each(function ($p) {
                $images = factory(ProductImage::class, 3)->make();
                $p->images()->saveMany($images);
            });
        });
    }
}
