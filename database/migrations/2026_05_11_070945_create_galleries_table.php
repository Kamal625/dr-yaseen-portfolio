<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Event ya Image ka title
            $table->string('image_path'); // Image file ka rasta
            $table->text('description')->nullable(); // Event ki tafseel
            $table->enum('type', ['conference', 'event', 'activity', 'other'])->default('event');
            $table->date('event_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};