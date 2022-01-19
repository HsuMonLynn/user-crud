<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\UserStoreRequest;


class UserController extends Controller
{
    public function index()
  {
    // $users = User::latest()->paginate(8);
    // return view('user', compact('users'));
    return view('user');
  }

  public function getUser(){

    $users = User::when($search = request('search'), function ($query) use ($search) {
      $query->where('name', 'like', '%' . $search . '%')
          ->orWhere('email', 'LIKE', '%' . $search . '%')
          ->orWhere('id', 'LIKE', '%' . $search . '%');
      })->get();
    return view('_table',compact('users'));
  }

  public function store(UserStoreRequest $request)
  { 
    $user = new User;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make('password');
    $user->save();
    return response()->json(['data' => $user], 200);
    // $user = User::create(
    //     [
    //         'name' => $request->name, 
    //         'email' => $request->email,                
    //         'password' => "password"
    //     ]); 
        
    //     return Response::json($user);
        
    }      
    
}