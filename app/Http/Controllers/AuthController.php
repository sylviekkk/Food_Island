<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request){
        $validated=$request->validate([
            'name'=>'required|string',
            'email'=>'required|email',
            'password'=>'required|string|min:8|confirmed',
            'user_photo'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $validated['password']=bcrypt($request->password);

        if($request->hasfile('user_photo')){
        $filename=$request->file('user_photo')->store('user','public');
    }
    else{
        $filename=null;
    }

    $validated['user_photo']=$filename;

    $user = User::create($validated);

    $token = $user->createToken("auth_token")->plainTextToken;

    return response()->json([
        "message"=>"User registered successfully",
        "user"=>$user,
        "token"=>$token
    ],201);
}
}
