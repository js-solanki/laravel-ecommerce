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

// Route::get('/', function () {
//     return view('welcome');
// });

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

    // Define your routes here
    Route::get('/about', function () {
        return view('dashboard.about.index');
    });
    Route::get('/admin', [DashboardController::class,'index']);
    Route::group(['prefix' => 'category'], function() {
        // Define your routes here
        Route::get('/', [CategoryController::class,'index'])->name('admin-category-list');
        Route::get('/add', [CategoryController::class,'add'])->name('admin-add-catgeory');
        Route::post('/insert', [CategoryController::class,'insert'])->name('admin-insert-catgeory');
    });

    Route::group(['prefix' => 'product'], function() {
        // Define your routes here
        Route::get('/', [ProductController::class,'index'])->name('admin-product-list');
        Route::get('/products/create', [ProductController::class,'create'])->name('admin-add-product');

        // Route::get('/add', [CategoryController::class,'add'])->name('admin-add-catgeory');
        // Route::post('/insert', [CategoryController::class,'insert'])->name('admin-insert-catgeory');;
    });

    Route::group(['prefix' => 'role'], function() {
        // Define your routes here
        Route::get('/', [RoleController::class,'index'])->name('admin-role-list');
        Route::get('/add', [RoleController::class,'create'])->name('admin-add-role');
        Route::post('/store', [RoleController::class,'store'])->name('admin-insert-role');;
              
    });
 });