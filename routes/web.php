<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;




Route::get('/', [PublicController::class, 'home'])->name('home');


Route::get('/categories', [PublicController::class, 'categories'])->name('public.categories');


Route::get('/categorie/{slug}', [PublicController::class, 'categoryProducts'])->name('public.category.products');


Route::get('/produit/{id}', [PublicController::class, 'productDetail'])->name('public.product.detail');




Route::prefix('admin')->name('admin.')->group(function () {
    
    
    Route::resource('categories', CategoryController::class);
    
    
    Route::resource('products', ProductController::class);
});