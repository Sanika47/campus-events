<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Roles
        DB::table('roles')->updateOrInsert(
            ['id' => 1],
            ['name' => 'Student']
        );

        DB::table('roles')->updateOrInsert(
            ['id' => 2],
            ['name' => 'Event Organizer']
        );

        // Categories
        DB::table('categories')->updateOrInsert(
            ['id' => 1],
            ['name' => 'Academic']
        );

        DB::table('categories')->updateOrInsert(
            ['id' => 2],
            ['name' => 'Sport']
        );

        DB::table('categories')->updateOrInsert(
            ['id' => 3],
            ['name' => 'Career']
        );

        DB::table('categories')->updateOrInsert(
            ['id' => 4],
            ['name' => 'Workshop']
        );

        DB::table('categories')->updateOrInsert(
            ['id' => 5],
            ['name' => 'Entertainment']
        );
    }
}
