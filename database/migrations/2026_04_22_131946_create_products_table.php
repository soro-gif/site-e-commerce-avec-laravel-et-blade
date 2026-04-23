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
			$table->string('slug');
			$table->text('description');
			$table->text('moreDescription');
			$table->longtext('additionalInfos')->nullable();
			$table->integer('stock');
			$table->integer('soldePrice');
			$table->integer('regularPrice');
			$table->json('imageUrls');
			$table->string('brand')->nullable();
			$table->boolean('isAvailable')->default(false);
			$table->boolean('isBestSeller')->default(false);
			$table->boolean('isNewArrival')->default(false);
			$table->boolean('isFeatured')->default(false);
			$table->boolean('isSpecialOffer')->default(false);
        	$table->timestamps();
        });

		Schema::create('category_product', function (Blueprint $table) {
                    $table->foreignIdFor(\App\Models\Product::class)->constrained()->onDelete('cascade');
                    $table->foreignIdFor(\App\Models\Category::class)->constrained()->onDelete('cascade');
                    $table->primary(['product_id','category_id']);
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
