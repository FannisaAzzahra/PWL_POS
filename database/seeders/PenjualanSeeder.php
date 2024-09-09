<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['penjualan_id' => 1, 'user_id' => 1, 'pembeli' => 'Customer A', 'penjualan_kode' => 'P001', 'penjualan_tanggal' => Carbon::now()->subDays(10)],
            ['penjualan_id' => 2, 'user_id' => 1, 'pembeli' => 'Customer B', 'penjualan_kode' => 'P002', 'penjualan_tanggal' => Carbon::now()->subDays(9)],
            ['penjualan_id' => 3, 'user_id' => 1, 'pembeli' => 'Customer C', 'penjualan_kode' => 'P003', 'penjualan_tanggal' => Carbon::now()->subDays(8)],
            ['penjualan_id' => 4, 'user_id' => 1, 'pembeli' => 'Customer D', 'penjualan_kode' => 'P004', 'penjualan_tanggal' => Carbon::now()->subDays(7)],
            ['penjualan_id' => 5, 'user_id' => 1, 'pembeli' => 'Customer E', 'penjualan_kode' => 'P005', 'penjualan_tanggal' => Carbon::now()->subDays(6)],
            ['penjualan_id' => 6, 'user_id' => 1, 'pembeli' => 'Customer F', 'penjualan_kode' => 'P006', 'penjualan_tanggal' => Carbon::now()->subDays(5)],
            ['penjualan_id' => 7, 'user_id' => 1, 'pembeli' => 'Customer G', 'penjualan_kode' => 'P007', 'penjualan_tanggal' => Carbon::now()->subDays(4)],
            ['penjualan_id' => 8, 'user_id' => 1, 'pembeli' => 'Customer H', 'penjualan_kode' => 'P008', 'penjualan_tanggal' => Carbon::now()->subDays(3)],
            ['penjualan_id' => 9, 'user_id' => 1, 'pembeli' => 'Customer I', 'penjualan_kode' => 'P009', 'penjualan_tanggal' => Carbon::now()->subDays(2)],
            ['penjualan_id' => 10, 'user_id' => 1, 'pembeli' => 'Customer J', 'penjualan_kode' => 'P010', 'penjualan_tanggal' => Carbon::now()->subDay()],
        ];
        DB::table('t_penjualan')->insert($data);
    }
}
