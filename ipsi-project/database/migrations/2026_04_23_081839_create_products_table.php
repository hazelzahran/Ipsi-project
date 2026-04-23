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
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('condition', 32);
            $table->string('size', 32)->nullable();
            $table->string('category', 64)->nullable()->index();
            $table->decimal('price', 12, 2);
            $table->unsignedInteger('stock')->default(1);
            $table->string('status', 32)->default('available')->index();
            $table->string('primary_image_path')->nullable();
            $table->timestamp('locked_until')->nullable()->index();
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
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
