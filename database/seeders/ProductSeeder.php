<?php

namespace Database\Seeders;

use App\Models\Photo;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('products')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Product::factory()->count(20)->create(); //You can increase value in count to populate products table with as many records as you want

        $products = Product::get();
        foreach($products as $product){
            Photo::create([
                'filename' => 'https://placeimg.com/100/100/any?' . rand(1, 100),
                'imageable_id' => $product->id,
                'imageable_type' => 'App\Models\Product'
            ]);
        }
    }
}
