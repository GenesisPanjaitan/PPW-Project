<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop existing foreign keys that don't have onDelete cascade
        
        // Drop favorite table foreign keys
        Schema::table('favorite', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['recruitment_id']);
        });
        
        // Drop recruitment table foreign keys
        Schema::table('recruitment', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        
        // Now recreate them with onDelete cascade
        
        // Recreate favorite foreign keys
        Schema::table('favorite', function (Blueprint $table) {
            $table->foreign('user_id')
                  ->references('id')
                  ->on('user')
                  ->onDelete('cascade');
            $table->foreign('recruitment_id')
                  ->references('id')
                  ->on('recruitment')
                  ->onDelete('cascade');
        });
        
        // Recreate recruitment foreign keys
        Schema::table('recruitment', function (Blueprint $table) {
            $table->foreign('user_id')
                  ->references('id')
                  ->on('user')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the cascading foreign keys
        
        Schema::table('favorite', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['recruitment_id']);
        });
        
        Schema::table('recruitment', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        
        // Recreate them without cascade (original behavior)
        
        Schema::table('favorite', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('recruitment_id')->references('id')->on('recruitment');
        });
        
        Schema::table('recruitment', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('user');
        });
    }
};
