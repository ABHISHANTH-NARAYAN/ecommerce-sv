<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NewsCategory;

class NewsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NewsCategory::insert([
            ['name' => 'Politics'],
            ['name' => 'Sports'],
            ['name' => 'Business'],
            ['name' => 'Technology'],
            ['name' => 'Entertainment'],
            ['name' => 'Health'],
        ]);
    }
}