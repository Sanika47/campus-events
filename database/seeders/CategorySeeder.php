<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Academic'
        ]);

        Category::create([
            'name' => 'Sport'
        ]);

        Category::create([
            'name' => 'Career'
        ]);

        Category::create([
            'name' => 'Workshop'
        ]);

        Category::create([
            'name' => 'Entertainment'
        ]);
    }
}