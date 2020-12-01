<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndependentController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\API\ImageAPIController;
// use App\Http\Controllers\API\ProductStockAPIController;

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

Route::middleware('auth:api')->group(function(){
	Route::get('/me', function (Request $request) {
	    return $request->user();
	});
	
	// Route::get('/myinfo', [UserController::class, 'myInfo']);

	Route::get('/signinpermissions',[UserController::class, 'signInPermissions']);

	
	//Users API
	
	Route::get('/users/{user_id}', [UserController::class, 'show']);
	Route::patch('/users/{user_id}/edit', [UserController::class, 'update']);
	Route::delete('/users/{user_id}', [UserController::class, 'destroy']);

	Route::get('/users',[UserController::class, 'index']);

	Route::post('/users',[UserController::class, 'store']);
	
	Route::get('/images',[ImageAPIController::class,'index']);
	Route::post('/images',[ImageAPIController::class,'store']);
	Route::patch('/images/{image_id}',[ImageAPIController::class,'update']);
	Route::get('/images/{image_id}',[ImageAPIController::class,'show']);
	Route::get('/users/{user_id}/images',[ImageAPIController::class,'indexUserImages']);

	Route::middleware(['permission:3'])->middleware(['permission:4'])->group(function(){	//permission 3&4 for given independent
		Route::get('/independents/{independent_id}/images',[ImageAPIController::class,'indexIndependentImages']);


	// Route::get('/images',[ImageAPIController::class,'index']);

		Route::get('independents/{independent_id}/product_stocks', [App\Http\Controllers\API\ProductStockAPIController::class, 'indexIndependentProducts']);
		Route::post('independents/{independent_id}/product_stocks', [App\Http\Controllers\API\ProductStockAPIController::class, 'storeIndependentProduct']);
	});
	Route::resource('product_stocks', ProductStockAPIController::class);
});


Route::resource('independents', IndependentAPIController::class);


Route::post('/login',[AuthController::class, 'login']);
Route::post('/register',[AuthController::class, 'register']);
Route::middleware('auth:api')->post('/logout', [AuthController::class, 'logout']);

// Route::get('/independents',[IndependentController::class, 'index']);

// Route::get('/independent/{independent_id}',[IndependentController::class,'show']);

Route::get('/brands',[BrandController::class, 'index']);

Route::get('/brand/{brand_slug}',[BrandController::class,'show']);


Route::resource('products', ProductAPIController::class);

Route::resource('brands', BrandAPIController::class);

