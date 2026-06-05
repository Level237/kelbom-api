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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stand_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->restrictOnDelete();
            $table->string('slug');
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('price_type', ['hourly', 'fixed', 'quote']);
            $table->unsignedBigInteger('base_price')->nullable();
            $table->string('delivery_method')->nullable();
            $table->string('service_area')->nullable();
            $table->json('portfolio_json')->nullable();
            $table->string('main_image_url')->nullable();
            $table->enum('status', ['active', 'inactive', 'draft'])->default('draft');
            $table->unsignedInteger('inquiries_count')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['slug', 'stand_id']);
            $table->index(['stand_id', 'status']);
            $table->index('category_id');
            $table->index('price_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
