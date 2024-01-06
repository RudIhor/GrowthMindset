<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'willpower',
            'mindset',
            'problems',
            'god',
            'dreams',
            'action',
            'effort',
            'hardworking',
            'myself',
            'trying',
            'courage',
            'self-compassion',
            'mistakes',
            'hapinnes',
            'comfort zone',
            'work',
            'money',
            'never give up',
            'regret',
            'goals',
            'health',
            'medical',
            'risks',
            'self-sacrifice',
            'do what you want',
            'mental',
            'dedication',
            'time',
            'nofap',
            'consistency',
            'family',
            'business',
            'wealth',
            'success',
            'optimism',
            'strength',
            'truth',
            'solo',
            'investing',
            'work out',
            'passion',
            'stress',
            'challenges',
            'education',
        ];
        array_map(function ($tag) {
            DB::table('tags')->insert([
                'name' => $tag
            ]);
        }, $tags);
    }
}
