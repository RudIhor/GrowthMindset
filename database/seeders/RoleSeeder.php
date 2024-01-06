<?php

namespace Database\Seeders;

use App\Enums\RoleType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'name' => RoleType::USER,
            ],
            [
                'name' => RoleType::ADMIN,
            ],
        ]);
    }
}
