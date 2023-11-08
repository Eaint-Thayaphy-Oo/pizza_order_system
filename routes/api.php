<?php

use App\Http\Controllers\API\RouteController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\RouteCompiler;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('apiTesting', function () {
    $data = [
        'message' => 'This is testing message'
    ];
    return response()->json($data, 200);
});

//Get
Route::get('product/list', [RouteController::class, 'productList']);
Route::get('category/list', [RouteController::class, 'categoryList']);

//Post
Route::post('create/category', [RouteController::class, 'categoryCreate']);
Route::post('create/contact', [RouteController::class, 'createContact']);

//delete for post method
Route::post('category/delete', [RouteController::class, 'deleteCategory']);
//delete for get method
Route::get('category/delete/{id}', [RouteController::class, 'categoryDelete']);

//edit for post method
Route::post('category/details', [RouteController::class, 'categoryDetails']);
//edit for get method
Route::get('category/details/{id}', [RouteController::class, 'detailsCategory']);

//update
Route::post('category/update', [RouteController::class, 'categoryUpdate']);

/*
//for api link getting from postman
//Product list
http://127.0.0.1:8000/api/product/list (GET)

//Category List
http://127.0.0.1:8000/api/category/list (GET)

//create category
http://127.0.0.1:8000/api/create/category (POST)
body{
    'name':""
}

http://127.0.0.1:8000/api/category/delete/{id} (GET)
http://127.0.0.1:8000/api/category/delete (POST)
http://127.0.0.1:8000/api/category/details/{id} (GET)
http://127.0.0.1:8000/api/category/details (POST)
http://127.0.0.1:8000/api/category/update (POST)

key => category_name,category_id
*/
