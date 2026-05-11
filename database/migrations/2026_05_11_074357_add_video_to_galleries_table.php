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
        Schema::table('galleries', function (Blueprint $table) {
            // Video ke liye naye columns yahan add ho rahe hain
            $table->string('video_url')->nullable(); // YouTube/Vimeo links ke liye
            $table->string('video_path')->nullable(); // Direct MP4 upload ke liye
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            // Rollback ke waqt ye columns khatam ho jayenge
            $table->dropColumn(['video_url', 'video_path']);
        });
    }
};