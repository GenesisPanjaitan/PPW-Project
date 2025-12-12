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
        Schema::table('user', function (Blueprint $table) {
            // Drop existing unique constraint on email
            $table->dropUnique('user_email_unique');
            
            // Add composite unique constraint on email + login_method
            $table->unique(['email', 'login_method'], 'user_email_login_method_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user', function (Blueprint $table) {
            // Drop composite unique constraint
            $table->dropUnique('user_email_login_method_unique');
            
            // Restore unique constraint on email only
            $table->unique('email', 'user_email_unique');
        });
    }
};
