<?php

use Illuminate\Support\Facades\Route;
use App\HTTP\Controllers\CategoryController;

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











require __DIR__.'/auth.php';
