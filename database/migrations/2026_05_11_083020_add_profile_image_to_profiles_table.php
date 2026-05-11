<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations (Jab hum command chalate hain).
     */
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            // Is line ko 'up' function ke andar likha jata hai
            $table->string('profile_image')->nullable(); 
        });
    }

    /**
     * Reverse the migrations (Wapas khatam karne ke liye).
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('profile_image');
        });
    }
};