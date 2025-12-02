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
        Schema::create('notification_reads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->timestamp('last_read_mahasiswa')->nullable();
            $table->timestamp('last_read_alumni')->nullable();
            $table->timestamp('last_read_lowongan')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->unique('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_reads');
    }
};  