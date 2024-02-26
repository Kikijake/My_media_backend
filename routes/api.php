<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ActionLogController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('user/login',[AuthController::class,'login']);
Route::post('user/register',[AuthController::class,'register']);

Route::get('category',function(){
    return response()->json([
        'message' => 'token test',
    ]);
})->middleware('auth:sanctum');

// POST
Route::get('allPostList',[PostController::class,'getAllPost']);
Route::post('post/search',[PostController::class,'postSearch']);
Route::post('post/detail',[PostController::class,'postDetails']);

// CATEGORY
Route::get('allCategory',[CategoryController::class,'getAllCategory']);
Route::post('category/search',[CategoryController::class,'categorySearch']);

// ACTION LOG
Route::post('post/actionlog',[ActionLogController::class,'setActionLog']);


