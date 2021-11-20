<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Http\Request;


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
Route::get('/', [App\Http\Controllers\UserController::class, 'index']);

Route::post('/userCreate',[App\Http\Controllers\UserController::class, 'create']);

    // $request->validate($request, [
    //     'name' => 'required|max:255',
    //     'email' => 'required',
    // ]);
    

    
    
// });


