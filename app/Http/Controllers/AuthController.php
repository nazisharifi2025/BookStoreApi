<?php

namespace App\Http\Controllers;

use App\Http\Resources\userResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
       $valedatedUser=  $request->validate([
            "name"=> "required|string|min:3|max:25",
            "email"=> "required|email|unique:users,email",
            "password"=> "required|string|min:6|max:25|confirmed",
        ]);
    //php artisan install:api
    $user = User::create([
        "name"=> $valedatedUser['name'],
        "email"=> $valedatedUser["email"],
        "password"=> Hash::make( $valedatedUser["password"]),

    ]);
    $token = $user->createToken('auth_token')->plainTextToken;
    return response()->json([
        "success"=> true,
        "user"=> new userResource($user),
        "token"=> $token
    ]);

    }
    public function Login(Request $request){
        $request->validate([
            "email"=> "required|string",
            "password"=> "requiered|string",
        ]);
    }
}
