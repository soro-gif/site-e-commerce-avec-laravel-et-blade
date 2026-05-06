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
		Schema::create('tags', function (Blueprint $table) {
        	$table->id();
        	$table->string('name');
			$table->string('description')->nullable();
			$table->string('imageUrl')->nullable();
        	$table->timestamps();
        });

		Schema::create('product_tag', function (Blueprint $table) {
                    $table->foreignIdFor(\App\Models\Tag::class)->constrained()->onDelete('cascade');
                    $table->foreignIdFor(\App\Models\Product::class)->constrained()->onDelete('cascade');
                    $table->primary(['tag_id','product_id']);
                });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};
