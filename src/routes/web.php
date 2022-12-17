<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->middleware('checkAdmin')->name('admin');
Route::get('/admin/image/{id}/cancel', [App\Http\Controllers\AdminController::class, 'imageCancel'])->middleware('checkAdmin')->name('image-cancel');
