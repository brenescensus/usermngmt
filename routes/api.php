<?php
use App\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
//registering a user
Route::post('/user/create',[UserController:: class,'Register']);

//showing all users
Route::get('/users',[UserController:: class,'Getusers']);

//update the user

Route::post('/user/update/{id}',[UserController:: class,'update']);

Route::get('/user/delete/{id}',[UserController:: class,'Delete']);

Route::get('/user/login',[UserController:: class,'Login']);
