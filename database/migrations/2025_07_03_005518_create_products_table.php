<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('model_name');
            $table->string('serial_number')->nullable();
            $table->foreignId('category_id')->constrained('product_categories');
            $table->json('image_urls')->nullable(); // Multiple product images
            $table->json('specs_si')->nullable(); // SI specifications
            $table->json('specs_imperial')->nullable(); // Imperial specifications
            $table->text('description_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->json('features')->nullable(); // Product features
            $table->json('applications')->nullable(); // Use cases (Mining, Construction, etc.)
            $table->string('brochure_url')->nullable();
            $table->string('manual_url')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->enum('status', ['active', 'discontinued', 'coming_soon'])->default('active');
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->timestamps();

            $table->index(['status', 'is_featured']);
            $table->index('model_name');
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
