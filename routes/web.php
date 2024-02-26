<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TrendPostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {

    // ADMIN
    Route::get('/dashboard',[ProfileController::class,'index'])->name('dashboard');
    Route::post('admin/update',[ProfileController::class,'updateAdminAccount'])->name('admin#update');
    Route::get('admin/changePassword/page',[ProfileController::class,'changePasswordPg'])->name('admin#changePasswordPg');
    Route::post('admin/changePassword',[ProfileController::class,'changePassword'])->name('admin#changePassword');

    // ADMIN LIST
    Route::get('admin/list/',[ListController::class,'index'])->name('admin#list');
    Route::get('admin/list/delete/{id}',[ListController::class,'delete'])->name('admin#list#delete');

    // CATEGORY
    Route::get('category',[CategoryController::class,'index'])->name('admin#category');
    Route::post('category/create',[CategoryController::class,'create'])->name('admin#category#create');
    Route::get('category/delete/{id}',[CategoryController::class,'delete'])->name('admin#category#delete');
    Route::get('category/editPage',[CategoryController::class,'editPage'])->name('admin#category#editPage');
    Route::post('category/update',[CategoryController::class,'update'])->name('admin#category#update');

    // POST
    Route::get('post',[PostController::class,'index'])->name('admin#post');
    Route::post('post/create',[PostController::class,'create'])->name('admin#post#create');
    Route::get('post/delete/{id}',[PostController::class,'delete'])->name('admin#post#delete');
    Route::get('post/editPage',[PostController::class,'editPage'])->name('admin#post#editPage');
    Route::post('category/update',[PostController::class,'update'])->name('admin#post#update');

    // TRENDPOST
    Route::get('trendPost',[TrendPostController::class,'index'])->name('admin#trendPost');
    Route::get('trendPost/details/{id}',[TrendPostController::class,'details'])->name('admin#trendPost#details');
});
