<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Http\Request;
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
Route::get('/', [UserController::class, 'index']);
Route::get('all-users',[UserController::class, 'getUser']);
Route::post('/',[UserController::class, 'store']);
Route::post('users/{id}',[UserController::class, 'update']);
Route::delete('/{id}',[UserController::class, 'destroy']);

    // $request->validate($request, [
    //     'name' => 'required|max:255',
    //     'email' => 'required',
    // ]);
    

    
    
// });


