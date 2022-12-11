<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('auth.login');
})->name('home');
Route::get('/reg', function () {
    return view('auth.register');
})->name('reg');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');
//User- Admin routes

Route::post('register-admin',[UserController::class,'insert'])->name('register-admin');
Route::post('admin-login',[UserController::class,'login'])->name('admin-login');
Route::get('admin-logout',[UserController::class,'logout'])->name('admin-logout');

Route::group(['middleware'=>['Admin']],function(){
//Route routes

Route::get('route',[RouteController::class,'index'])->name('route');
Route::post('add-route',[RouteController::class,'store'])->name('store.route');
Route::get('/edit/route{id}',[RouteController::class,'edit']);
Route::post('update-route',[RouteController::class,'store'])->name('update.route');
Route::get('/routeactive{id}',[RouteController::class,'route_active'])->name('route.active');
Route::get('/routeinactive{id}',[RouteController::class,'route_inactive'])->name('route.inactive');
Route::get('delete-route',[RouteController::class,'destroy']);

//Bus routes

Route::get('bus',[BusController::class,'index'])->name('bus');
Route::post('add-bus',[BusController::class,'create']);
Route::post('update-bus',[BusController::class,'update']);
Route::get('delete-bus',[BusController::class,'destroy']);

//Station routes

Route::get('station',[StationController::class,'index'])->name('station');
Route::post('add-station',[StationController::class,'create']);
Route::post('update-station',[StationController::class,'update']);
Route::get('delete-station',[StationController::class,'destroy']);
});