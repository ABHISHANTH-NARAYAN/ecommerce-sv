<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        Brand::insert([
            ['name' => 'Parle'],
            ['name' => 'Britannia'],
            ['name' => 'Nestle'],
            ['name' => 'ITC'],
            ['name' => 'Tata'],
        ]);
    }
}

