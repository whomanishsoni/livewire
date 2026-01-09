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
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Basic, Premium, Enterprise
            $table->string('slug')->unique(); // basic, premium, enterprise
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2); // Monthly price
            $table->string('billing_period')->default('monthly'); // monthly, yearly
            $table->integer('max_users')->nullable(); // Maximum users allowed
            $table->integer('max_storage_gb')->nullable(); // Storage limit
            $table->json('features')->nullable(); // Additional features
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
        Schema::dropIfExists('subscription_plans');
    }
};
