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
            $table->foreignId('seller_id')->constrained()->cascadeOnDelete();
            $table->foreignId('transaction_id')->nullable()->constrained()->nullOnDelete();
            $table->string('plan_slug', 100);
            $table->string('plan_name');
            $table->unsignedBigInteger('price_amount');
            $table->string('currency', 3)->default('XOF');
            $table->json('features')->nullable();
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->enum('status', ['active', 'expired', 'cancelled'])->default('active');
            $table->boolean('auto_renew')->default(false);
            $table->timestamp('cancelled_at')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index('seller_id');
            $table->index('plan_slug');
            $table->index('status');
            $table->index('end_date');
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
