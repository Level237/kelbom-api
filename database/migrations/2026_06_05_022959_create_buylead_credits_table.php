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
        Schema::create('buylead_credits', function (Blueprint $table) {
             $table->id();
            $table->foreignId('seller_id')->unique()->constrained()->cascadeOnDelete();
            $table->integer('available_credits')->default(0);
            $table->integer('total_purchased')->default(0);
            $table->integer('total_consumed')->default(0);
            $table->timestamp('last_updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buylead_credits');
    }
};
