<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\UserStoreRequest;


class UserController extends Controller
{
    public function index()
  {
    $users = User::latest()->paginate(8);
    return view('user', compact('users'));
  }
  public function create(UserStoreRequest $request)
  { 
    $user = User::create(
        [
            'name' => $request->name, 
            'email' => $request->email,                
            'password' => "password"
        ]); 
        return Response::json($user);
        
    }      
    
}