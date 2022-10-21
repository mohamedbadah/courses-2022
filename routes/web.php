<?php

use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});
Route::prefix('user')->middleware("guest")->group(function(){
Route::get('login',[AuthController::class,"getLogin"])->name('login');
Route::post('login',[AuthController::class,'login']);
Route::get('register',[AuthController::class,"getRegister"]);
Route::post('register',[AuthController::class,'register']);
Route::get("/dashboard",function(){
  return view("cms.dash");
});
});
Route::prefix("user")->middleware("auth")->group(function(){
Route::get("dashboard",[Admincontroller::class,'index'])->name("dashboard");
Route::resource("category",CategoryController::class);
Route::resource('course',CourseController::class);
Route::get('category_course/{slug}',[CategoryController::class,"CategoryToCourse"])->name("CategoryToCourse");
Route::get("registeration",[CourseController::class,"registeration"])->name("all-registeration");
Route::delete("deleteRestration/{id}",[CourseController::class,"deleteRegister"])->name("deleteRegister");
Route::get('logout',[AuthController::class,'logout'])->name('logout');
});
Route::controller(PageController::class)->group(function(){
  Route::get("/course","index")->name("homePage");
  Route::get("/course/{slug}",'course')->name("course");
  Route::get('register/{slug}','register')->name("register");
  Route::post('register/{slug}','registerSubmit');
  Route::get("/pay/{id}","pay")->name("pay");
  Route::get("/thank/{id}","thank")->name("thank");
  Route::post("/search","search")->name("search");
});

