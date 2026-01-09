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
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // students, teachers, finance, library
            $table->string('slug')->unique(); // students, teachers, finance, library
            $table->string('label'); // Students Management, Teachers Management
            $table->text('description')->nullable();
            $table->string('icon')->nullable(); // Icon class or path
            $table->string('route_prefix')->nullable(); // Route prefix for the module
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
