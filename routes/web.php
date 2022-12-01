<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\ProductController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [ProductController::class, 'index'])->name('index');
Route::post('add-product', [ProductController::class, 'store'])->name('store');
Route::get('edit-product/{id}', [ProductController::class, 'edit']);
Route::post('update-student', [ProductController::class, 'updateProduct'])->name('update');
Route::post('delete-student', [ProductController::class, 'deleteProduct'])->name('delete');


// DEMO CRUD OPERATION ROUTE
Route::controller(DemoController::class)->group(function () {
    Route::get('demo', 'index');
    Route::post('add-demo', 'store');
    Route::get('edit-demo/{id}', 'edit');

});
