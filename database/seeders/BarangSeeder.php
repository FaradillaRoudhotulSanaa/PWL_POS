<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $data = [
            [
                'barang_id' => 1,
                'kategori_id' => 5,
                'barang_kode' => 'swt',
                'barang_nama' => 'Sweater',
                'harga_beli' => 158000,
                'harga_jual' => 178000,
            ],
            [
                'barang_id' => 2,
                'kategori_id' => 5,
                'barang_kode' => 'cln',
                'barang_nama' => 'Boyfriend Jeans',
                'harga_beli' => 255000,
                'harga_jual' => 355000,
            ],
            [
                'barang_id' => 3,
                'kategori_id' => 4,
                'barang_kode' => 'tv',
                'barang_nama' => 'Televisi',
                'harga_beli' => 3500000,
                'harga_jual' => 3700000,
            ],
            [
                'barang_id' => 4,
                'kategori_id' => 4,
                'barang_kode' => 'spk',
                'barang_nama' => 'Speaker',
                'harga_beli' => 587000,
                'harga_jual' => 687000,
            ],
            [
                'barang_id' => 5,
                'kategori_id' => 3,
                'barang_kode' => 'ckt',
                'barang_nama' => 'Dark Coklat',
                'harga_beli' => 65000,
                'harga_jual' => 75000,
            ],
            [
                'barang_id' => 6,
                'kategori_id' => 3,
                'barang_kode' => 'ck',
                'barang_nama' => 'Ciki',
                'harga_beli' => 20000,
                'harga_jual' => 25000,
            ],
            [
                'barang_id' => 7,
                'kategori_id' => 2,
                'barang_kode' => 'sbn',
                'barang_nama' => 'Sabun Laundry',
                'harga_beli' => 120000,
                'harga_jual' => 125000,
            ],
            [
                'barang_id' => 8,
                'kategori_id' => 2,
                'barang_kode' => 'pwg',
                'barang_nama' => 'Pewangi Ruangan',
                'harga_beli' => 78000,
                'harga_jual' => 88000,
            ],
            [
                'barang_id' => 9,
                'kategori_id' => 1,
                'barang_kode' => 'fcw',
                'barang_nama' => 'Facial Wash',
                'harga_beli' => 50000,
                'harga_jual' => 75000,
            ],
            [
                'barang_id' => 10,
                'kategori_id' => 1,
                'barang_kode' => 'mcw',
                'barang_nama' => 'Micellar Water',
                'harga_beli' => 45000,
                'harga_jual' => 50000,
            ]
            ];
            DB::table('m_barang')->insert($data);
    }
}
