<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Belajar'],
            ['id' => 2, 'name' => 'Belanja'],
            ['id' => 3, 'name' => 'Kerja'],
        ]);
    }
}
