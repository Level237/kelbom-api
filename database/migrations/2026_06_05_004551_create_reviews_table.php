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
        Schema::create('reviews', function (Blueprint $table) {
           $table->id();
            $table->string('reviewable_type');            // App\Models\Seller, App\Models\DeliveryPerson
            $table->unsignedBigInteger('reviewable_id');
            $table->foreignId('buyer_id')->constrained('users')->cascadeOnDelete();
            $table->unsignedTinyInteger('rating');
            $table->text('comment')->nullable();
            $table->text('seller_response')->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->softDeletes();
            $table->timestamps();

            // Index polymorphe
            $table->index(['reviewable_type', 'reviewable_id']);
            // Un buyer ne laisse qu'un avis par entité
            $table->unique(['buyer_id', 'reviewable_type', 'reviewable_id']);
            $table->index('buyer_id');
            $table->index('rating');
            $table->index('is_verified');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
