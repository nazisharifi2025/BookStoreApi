<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function Auth(Request $request){
       $valedatedUser=  $request->validate([
            "name"=> "required|string|min:3|max:25",
            "email"=> "required|email|unique:user,email,id",
            "password"=> "required|string|min:6|max:25|confirmed",
        ]);
        User::create([
            "name"=> $valedatedUser->name,
            "email"=> $valedatedUser->email,
            "password"=> bcrypt($valedatedUser->password),
            
        ])
    }
}
