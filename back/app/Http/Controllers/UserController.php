<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function signUp(Request $request)
    {
        $request->validate([
            'firstname' => 'required|max:50|regex:/^[a-zA-Z]/',
            'lastname' =>  'required|max:50|regex:/^[a-zA-Z]/',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed'
        ]);
        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        // Create Token
        $token = $user->createToken('mytoken')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function signIn(Request $request)
    {
        // Check email
        $user = User::where('email', $request->email)->first();

        //Check password
        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json(['messang' => "Bad SignIn"], 401);
        }
        // Create Token
        $token = $user->createToken('mytoken')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function signOut(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => "User logged out"]);
    }
}

//1|8bDmXlxTDVdqiZC5Dn3ihNGgP28yKynMN3xrMNh0
