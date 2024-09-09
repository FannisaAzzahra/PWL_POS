<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Barang untuk kategori Elektronik
            ['barang_id' => 1, 'kategori_id' => 1, 'barang_kode' => 'B001', 'barang_nama' => 'Televisi', 'harga_beli' => 2000000, 'harga_jual' => 2500000],
            ['barang_id' => 2, 'kategori_id' => 1, 'barang_kode' => 'B002', 'barang_nama' => 'Kulkas', 'harga_beli' => 3000000, 'harga_jual' => 3500000],
            ['barang_id' => 3, 'kategori_id' => 1, 'barang_kode' => 'B003', 'barang_nama' => 'AC', 'harga_beli' => 1500000, 'harga_jual' => 2000000],
            
            // Barang untuk kategori Pakaian
            ['barang_id' => 4, 'kategori_id' => 2, 'barang_kode' => 'B004', 'barang_nama' => 'Kaos', 'harga_beli' => 50000, 'harga_jual' => 75000],
            ['barang_id' => 5, 'kategori_id' => 2, 'barang_kode' => 'B005', 'barang_nama' => 'Jaket', 'harga_beli' => 150000, 'harga_jual' => 200000],
            ['barang_id' => 6, 'kategori_id' => 2, 'barang_kode' => 'B006', 'barang_nama' => 'Celana', 'harga_beli' => 70000, 'harga_jual' => 100000],
            
            // Barang untuk kategori Makanan
            ['barang_id' => 7, 'kategori_id' => 3, 'barang_kode' => 'B007', 'barang_nama' => 'Biskuit', 'harga_beli' => 20000, 'harga_jual' => 30000],
            ['barang_id' => 8, 'kategori_id' => 3, 'barang_kode' => 'B008', 'barang_nama' => 'Susu', 'harga_beli' => 15000, 'harga_jual' => 20000],
            ['barang_id' => 9, 'kategori_id' => 3, 'barang_kode' => 'B009', 'barang_nama' => 'Roti', 'harga_beli' => 25000, 'harga_jual' => 35000],
            
            // Barang untuk kategori Kecantikan
            ['barang_id' => 10, 'kategori_id' => 4, 'barang_kode' => 'B010', 'barang_nama' => 'Shampoo', 'harga_beli' => 30000, 'harga_jual' => 50000],
            ['barang_id' => 11, 'kategori_id' => 4, 'barang_kode' => 'B011', 'barang_nama' => 'Sabun Mandi', 'harga_beli' => 20000, 'harga_jual' => 35000],
            ['barang_id' => 12, 'kategori_id' => 4, 'barang_kode' => 'B012', 'barang_nama' => 'Lipstik', 'harga_beli' => 50000, 'harga_jual' => 75000],
            
            // Barang untuk kategori Peralatan Rumah Tangga
            ['barang_id' => 13, 'kategori_id' => 5, 'barang_kode' => 'B013', 'barang_nama' => 'Blender', 'harga_beli' => 250000, 'harga_jual' => 300000],
            ['barang_id' => 14, 'kategori_id' => 5, 'barang_kode' => 'B014', 'barang_nama' => 'Oven', 'harga_beli' => 500000, 'harga_jual' => 600000],
            ['barang_id' => 15, 'kategori_id' => 5, 'barang_kode' => 'B015', 'barang_nama' => 'Setrika', 'harga_beli' => 100000, 'harga_jual' => 150000],
        ];
        DB::table('m_barang')->insert($data);
    }
}
