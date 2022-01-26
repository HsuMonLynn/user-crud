<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
  { 
    $user = User::all();
    return view('user',compact('user'));
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
    $user->image = $request->file('image')->store('images', 'public');
    // if ($request->file('create-photo')) {
      // $photo = $request->file('image');
      // dd($photo);
      // $photoName = $photo->getClientOriginalName();
      // $request->file('create-photo')->storeAs('public/user-photos', $photoName);
      // $user->image = $photoName;
    // }
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

    if ($request->file('image')) {
      $user->image = $request->file('image')->store('images', 'public');
    }
    $user->update();
    return response()->json(['data' => $user], 200);
  } 
  
  public function destroy($id){
  
    $user = User::findOrFail($id);
    $user->delete();
    return response()->json(['data' => $user], 200);
    
  }
    
}