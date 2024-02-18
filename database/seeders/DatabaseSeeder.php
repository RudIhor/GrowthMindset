<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Author\database\seeders\AuthorSeeder;
use Modules\Category\database\seeders\CategorySeeder;
use Modules\Quote\database\seeders\QuoteSeeder;

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
        ]);
    }
}
