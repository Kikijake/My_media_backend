<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // USER LOGIN AND RELESE TOKEN
    public function login(Request $request){
        $user = User::where('email',$request->email)->first();
        if($user){
            if(Hash::check($request->password,$user->password)){
                return response()->json([
                    'user' => $user,
                    'token' => $user->createToken(time())->plainTextToken
                    ]
                );
            }else{
                return response()->json([
                    'user' => null,
                    'token' => null,
                    'password' => false,
                    ]
                );
            }
        }else{
            return response()->json([
                'user' => null,
                'token' => null,
                'user' => false,
                ]
            );
        }
    }

    public function register(Request $request){
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password) ,
        ];

        User::create($data);

        $user = User::where('email',$request->email)->first();

        return response()->json([
            'user' => $user,
            'token' => $user->createToken(time())->plainTextToken
            ]
        );
    }
}
