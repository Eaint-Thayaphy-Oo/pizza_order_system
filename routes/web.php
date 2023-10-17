<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;

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
//     return view('login');
// });

// Route::get('/register', function () {
//     return view('register');
// });

Route::middleware('auth')->group(function () {
    //dashboard
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    //admin //middleware ko a kone lone mhr common khwl yayy lyk tha lo myo a paw ka ny oat lyk dr
    Route::group(['middleware' => 'admin_auth'], function () {
        //category
        // Route::group(['prefix' => 'category'], function () {
        //     Route::get('list', [CategoryController::class, 'list'])->name('category#list');
        //     Route::get('create/page', [CategoryController::class, 'createPage'])->name('category#createPage');
        //     Route::post('create', [CategoryController::class, 'create'])->name('category#create');
        //     Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
        //     Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category#edit');
        //     Route::post('update', [CategoryController::class, 'update'])->name('category#update');
        // });

        //category
        Route::prefix('category')->group(function () {
            Route::get('list', [CategoryController::class, 'list'])->name('category#list');
            Route::get('create/page', [CategoryController::class, 'createPage'])->name('category#createPage');
            Route::post('create', [CategoryController::class, 'create'])->name('category#create');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category#edit');
            Route::post('update', [CategoryController::class, 'update'])->name('category#update');
        });

        //admin account
        // Route::prefix('admin')->group(function () {
        //     Route::get('password/changePage', [AuthController::class, 'changePasswordPage'])->name('admin#changePasswordPage');
        // });

        //admin account
        Route::get('password/changePage', [AuthController::class, 'changePasswordPage'])->name('admin#changePasswordPage');
        Route::post('change/password', [AuthController::class, 'changePassword'])->name('admin#changePassword');
    });

    // Route::middleware(['admin_auth'])->group(function(){
    //     Route::group(['prefix' => 'category', 'middleware' => 'admin_auth'], function () {
    //         Route::get('list', [CategoryController::class, 'list'])->name('category#list');
    //         Route::get('create/page', [CategoryController::class, 'createPage'])->name('category#createPage');
    //         Route::post('create', [CategoryController::class, 'create'])->name('category#create');
    //         Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
    //         Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category#edit');
    //         Route::post('update', [CategoryController::class, 'update'])->name('category#update');
    //     });
    // }); d lo ll yayy loh ya dL

    //user
    Route::group(['prefix' => 'user', 'middleware' => 'user_auth'], function () {
        Route::get('home', function () {
            return view('user.home');
        })->name('user#home');
    });
});

//login,register
Route::redirect('/', 'loginPage');
Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');

// Route::group(['prefix' => 'category'], function () {
//     Route::get('list', [CategoryController::class, 'list'])->name('category#list');
// });
