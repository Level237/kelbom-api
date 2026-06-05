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
        Schema::create('delivery_people', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('slug')->unique();
            $table->string('company_name')->nullable();
            $table->enum('vehicle_type', ['motorcycle', 'bicycle', 'car', 'van', 'truck', 'other'])->default('motorcycle');
            $table->string('vehicle_photo_url')->nullable();
            $table->text('service_area')->nullable();
            $table->json('cities_served')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->string('id_document_url')->nullable();
            $table->boolean('is_available')->default(true);
            $table->decimal('rating_avg', 2, 1)->default(0.0);
            $table->unsignedInteger('total_reviews')->default(0);
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index('slug');
            $table->index('vehicle_type');
            $table->index('is_verified');
            $table->index('is_available');
            $table->index('rating_avg');
            $table->index(['latitude', 'longitude']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_people');
    }
};
