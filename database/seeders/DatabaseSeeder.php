<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Market::factory(5)->create();

        Category::create([
            'name' => 'Sepatu',
            'slug' => 'sepatu',
            'url_photo' => 'category-image/sepatu.jpg'
        ]);

        Category::create([
            'name' => 'Pakaian',
            'slug' => 'pakaian',
            'url_photo' => 'category-image/pakaian.jpg'
        ]);

        Category::create([
            'name' => 'Tas',
            'slug' => 'tas',
            'url_photo' => 'category-image/tas.jpg'
        ]);

        Category::create([
            'name' => 'Makanan',
            'slug' => 'makanan',
            'url_photo' => 'category-image/food.jpg'
        ]);

        Category::create([
            'name' => 'Buku',
            'slug' => 'buku',
            'url_photo' => 'category-image/book.jpg'
        ]);

        \App\Models\Product::factory(100)->create();
        \App\Models\Photo::factory(300)->create();
        $this->call(LocationSeeder::class);
    }
}
