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
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Publication ka naam
            $table->enum('category', ['scholarly', 'creative'])->default('scholarly'); // Scholarly vs Creative Yaseen
            $table->text('description')->nullable(); // Summary ya intro
            $table->string('link')->nullable(); // External journal ya book link
            $table->string('file_path')->nullable(); // PDF file path
            $table->text('citation')->nullable(); // APA/MLA citation text
            $table->date('published_at')->nullable(); // Publishing date
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};