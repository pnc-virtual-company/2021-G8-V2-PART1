<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function signup(Request $request)
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

        return response()->json([
            'message' => 'User Create!',
            'user' => $user
        ]);
    }

    public function signin(Request $request)
    {
        // Check email
        $user = User::where('email', $request->email)->first();

        //Check password
        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json(['message' => "Unauthorized"], 401);
        }
       
        return response()->json([
            'message' => 'Login successfully!',
            'user' => $user
           
        ]);
    }
}
