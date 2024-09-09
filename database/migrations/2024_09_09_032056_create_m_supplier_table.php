<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('m_supplier', function (Blueprint $table) {
            $table->id('supplier_id'); // Primary key
            $table->string('supplier_kode', 10)->unique(); // Unique code for supplier
            $table->string('supplier_nama', 100); // Supplier name
            $table->string('supplier_alamat', 255); // Supplier address
            $table->string('notelp', 15)->nullable()->after('supplier_alamat'); // Add notelp after supplier_alamat
            $table->timestamps(); // Created at & Updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_supplier');
    }
};
