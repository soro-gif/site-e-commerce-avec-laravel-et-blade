<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Collection;
use App\Models\Product;
use App\Models\Page;
class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        $collections = Collection::all();
        $newArrivals = Product::where('isNewArrival', "true")->orderBy("id", "desc")->get();
        $bestSellers = Product::where('isBestSeller', "true")->orderBy("id", "desc")->get();
        $featured = Product::where('isFeatured', "true")->orderBy("id", "desc")->get();
        $specialOffers = Product::where('isSpecialOffer', "true")->orderBy("id", "desc")->get();
    
        return view('home', [
        'banners' => $banners, 
        'collections' => $collections, 
        'newArrivals' => $newArrivals, 
        'bestSellers' => $bestSellers, 
        'featured' => $featured,
        'specialOffers' => $specialOffers
        ]);
    }
    public function showPage( string $slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('lstore.page', ['page' => $page]);
    }
    public function showProduct( string $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('lstore.product', ['product' => $product]);
    }
}
