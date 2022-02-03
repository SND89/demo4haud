<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductStock;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(5)->has(
            Product::factory(10)->has(
                ProductStock::factory(rand(0, 4)),
                'stock'
            )->has(
                ProductImage::factory(rand(0, 4)),
                'image'
            )
        )->create();
    }
}
