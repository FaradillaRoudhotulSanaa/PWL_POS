<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $data = [
            [
                'penjualan_id' => 1,
                'user_id' => 3,
                'pembeli' => 'Lee Haechan',
                'penjualan_tanggal' => '2024-06-06 12:07:00',
            ], 
            [
                'penjualan_id' => 2,
                'user_id' => 3,
                'pembeli' => 'Lee Jeno',
                'penjualan_tanggal' => '2024-06-06 12:09:00',
            ],
            [
                'penjualan_id' => 3,
                'user_id' => 3,
                'pembeli' => 'Lee Mark',
                'penjualan_tanggal' => '2024-06-06 12:11:00',
            ],
            [
                'penjualan_id' => 4,
                'user_id' => 3,
                'pembeli' => 'Park Jisung',
                'penjualan_tanggal' => '2024-06-06 12:13:00',
            ],
            [
                'penjualan_id' => 5,
                'user_id' => 3,
                'pembeli' => 'Zhong Chenle',
                'penjualan_tanggal' => '2024-06-06 12:15:00',
            ],
            [
                'penjualan_id' => 6,
                'user_id' => 3,
                'pembeli' => 'Huang Renjun',
                'penjualan_tanggal' => '2024-06-06 12:17:00',
            ],
            [
                'penjualan_id' => 7,
                'user_id' => 3,
                'pembeli' => 'Na Jaemin',
                'penjualan_tanggal' => '2024-06-06 12:19:00',
            ],
            [
                'penjualan_id' => 8,
                'user_id' => 3,
                'pembeli' => 'Jung Jaehyun',
                'penjualan_tanggal' => '2024-06-06 12:21:00',
            ],
            [
                'penjualan_id' => 9,
                'user_id' => 3,
                'pembeli' => 'Johnny Suh',
                'penjualan_tanggal' => '2024-06-06 12:23:00',
            ],
            [
                'penjualan_id' => 10,
                'user_id' => 3,
                'pembeli' => 'Kim Jungwoo',
                'penjualan_tanggal' => '2024-06-06 12:25:00',
            ]
            ];
            DB::table('t_penjualan')->insert($data);
    }
}
