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
        Schema::create('stands', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('stand_name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('logo_url')->nullable();
            $table->string('cover_url')->nullable();
            $table->string('website_url')->nullable();
            $table->string('whatsapp_number', 20)->nullable();
            $table->boolean('is_verified')->default(false);
            $table->decimal('rating_avg', 2, 1)->default(0.0);
            $table->unsignedInteger('total_reviews')->default(0);
            $table->string('contact_email')->nullable();
            $table->string('contact_phone', 20)->nullable();
            $table->text('address')->nullable();
            $table->string('city', 100);
            $table->string('country', 100)->default('Togo');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->unsignedInteger('total_leads_viewed')->default(0);
            $table->unsignedInteger('total_leads_won')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->index('slug');
            $table->index('city');
            $table->index('is_verified');
            $table->index('rating_avg');
            // Index composite pour la recherche géolocalisée
            $table->index(['latitude', 'longitude']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stands');
    }
};
