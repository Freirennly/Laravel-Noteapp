<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class NotesTableSeeder extends Seeder
{
    public function run(): void
    {
        $belajarId = Category::where('name', 'Belajar')->first()->id;
        $belanjaId = Category::where('name', 'Belanja')->first()->id;
        $kerjaId   = Category::where('name', 'Kerja')->first()->id;

        DB::table('notes')->insert([
            [
                'title' => 'Belajar Laravel',
                'content' => 'Mempelajari dasar-dasar Laravel.',
                'created_date' => '2025-09-30',
                'is_pinned' => false,
                'category_id' => $belajarId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Beli Buku',
                'content' => 'Membeli buku di toko online.',
                'created_date' => '2025-10-01',
                'is_pinned' => true,
                'category_id' => $belanjaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Meeting Proyek',
                'content' => 'Diskusi tentang proyek Laravel.',
                'created_date' => '2025-10-02',
                'is_pinned' => false,
                'category_id' => $kerjaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
