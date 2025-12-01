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
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique(); // Tambahkan unique agar email tidak duplikat
            $table->string('password');
            
            // Jadikan nullable jika data ini opsional saat register awal
            $table->string('nim')->nullable(); 
            $table->string('study_program')->nullable();
            $table->string('class')->nullable();
            
            $table->string('image')->nullable(); // Foto profil biasanya opsional di awal
            $table->string('interest')->nullable();
            $table->string('field')->nullable();
            
            // PERBAIKAN UTAMA: Ganti integer jadi string
            $table->string('contact')->nullable(); 
            
            $table->enum('role', ['admin', 'mahasiswa', 'alumni']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};