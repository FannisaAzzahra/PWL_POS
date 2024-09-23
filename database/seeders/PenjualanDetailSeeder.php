<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Menyesuaikan dengan barang_id yang ada di BarangSeeder
            ['detail_id' => 1, 'penjualan_id' => 1, 'barang_id' => 1, 'harga' => 2500000, 'jumlah' => 1], // Televisi
            ['detail_id' => 2, 'penjualan_id' => 1, 'barang_id' => 2, 'harga' => 3500000, 'jumlah' => 1], // Kulkas
            ['detail_id' => 3, 'penjualan_id' => 1, 'barang_id' => 3, 'harga' => 2000000, 'jumlah' => 1], // AC

            ['detail_id' => 4, 'penjualan_id' => 2, 'barang_id' => 4, 'harga' => 75000, 'jumlah' => 2], // Kaos
            ['detail_id' => 5, 'penjualan_id' => 2, 'barang_id' => 5, 'harga' => 200000, 'jumlah' => 1], // Jaket
            ['detail_id' => 6, 'penjualan_id' => 2, 'barang_id' => 6, 'harga' => 100000, 'jumlah' => 1], // Celana

            ['detail_id' => 7, 'penjualan_id' => 3, 'barang_id' => 7, 'harga' => 30000, 'jumlah' => 3], // Biskuit
            ['detail_id' => 8, 'penjualan_id' => 3, 'barang_id' => 8, 'harga' => 20000, 'jumlah' => 2], // Susu
            ['detail_id' => 9, 'penjualan_id' => 3, 'barang_id' => 9, 'harga' => 35000, 'jumlah' => 1], // Roti

            ['detail_id' => 10, 'penjualan_id' => 4, 'barang_id' => 10, 'harga' => 50000, 'jumlah' => 1], // Shampoo
            ['detail_id' => 11, 'penjualan_id' => 4, 'barang_id' => 11, 'harga' => 35000, 'jumlah' => 2], // Sabun Mandi
            ['detail_id' => 12, 'penjualan_id' => 4, 'barang_id' => 12, 'harga' => 75000, 'jumlah' => 1], // Lipstik

            ['detail_id' => 13, 'penjualan_id' => 5, 'barang_id' => 13, 'harga' => 300000, 'jumlah' => 1], // Blender
            ['detail_id' => 14, 'penjualan_id' => 5, 'barang_id' => 14, 'harga' => 600000, 'jumlah' => 1], // Oven
            ['detail_id' => 15, 'penjualan_id' => 5, 'barang_id' => 15, 'harga' => 150000, 'jumlah' => 2], // Setrika

            ['detail_id' => 16, 'penjualan_id' => 6, 'barang_id' => 1, 'harga' => 1200000, 'jumlah' => 1], // Televisi
            ['detail_id' => 17, 'penjualan_id' => 6, 'barang_id' => 2, 'harga' => 800000, 'jumlah' => 2], // Kulkas
            ['detail_id' => 18, 'penjualan_id' => 6, 'barang_id' => 7, 'harga' => 50000, 'jumlah' => 5], // Biskuit

            ['detail_id' => 19, 'penjualan_id' => 7, 'barang_id' => 7, 'harga' => 45000, 'jumlah' => 3], // Biskuit
            ['detail_id' => 20, 'penjualan_id' => 7, 'barang_id' => 8, 'harga' => 70000, 'jumlah' => 2], // Susu
            ['detail_id' => 21, 'penjualan_id' => 7, 'barang_id' => 9, 'harga' => 60000, 'jumlah' => 1], // Roti

            ['detail_id' => 22, 'penjualan_id' => 8, 'barang_id' => 10, 'harga' => 230000, 'jumlah' => 4], // Shampoo
            ['detail_id' => 23, 'penjualan_id' => 8, 'barang_id' => 11, 'harga' => 180000, 'jumlah' => 2], // Sabun Mandi
            ['detail_id' => 24, 'penjualan_id' => 8, 'barang_id' => 12, 'harga' => 95000, 'jumlah' => 1], // Lipstik

            ['detail_id' => 25, 'penjualan_id' => 9, 'barang_id' => 13, 'harga' => 550000, 'jumlah' => 2], // Blender
            ['detail_id' => 26, 'penjualan_id' => 9, 'barang_id' => 14, 'harga' => 300000, 'jumlah' => 3], // Oven
            ['detail_id' => 27, 'penjualan_id' => 9, 'barang_id' => 15, 'harga' => 450000, 'jumlah' => 1], // Setrika

            ['detail_id' => 28, 'penjualan_id' => 10, 'barang_id' => 13, 'harga' => 110000, 'jumlah' => 2], // Blender
            ['detail_id' => 29, 'penjualan_id' => 10, 'barang_id' => 14, 'harga' => 120000, 'jumlah' => 1], // Oven
            ['detail_id' => 30, 'penjualan_id' => 10, 'barang_id' => 15, 'harga' => 130000, 'jumlah' => 3], // Setrika
        ];

        // Insert data into table
        DB::table('t_penjualan_detail')->insert($data);
    }
}