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
        $valedatedUser =$request->validate([
            "email"=> "required|string",
            "password"=> "requiered|string",
        ]);
        $user = User::where('email', $valedatedUser['email'])->first();
        if(!$user || !Hash::check($valedatedUser['password'] , $user->password)){
            return response()->json([
                "seccess"=> false,
                "message"=> "Not Authorized",
            ]);
        }
        $token = $user->createToken('auth_token',['read' , 'dalete'])->plainTextToken;
    return response()->json([
        "success"=> true,
        "token"=> $token
    ]);
    }
    public function logout(Request $request){
           $request->user()->tokens()->delete();
          return response()->json([
            "data"=> "you are logged Out"
          ]);
    }
}
