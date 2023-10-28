<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;
use App\Models\Product;

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
        Route::get('password/changePage', [AdminController::class, 'changePasswordPage'])->name('admin#changePasswordPage');
        Route::post('change/password', [AdminController::class, 'changePassword'])->name('admin#changePassword');

        //admin list
        Route::get('list', [AdminController::class, 'list'])->name('admin#list');
        Route::get('delete/{id}', [AdminController::class, 'delete'])->name('admin#delete');
        Route::get('changeRole/{id}', [AdminController::class, 'changeRole'])->name('admin#changeRole');
        Route::post('change/role/{id}', [AdminController::class, 'change'])->name('admin#change');

        //profile
        Route::get('details', [AdminController::class, 'details'])->name('admin#details');
        Route::get('edit', [AdminController::class, 'edit'])->name('admin#edit');
        Route::post('update/{id}', [AdminController::class, 'update'])->name('admin#update');

        //products
        Route::prefix('products')->group(function () {
            Route::get('list', [ProductController::class, 'list'])->name('product#list');
            Route::get('create', [ProductController::class, 'createPage'])->name('product#createPage');
            Route::post('create', [ProductController::class, 'create'])->name('product#create');
            Route::get('delete/{id}', [ProductController::class, 'delete'])->name('product#delete');
            Route::get('edit/{id}', [ProductController::class, 'edit'])->name('product#edit');
            Route::get('updatePage/{id}', [ProductController::class, 'updatePage'])->name('product#updatePage');
            Route::post('update', [ProductController::class, 'update'])->name('product#update');
        });
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
    //home
    Route::group(['prefix' => 'user', 'middleware' => 'user_auth'], function () {
        // Route::get('home', function () {
        //     return view('user.home');
        // })->name('user#home');
        Route::get('/homePage', [UserController::class, 'home'])->name('user#home');
        Route::get('/filter/{id}', [UserController::class, 'filter'])->name('user#filter');

        //password
        Route::prefix('password')->group(function () {
            Route::get('change', [UserController::class, 'changePasswordPage'])->name('user#changePasswordPage');
            Route::post('change', [UserController::class, 'changePassword'])->name('user#changePassword');
        });

        //account
        Route::prefix('account')->group(function () {
            Route::get('change', [UserController::class, 'accountChangePage'])->name('user#accountChangePage');
            Route::post('change/{id}', [UserController::class, 'accountChange'])->name('user#accountChange');
        });

        //for ajax sorting
        Route::prefix('ajax')->group(function () {
            // Route::get('pizzaList', function () {
            //     $data = Product::get();
            //     return $data;
            // });
            Route::get('pizza/list', [AjaxController::class, 'pizzaList'])->name('ajax#pizzaList');
            Route::get('addToCart', [AjaxController::class, 'addToCart'])->name('ajax#addToCart');
        });

        //for pizza
        Route::prefix('pizza')->group(function () {
            Route::get('details/{id}', [UserController::class, 'pizzaDetails'])->name('user#pizzaDetails');
        });

        //for cart
        Route::prefix('cart')->group(function () {
            Route::get('list', [UserController::class, 'cartList'])->name('user#cartList');
        });
    });
});

//login,register
Route::middleware(['admin_auth'])->group(function () {
    Route::redirect('/', 'loginPage');
    Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});

// Route::group(['prefix' => 'category'], function () {
//     Route::get('list', [CategoryController::class, 'list'])->name('category#list');
// });
