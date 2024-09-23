<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['supplier_id' => 1, 'supplier_kode' => 'S001', 'supplier_nama' => 'Supplier A', 'supplier_alamat' => 'Alamat A', 'notelp' => '081234567890'],
            ['supplier_id' => 2, 'supplier_kode' => 'S002', 'supplier_nama' => 'Supplier B', 'supplier_alamat' => 'Alamat B', 'notelp' => '082345678901'],
            ['supplier_id' => 3, 'supplier_kode' => 'S003', 'supplier_nama' => 'Supplier C', 'supplier_alamat' => 'Alamat C', 'notelp' => '083456789012'],
        ];
        DB::table('m_supplier')->insert($data);
    }
}