<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::prefix('admin')->name('admin.')->group(function(){

    //Get Categories datas
    Route::get('/categories', 'App\Http\Controllers\CategoryController@index')->name('category.index');

    //Show Category by Id
    Route::get('/categories/show/{id}', 'App\Http\Controllers\CategoryController@show')->name('category.show');

    //Get Categories by Id
    Route::get('/categories/create', 'App\Http\Controllers\CategoryController@create')->name('category.create');

    //Edit Category by Id
    Route::get('/categories/edit/{id}', 'App\Http\Controllers\CategoryController@edit')->name('category.edit');

    //Save new Category
    Route::post('/categories/store', 'App\Http\Controllers\CategoryController@store')->name('category.store');

    //Update One Category
    Route::put('/categories/update/{category}', 'App\Http\Controllers\CategoryController@update')->name('category.update');

    //Update One Category Speedly
    Route::put('/categories/speed/{category}', 'App\Http\Controllers\CategoryController@updateSpeed')->name('category.update.speed');

    //Delete Category
    Route::delete('/categories/delete/{category}', 'App\Http\Controllers\CategoryController@delete')->name('category.delete');

});
Route::prefix('admin')->name('admin.')->group(function(){

    //Get Products datas
    Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('product.index');

    //Show Product by Id
    Route::get('/products/show/{id}', 'App\Http\Controllers\ProductController@show')->name('product.show');

    //Get Products by Id
    Route::get('/products/create', 'App\Http\Controllers\ProductController@create')->name('product.create');

    //Edit Product by Id
    Route::get('/products/edit/{id}', 'App\Http\Controllers\ProductController@edit')->name('product.edit');

    //Save new Product
    Route::post('/products/store', 'App\Http\Controllers\ProductController@store')->name('product.store');

    //Update One Product
    Route::put('/products/update/{product}', 'App\Http\Controllers\ProductController@update')->name('product.update');

    //Update One Product Speedly
    Route::put('/products/speed/{product}', 'App\Http\Controllers\ProductController@updateSpeed')->name('product.update.speed');

    //Delete Product
    Route::delete('/products/delete/{product}', 'App\Http\Controllers\ProductController@delete')->name('product.delete');

});
Route::prefix('admin')->name('admin.')->group(function(){

    //Get Users datas
    Route::get('/users', 'App\Http\Controllers\UserController@index')->name('user.index');

    //Show User by Id
    Route::get('/users/show/{id}', 'App\Http\Controllers\UserController@show')->name('user.show');

    //Get Users by Id
    Route::get('/users/create', 'App\Http\Controllers\UserController@create')->name('user.create');

    //Edit User by Id
    Route::get('/users/edit/{id}', 'App\Http\Controllers\UserController@edit')->name('user.edit');

    //Save new User
    Route::post('/users/store', 'App\Http\Controllers\UserController@store')->name('user.store');

    //Update One User
    Route::put('/users/update/{user}', 'App\Http\Controllers\UserController@update')->name('user.update');

    //Update One User Speedly
    Route::put('/users/speed/{user}', 'App\Http\Controllers\UserController@updateSpeed')->name('user.update.speed');

    //Delete User
    Route::delete('/users/delete/{user}', 'App\Http\Controllers\UserController@delete')->name('user.delete');

});
Route::prefix('admin')->name('admin.')->group(function(){

    //Get Banners datas
    Route::get('/banners', 'App\Http\Controllers\BannerController@index')->name('banner.index');

    //Show Banner by Id
    Route::get('/banners/show/{id}', 'App\Http\Controllers\BannerController@show')->name('banner.show');

    //Get Banners by Id
    Route::get('/banners/create', 'App\Http\Controllers\BannerController@create')->name('banner.create');

    //Edit Banner by Id
    Route::get('/banners/edit/{id}', 'App\Http\Controllers\BannerController@edit')->name('banner.edit');

    //Save new Banner
    Route::post('/banners/store', 'App\Http\Controllers\BannerController@store')->name('banner.store');

    //Update One Banner
    Route::put('/banners/update/{banner}', 'App\Http\Controllers\BannerController@update')->name('banner.update');

    //Update One Banner Speedly
    Route::put('/banners/speed/{banner}', 'App\Http\Controllers\BannerController@updateSpeed')->name('banner.update.speed');

    //Delete Banner
    Route::delete('/banners/delete/{banner}', 'App\Http\Controllers\BannerController@delete')->name('banner.delete');

});