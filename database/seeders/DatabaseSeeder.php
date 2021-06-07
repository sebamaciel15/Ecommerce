<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('/public/categories');
        Storage::deleteDirectory('/public/subcategories');
        Storage::makeDirectory('/public/products');

        Storage::makeDirectory('/public/categories');
        Storage::makeDirectory('/public/subcategories');
        Storage::makeDirectory('/public/products');

        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SubcategorySeeder::class);

        $this->call(ProductSeeder::class);
        $this->call(ColorSeeder::class);
        $this->call(ColorProducSeeder::class);
        $this->call(SizeSeeder::class);
    }
}
