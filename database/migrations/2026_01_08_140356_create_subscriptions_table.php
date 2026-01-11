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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('school_id');
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
            $table->foreignId('subscription_plan_id')->constrained()->onDelete('cascade');
            $table->dateTime('starts_at');
            $table->dateTime('ends_at')->nullable();
            $table->string('status')->default('active'); // active, expired, cancelled, trial
            $table->decimal('price', 10, 2)->nullable(); // Price at time of subscription
            $table->string('billing_period')->default('monthly');
            $table->json('metadata')->nullable(); // Additional subscription data
            $table->timestamps();

            $table->unique(['school_id', 'subscription_plan_id']); // One active subscription per plan per school
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
