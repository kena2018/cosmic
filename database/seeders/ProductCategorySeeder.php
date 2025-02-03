<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Paper Roll', 'status' => true],
            ['name' => 'Paper Sheet', 'status' => true],
            ['name' => 'Plastic Roll', 'status' => true],
            ['name' => 'Plastic Jumbo Roll', 'status' => true],
        ];

        foreach ($categories as $category) {
            ProductCategory::create($category);
        }
    }
}
