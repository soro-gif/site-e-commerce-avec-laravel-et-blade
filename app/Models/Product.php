<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

	public function categories()
	{
		
		return $this->belongsToMany(\App\Models\Category::class);
	
	}

	protected $casts = [
		'imageUrls' => 'json',
	];
public function imageUrls(): array
{
    return is_array($this->imageUrls) 
        ? $this->imageUrls 
        : (json_decode($this->imageUrls, true) ?? []);
}
	protected $fillable = ['name', 'slug', 'description', 'moreDescription', 'additionalInfos', 'stock', 'soldePrice', 'regularPrice', 'imageUrls', 'brand', 'isAvailable', 'isBestSeller', 'isNewArrival', 'isFeatured', 'isSpecialOffer'];
}
