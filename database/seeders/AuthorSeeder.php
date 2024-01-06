<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = [
            ['None', ''],
            ['Me', ''],
            ['Wladimir', 'Klitschko'],
            ['Robert', 'Kiyosaki'],
            ['Mike', 'Tyson'],
            ['Karl', 'Niilo'],
            ['Zlatan', 'Ibrahimovic'],
            ['Khabib', 'Nurmahomedov'],
            ['Cesar', ''],
            ['Floyd', 'Mayweather'],
            ['Max', 'Schemeling'],
            ['Oleh', 'Tinkov'],
            ['Walt', 'Disney'],
            ['Joshua', 'Marine'],
            ['Malcolm', 'X'],
            ['Conor', 'McGregor'],
            ['Marhulan', 'Seisembai'],
            ['Maksim', 'Zhashkevych'],
            ['Alessandra', 'Ambrosio'],
        ];
        array_map(function ($author) {
            DB::table('authors')->insert([
                'first_name' => $author[0],
                'last_name' => $author[1],
            ]);
        }, $authors);
    }
}
