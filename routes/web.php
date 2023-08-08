<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\productController;
use App\Http\Controllers\AutocompleteController;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/home/categories', [HomeController::class, 'categoryindex'])->name('categories');
Route::get('/categories/suggestions', 'CategoryController@suggestCategories')->name('categories.suggestions');
Route::get('/autocomplete', [AutocompleteController::class, 'index']);
//Route::get('/demo', [App\Http\Controllers\productsController::class, 'index'])->name('demo');

Route::resource('product', 'App\Http\Controllers\productController');
Route::resource('Category', 'App\Http\Controllers\CategoryController');
Route::resource('ProductCategory', 'App\Http\Controllers\ProductCategoryController');

Route::post('/autocomplete/fetch', [AutocompleteController::class, 'fetch'])->name('autocomplete.fetch');
