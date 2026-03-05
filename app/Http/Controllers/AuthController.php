<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function Auth(Request $request){
        $request->validate([
            "name"=> "required|string|min:3|max:25",
        ])
    }
}
