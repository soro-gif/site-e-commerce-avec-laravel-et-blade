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

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('preload.page');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact')->middleware('preload.page');
Route::get('/page/{page}', [HomeController::class, 'showPage'])->name('page')->middleware('preload.page');
Route::get('/product/{slug}', [HomeController::class, 'showProduct'])->name('product')->middleware('preload.page');
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
Route::prefix('admin')->name('admin.')->group(function(){

    //Get Shopcollections datas
    Route::get('/shopcollections', 'App\Http\Controllers\ShopcollectionController@index')->name('shopcollection.index');

    //Show Shopcollection by Id
    Route::get('/shopcollections/show/{id}', 'App\Http\Controllers\ShopcollectionController@show')->name('shopcollection.show');

    //Get Shopcollections by Id
    Route::get('/shopcollections/create', 'App\Http\Controllers\ShopcollectionController@create')->name('shopcollection.create');

    //Edit Shopcollection by Id
    Route::get('/shopcollections/edit/{id}', 'App\Http\Controllers\ShopcollectionController@edit')->name('shopcollection.edit');

    //Save new Shopcollection
    Route::post('/shopcollections/store', 'App\Http\Controllers\ShopcollectionController@store')->name('shopcollection.store');

    //Update One Shopcollection
    Route::put('/shopcollections/update/{shopcollection}', 'App\Http\Controllers\ShopcollectionController@update')->name('shopcollection.update');

    //Update One Shopcollection Speedly
    Route::put('/shopcollections/speed/{shopcollection}', 'App\Http\Controllers\ShopcollectionController@updateSpeed')->name('shopcollection.update.speed');

    //Delete Shopcollection
    Route::delete('/shopcollections/delete/{shopcollection}', 'App\Http\Controllers\ShopcollectionController@delete')->name('shopcollection.delete');

});
Route::prefix('admin')->name('admin.')->group(function(){

    //Get Collections datas
    Route::get('/collections', 'App\Http\Controllers\CollectionController@index')->name('collection.index');

    //Show Collection by Id
    Route::get('/collections/show/{id}', 'App\Http\Controllers\CollectionController@show')->name('collection.show');

    //Get Collections by Id
    Route::get('/collections/create', 'App\Http\Controllers\CollectionController@create')->name('collection.create');

    //Edit Collection by Id
    Route::get('/collections/edit/{id}', 'App\Http\Controllers\CollectionController@edit')->name('collection.edit');

    //Save new Collection
    Route::post('/collections/store', 'App\Http\Controllers\CollectionController@store')->name('collection.store');

    //Update One Collection
    Route::put('/collections/update/{collection}', 'App\Http\Controllers\CollectionController@update')->name('collection.update');

    //Update One Collection Speedly
    Route::put('/collections/speed/{collection}', 'App\Http\Controllers\CollectionController@updateSpeed')->name('collection.update.speed');

    //Delete Collection
    Route::delete('/collections/delete/{collection}', 'App\Http\Controllers\CollectionController@delete')->name('collection.delete');

});
Route::prefix('admin')->name('admin.')->group(function(){

    //Get Pages datas
    Route::get('/pages', 'App\Http\Controllers\PageController@index')->name('page.index');

    //Show Page by Id
    Route::get('/pages/show/{id}', 'App\Http\Controllers\PageController@show')->name('page.show');

    //Get Pages by Id
    Route::get('/pages/create', 'App\Http\Controllers\PageController@create')->name('page.create');

    //Edit Page by Id
    Route::get('/pages/edit/{id}', 'App\Http\Controllers\PageController@edit')->name('page.edit');

    //Save new Page
    Route::post('/pages/store', 'App\Http\Controllers\PageController@store')->name('page.store');

    //Update One Page
    Route::put('/pages/update/{page}', 'App\Http\Controllers\PageController@update')->name('page.update');

    //Update One Page Speedly
    Route::put('/pages/speed/{page}', 'App\Http\Controllers\PageController@updateSpeed')->name('page.update.speed');

    //Delete Page
    Route::delete('/pages/delete/{page}', 'App\Http\Controllers\PageController@delete')->name('page.delete');

});
Route::prefix('admin')->name('admin.')->group(function(){

    //Get Tags datas
    Route::get('/tags', 'App\Http\Controllers\TagController@index')->name('tag.index');

    //Show Tag by Id
    Route::get('/tags/show/{id}', 'App\Http\Controllers\TagController@show')->name('tag.show');

    //Get Tags by Id
    Route::get('/tags/create', 'App\Http\Controllers\TagController@create')->name('tag.create');

    //Edit Tag by Id
    Route::get('/tags/edit/{id}', 'App\Http\Controllers\TagController@edit')->name('tag.edit');

    //Save new Tag
    Route::post('/tags/store', 'App\Http\Controllers\TagController@store')->name('tag.store');

    //Update One Tag
    Route::put('/tags/update/{tag}', 'App\Http\Controllers\TagController@update')->name('tag.update');

    //Update One Tag Speedly
    Route::put('/tags/speed/{tag}', 'App\Http\Controllers\TagController@updateSpeed')->name('tag.update.speed');

    //Delete Tag
    Route::delete('/tags/delete/{tag}', 'App\Http\Controllers\TagController@delete')->name('tag.delete');

});
Route::prefix('admin')->name('admin.')->group(function(){

    //Get Megacollections datas
    Route::get('/megacollections', 'App\Http\Controllers\MegacollectionController@index')->name('megacollection.index');

    //Show Megacollection by Id
    Route::get('/megacollections/show/{id}', 'App\Http\Controllers\MegacollectionController@show')->name('megacollection.show');

    //Get Megacollections by Id
    Route::get('/megacollections/create', 'App\Http\Controllers\MegacollectionController@create')->name('megacollection.create');

    //Edit Megacollection by Id
    Route::get('/megacollections/edit/{id}', 'App\Http\Controllers\MegacollectionController@edit')->name('megacollection.edit');

    //Save new Megacollection
    Route::post('/megacollections/store', 'App\Http\Controllers\MegacollectionController@store')->name('megacollection.store');

    //Update One Megacollection
    Route::put('/megacollections/update/{megacollection}', 'App\Http\Controllers\MegacollectionController@update')->name('megacollection.update');

    //Update One Megacollection Speedly
    Route::put('/megacollections/speed/{megacollection}', 'App\Http\Controllers\MegacollectionController@updateSpeed')->name('megacollection.update.speed');

    //Delete Megacollection
    Route::delete('/megacollections/delete/{megacollection}', 'App\Http\Controllers\MegacollectionController@delete')->name('megacollection.delete');

});

Route::prefix('admin')->name('admin.')->group(function(){

    //Get Settings datas
    Route::get('/settings', 'App\Http\Controllers\SettingController@index')->name('setting.index');

    //Show Setting by Id
    Route::get('/settings/show/{id}', 'App\Http\Controllers\SettingController@show')->name('setting.show');

    //Get Settings by Id
    Route::get('/settings/create', 'App\Http\Controllers\SettingController@create')->name('setting.create');

    //Edit Setting by Id
    Route::get('/settings/edit/{id}', 'App\Http\Controllers\SettingController@edit')->name('setting.edit');

    //Save new Setting
    Route::post('/settings/store', 'App\Http\Controllers\SettingController@store')->name('setting.store');

    //Update One Setting
    Route::put('/settings/update/{setting}', 'App\Http\Controllers\SettingController@update')->name('setting.update');

    //Update One Setting Speedly
    Route::put('/settings/speed/{setting}', 'App\Http\Controllers\SettingController@updateSpeed')->name('setting.update.speed');

    //Delete Setting
    Route::delete('/settings/delete/{setting}', 'App\Http\Controllers\SettingController@delete')->name('setting.delete');

});
Route::prefix('admin')->name('admin.')->group(function(){

    //Get Socials datas
    Route::get('/socials', 'App\Http\Controllers\SocialController@index')->name('social.index');

    //Show Social by Id
    Route::get('/socials/show/{id}', 'App\Http\Controllers\SocialController@show')->name('social.show');

    //Get Socials by Id
    Route::get('/socials/create', 'App\Http\Controllers\SocialController@create')->name('social.create');

    //Edit Social by Id
    Route::get('/socials/edit/{id}', 'App\Http\Controllers\SocialController@edit')->name('social.edit');

    //Save new Social
    Route::post('/socials/store', 'App\Http\Controllers\SocialController@store')->name('social.store');

    //Update One Social
    Route::put('/socials/update/{social}', 'App\Http\Controllers\SocialController@update')->name('social.update');

    //Update One Social Speedly
    Route::put('/socials/speed/{social}', 'App\Http\Controllers\SocialController@updateSpeed')->name('social.update.speed');

    //Delete Social
    Route::delete('/socials/delete/{social}', 'App\Http\Controllers\SocialController@delete')->name('social.delete');

});
Route::prefix('admin')->name('admin.')->group(function(){

    //Get Contacts datas
    Route::get('/contacts', 'App\Http\Controllers\ContactController@index')->name('contact.index');

    //Show Contact by Id
    Route::get('/contacts/show/{id}', 'App\Http\Controllers\ContactController@show')->name('contact.show');

    //Get Contacts by Id
    Route::get('/contacts/create', 'App\Http\Controllers\ContactController@create')->name('contact.create');

    //Edit Contact by Id
    Route::get('/contacts/edit/{id}', 'App\Http\Controllers\ContactController@edit')->name('contact.edit');

    //Save new Contact
    Route::post('/contacts/store', 'App\Http\Controllers\ContactController@store')->name('contact.store');

    //Update One Contact
    Route::put('/contacts/update/{contact}', 'App\Http\Controllers\ContactController@update')->name('contact.update');

    //Update One Contact Speedly
    Route::put('/contacts/speed/{contact}', 'App\Http\Controllers\ContactController@updateSpeed')->name('contact.update.speed');

    //Delete Contact
    Route::delete('/contacts/delete/{contact}', 'App\Http\Controllers\ContactController@delete')->name('contact.delete');

});