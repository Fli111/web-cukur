<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberTiersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data ini akan mengisi tabel `member_tiers`
        // yang digunakan di BookingController untuk menghitung diskon.
        DB::table('member_tiers')->insert([
            [
                'tier' => 'gold',
                'diskon_cukur' => 10, // Diskon 10%
                'diskon_produk' => 5,
            ],
            [
                'tier' => 'platinum',
                'diskon_cukur' => 15, // Diskon 15%
                'diskon_produk' => 10,
            ],
            [
                'tier' => 'diamond',
                'diskon_cukur' => 25, // Diskon 25%
                'diskon_produk' => 15,
            ],
        ]);
    }
}