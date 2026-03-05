<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
       $valedatedUser=  $request->validate([
            "name"=> "required|string|min:3|max:25",
            "email"=> "required|email|unique:user,email",
            "password"=> "required|string|min:6|max:25|confirmed",
        ]);
        $user = User::create([
            "name"=> $valedatedUser["name"],
            "email"=> $valedatedUser["email"],
            "password"=> Hash::make($valedatedUser["password"]),
            
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            "user"=> $user,
            "access_token"=> $token,

        ]);
    }
}
