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
        Schema::create('m_user', function (Blueprint $table) {
            $table->id('user_id'); // Primary key
            $table->unsignedBigInteger('level_id'); // Foreign key to m_level
            $table->string('username', 20)->unique(); // Unique username
            $table->string('nama', 100); // User's name
            $table->string('password'); // User's password (hashed)
            $table->timestamps(); // Created at & Updated at

            // Mendefinisikan Foreign Key pada kolom level_id di table m_level
            $table->foreign('level_id')->references('level_id')->on('m_level')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_user');
    }
};
