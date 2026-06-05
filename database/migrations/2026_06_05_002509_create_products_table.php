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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stand_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->restrictOnDelete();
            $table->string('slug');
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('compare_at_price')->nullable();
            $table->unsignedInteger('min_order_quantity')->default(1);
            $table->string('unit', 50)->nullable();
            $table->json('specifications')->nullable();
            $table->string('main_image_url')->nullable();
            $table->enum('status', ['active', 'inactive', 'draft'])->default('draft');
            $table->unsignedInteger('views_count')->default(0);
            $table->unsignedInteger('inquiries_count')->default(0);
            $table->softDeletes();
            $table->timestamps();

            // Slug unique par vendeur (composite)
            $table->unique(['slug', 'stand_id']);
            $table->index(['stand_id', 'status']);
            $table->index('category_id');
            $table->index('price');
            $table->index('status');
            $table->index('views_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
