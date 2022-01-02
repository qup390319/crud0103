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

//主頁面
Route::get('/', [\App\Http\Controllers\homeController::class, 'index'])
    ->name('index');
Route::post('/create_story',[\App\Http\Controllers\homeController::class,'create_story'])
    ->name('create_story');
Route::get('/delete_data', [\App\Http\Controllers\homeController::class, 'delete_data'])
    ->name('delete_data');
Route::get('/get_data', [\App\Http\Controllers\homeController::class, 'get_data'])
    ->name('get_data');
Route::post('/edit_data', [\App\Http\Controllers\homeController::class, 'edit_data'])
    ->name('edit_data');
//Route::get('/users/export/', [\App\Http\Controllers\homeController::class, 'export'])
//    ->name('export');
