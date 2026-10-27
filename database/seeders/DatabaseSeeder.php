<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
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
    }
}
