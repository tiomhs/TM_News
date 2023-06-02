<?php

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ComentController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\PageAdminController;
use App\Http\Controllers\SearchController;
use App\Models\Category;
use App\Models\Page;
use Illuminate\Support\Facades\Auth;
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

Route::get('/',[PageController::class, 'index'] );
Route::get('/homepage',[PageController::class, 'index'] );
Route::get('/homepage/page/{Page::slug}',[PageController::class, 'show']);
Route::post('/homepage/store',[ComentController::class, 'store'])->name('store');
// search
Route::get('/homepage/search', [PageController::class, 'search'])->name('search');

// category
Route::get('/homepage/categories', [CategoryController::class, 'index']);
// Route::get('/homepage/categories/{Category::slug}', [CategoryController::class, 'show']);
Route::get('/homepage/categories/{Category:id}', [CategoryController::class, 'show']);



// ADMIN
Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
    Route::get('/', [AdminPageController::class, 'index']);
    Route::get('/pages', [PageAdminController::class, 'index']);
    Route::get('/pages/create', [PageAdminController::class, 'create']);
    Route::get('/pages/{Page:slug}', [PageAdminController::class, 'show']);
    Route::get('/pages/edit/{Page:slug}', [PageAdminController::class, 'edit']);
    Route::post('/pages/update', [PageAdminController::class, 'update'])->name('page.update');
    // Route::get('/pages/checkSlug', [PageAdminController::class,'checkSlug']);
    Route::post('/pages/store', [PageAdminController::class, 'store'])->name('page.store');
    Route::delete('/pages/delete/{Page:slug}', [PageAdminController::class, 'destroy'])->name('page.delete');
    Route::resource('/categories',AdminCategoryController::class);
    Route::resource('/users',AdminUserController::class);
    Route::get('users/update', [AdminUserController::class,'update']);
    Route::get('categories/update', [AdminCategoryController::class,'update']);
});



Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

