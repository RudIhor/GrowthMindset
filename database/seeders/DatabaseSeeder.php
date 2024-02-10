<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            AuthorSeeder::class,
            CategorySeeder::class,
            QuoteSeeder::class,
            DecisiveStatementSeeder::class,
        ]);
    }
}
