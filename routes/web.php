<?php

use Illuminate\Support\Facades\Route;
use App\HTTP\Controllers\FrontendController;
use App\HTTP\Controllers\CategoryController;
use App\HTTP\Controllers\BrandController;
use App\HTTP\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('layouts.index');
// });
Route::get('/', [FrontendController::class,'indexView'])->name('indexView');


Route::get('/dashboard', function () {
    return view('backend.dashboard');
})->name('dashboard');


Route::resource('category', CategoryController::class);
Route::get('/category-trashed',[CategoryController::class,'categorytrashed'])->name('categorytrashed');
Route::get('/category-restore/{id}',[CategoryController::class,'restorecategory'])->name('restorecategory');
Route::get('/category-deleteforever/{id}',[CategoryController::class,'categorydeleteforever'])->name('categorydeleteforever');


Route::resource('brand', BrandController::class);
Route::get('/brand-trashed',[BrandController::class,'brandtrashed'])->name('brandtrashed');
Route::get('/brand-restore/{id}',[BrandController::class,'restorebrand'])->name('restorebrand');
Route::get('/brand-deleteforever/{id}',[BrandController::class,'branddeleteforever'])->name('branddeleteforever');


Route::resource('product', ProductController::class);
Route::get('/product-trashed',[ProductController::class,'producttrashed'])->name('producttrashed');
Route::get('/product/delete/{product_id}',[ProductController::class,'destroy'])->name('destroy');
Route::get('/product-restore/{id}',[ProductController::class,'restoreProduct'])->name('restoreProduct');
// Route::get('/brand-deleteforever/{id}',[BrandController::class,'branddeleteforever'])->name('branddeleteforever');

Route::get('/product-gallery/{id}',[ProductController::class,'productGallery'])->name('productGallery');
Route::get('/product-trashed/{id}',[ProductController::class,'galleryDestroy'])->name('galleryDestroy');





require __DIR__.'/auth.php';
