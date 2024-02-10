<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DecisiveStatementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('decisive_statements')->insert([
            'content' => 'The habit of consuming sweets can lead to serious consequences for my health.',
            'category_id' => '11',
        ]);
    }
}
