<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::get('/dashboard', [App\Http\Controllers\Admin\Dashboard::class,'index']);
Route::group(['middleware' => ['web']], function () {
    Route::get('/home', '\Aimeos\Shop\Controller\CatalogController@homeAction')->name('aimeos_home');
});

Route::group([ 'prefix' => 'admin'], function () {

Route::get('/categories', [App\Http\Controllers\Admin\Categories::class,'index']);
Route::get("category/{id?}", [App\Http\Controllers\Admin\Categories::class,'category']);
Route::get("deletecategory/{id}", [App\Http\Controllers\Admin\Categories::class,'deleteCategory']);
Route::post("savecategory", [App\Http\Controllers\Admin\Categories::class,'saveCategory']);


Route::get('/ages', [App\Http\Controllers\Admin\Ages::class,'index']);
Route::get("age/{id?}", [App\Http\Controllers\Admin\Ages::class,'age']);
Route::get("deleteage/{id}", [App\Http\Controllers\Admin\Ages::class,'deleteAge']);
Route::post("saveage", [App\Http\Controllers\Admin\Ages::class,'saveAge']);
});
