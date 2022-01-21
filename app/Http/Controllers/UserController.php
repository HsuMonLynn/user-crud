<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
  {
    return view('user');
  }

  public function getUser(){

    $users = User::when($search = request('search'), function ($query) use ($search) {
      $query->where('name', 'like', '%' . $search . '%')
          ->orWhere('email', 'LIKE', '%' . $search . '%')
          ->orWhere('id', 'LIKE', '%' . $search . '%');
      })->orderBy('id','DESC')->paginate(10);
     
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
        
  }

  // public function edit($id){
  //   $user = User::FindorFail($id);
  //   return response()->json($user);
  // }

  public function update(UserUpdateRequest $request,$id)  {

    $user = User::findOrFail($id);
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make('password');
    $user->update();
    return response()->json(['data' => $user], 200);
  } 
  
  public function destroy($id){

    $user = User::findOrFail($id);
    $user->delete();
    return response()->json(['data' => $user], 200);
    
  }
    
}