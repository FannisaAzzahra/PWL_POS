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
        Schema::table('m_supplier', function (Blueprint $table) {
            $table->string('notelp', 15)->nullable()->after('supplier_alamat'); // Add notelp after supplier_alamat
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('m_supplier', function (Blueprint $table) {
            //
        });
    }
};
