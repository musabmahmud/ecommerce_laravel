<?php

use Illuminate\Support\Facades\Route;
use App\HTTP\Controllers\CategoryController;
use App\HTTP\Controllers\BrandController;

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

Route::get('/', function () {
    return view('layouts.index');
});

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








require __DIR__.'/auth.php';
