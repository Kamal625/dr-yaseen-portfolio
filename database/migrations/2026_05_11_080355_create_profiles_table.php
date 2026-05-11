<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->text('research_interests')->nullable(); // Module 1: Specific Niche
            $table->string('google_scholar')->nullable();
            $table->string('researchgate')->nullable();
            $table->string('orcid')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('substack')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};