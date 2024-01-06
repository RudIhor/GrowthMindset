<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuoteTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            [],
            [1, 2, 6],
            [7, 8],
            [2, 9, 28],
            [1],
            [3, 4],
            [31, 33],
            [17, 33],
            [20],
            [2, 26],
            [11],
            [43],
            [44],
            [2, 18, 19, 28],
            [35],
            [8, 42],
            [2],
            [5, 6],
            [2],
            [2, 26],
            [10, 11],
            [36],
            [28],
            [15],
            [2, 26],
            [7, 28, 34],
        ];
        for ($i = 1; $i < count($tags); $i++) {
            for ($j = 0; $j < count($tags[$i]); $j++) {
                DB::table('quote_tag')->insert([
                    'quote_id' => $i,
                    'tag_id' => $tags[$i][$j],
                ]);
            }
        }
    }
}
