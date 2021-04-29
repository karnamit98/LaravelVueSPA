<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('allusers' ,[App\Http\Controllers\UserController::class, 'index']);
Route::get('allproducts' ,[App\Http\Controllers\ProductController::class, 'index']);
Route::get('specificproducts/{type}' ,[App\Http\Controllers\ProductController::class, 'indexByType']);
Route::get('vendorproducts/{uid}' ,[App\Http\Controllers\ProductController::class, 'vendorproducts']);
// Route::get('user/edit/{id}',  [App\Http\Controllers\UserController::class, 'edit'] );


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); 

Route::post('register',[App\Http\Controllers\Auth\RegisterController::class, 'register']);
Route::post('login' , [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('logout' ,[App\Http\Controllers\Auth\LoginController::class, 'logout']);

//Route::post('user/update/{id}', [App\Http\Controllers\UserController::class, 'update']);

Route::prefix('user')->group( function () {
    //Route::post('/store', [Controller::class, 'store']);
    Route::get('/show/{id}',  [App\Http\Controllers\UserController::class, 'show'] );
    Route::get('/edit/{id}',  [App\Http\Controllers\UserController::class, 'edit'] );
    Route::put('/update/{id}', [App\Http\Controllers\UserController::class, 'update']);
    Route::delete('/delete/{id}', [App\Http\Controllers\UserController::class, 'destroy']);
});

Route::prefix('product')->group( function () {
    //Route::post('/store', [Controller::class, 'store']);  
    Route::get('/create',  [App\Http\Controllers\ProductController::class, 'create'] );     //won't be called since the vue component will be returned by vue router
    Route::post('/store', [App\Http\Controllers\ProductController::class, 'store'] );   //function() {return "store api unction called!";});//
    Route::get('/show/{id}', [App\Http\Controllers\ProductController::class, 'show']);
    Route::get('/edit/{id}',  [App\Http\Controllers\ProductController::class, 'edit'] );
    Route::put('/update/{id}', [App\Http\Controllers\ProductController::class, 'update']);
    Route::delete('/delete/{id}', [App\Http\Controllers\ProductController::class, 'destroy']);
});


// Route::post('register', function() {
//     return "hey There!  "; });