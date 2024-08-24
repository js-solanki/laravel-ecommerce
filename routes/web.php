<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
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

Route::post('/login',[LoginController::class, 'login'])->name('login');

Route::get('/register', function () {
    return view('dashboard.register.index');
})->name('register');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin-login');;
Route::get('/logout', [LoginController::class, 'logout'])->name('admin-logout');
Route::post('/register', [RegisterController::class, 'store'])->name('admin-register');

Route::group(['prefix' => 'admin', 'middleware' => 'is_admin'], function() {
   
    Route::get('/', function () {
        return view('dashboard.index');
    })->name('dashboard');
    
    Route::get('/about', function () {
        return view('dashboard.about.index');
    });

    Route::get('/admin', [DashboardController::class,'index']);
    Route::group(['prefix' => 'category'], function() {
        // Define your routes here
        Route::get('/', [CategoryController::class,'index'])->name('admin-category-list');
        Route::get('/add', [CategoryController::class,'add'])->name('admin-add-catgeory');
        Route::post('/insert', [CategoryController::class,'insert'])->name('admin-insert-catgeory');
        Route::get('/edit/{id}', [CategoryController::class,'show'])->name('admin-category-edit');   
        Route::post('/update/{id}', [CategoryController::class,'edit'])->name('admin-update-catgeory');    
        Route::get('/delete/{id}', [CategoryController::class,'destroy'])->name('admin-category-delete');
    });


    Route::group(['prefix' => 'product'], function() {
        // Define your routes here
        Route::get('/', [ProductController::class,'index'])->name('admin-product-list');
        Route::get('/create', [ProductController::class,'create'])->name('admin-add-product');
        Route::post('/store', [ProductController::class,'store'])->name('admin-insert-product');
        Route::post('/update/{id}', [ProductController::class,'edit'])->name('admin-update-product');    
        Route::get('/edit/{id}', [ProductController::class,'show'])->name('admin-product-edit'); 
        Route::get('/delete/{id}', [ProductController::class,'destroy'])->name('admin-product-delete');
        Route::get('/detail/{id}', [ProductController::class,'detail'])->name('admin-product-detail');
    });

    Route::group(['prefix' => 'role'], function() {
        // Define your routes here
        Route::get('/', [RoleController::class,'index'])->name('admin-role-list');
        Route::get('/add', [RoleController::class,'create'])->name('admin-add-role');
        Route::post('/store', [RoleController::class,'store'])->name('admin-insert-role');
        Route::get('/edit/{id}', [RoleController::class,'show'])->name('admin-role-edit');    
        Route::get('/delete/{id}', [RoleController::class,'destroy'])->name('admin-role-delete');
        Route::post('/update/{id}', [RoleController::class,'edit'])->name('admin-update-role');    
              
    });
 });