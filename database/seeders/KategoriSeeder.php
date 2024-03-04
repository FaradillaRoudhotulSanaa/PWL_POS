<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $data = [
            [
                'kategori_id' => 1,
                'kategori_kode' => 'bah',
                'kategori_nama' => 'BeautyAndHealth',
            ],
            [
                'kategori_id' => 2,
                'kategori_kode' => 'hc',
                'kategori_nama' => 'HomeCare',
            ],
            [
                'kategori_id' => 3,
                'kategori_kode' => 'snk',
                'kategori_nama' => 'Snack',
            ],
            [
                'kategori_id' => 4,
                'kategori_kode' => 'elk',
                'kategori_nama' => 'Elektronik',
            ],
            [
                'kategori_id' => 5,
                'kategori_kode' => 'pkn',
                'kategori_nama' => 'Pakaian',
            ]
            ];
            DB::table('m_kategori')->insert($data);
    }
}
