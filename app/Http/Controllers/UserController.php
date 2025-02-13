<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\StudentController;


class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([

            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed',
        ]);
        
        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        if($user){
            return redirect()->route('login')->with('success', 'Registration successful. Please login.');
        }                    
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('view.students')->with('login', 'Login successful.');
        } else {
            return redirect()->route('login')->with('login','Invalid credentials.');
        }

    }

    public function logout()
    {
        Auth::logout();
        // return view('login');
        return redirect()->route('login')->with('logout', 'Logout successful.');
    }

    public function loginCheck() {
        return redirect()->route('login')->with('Please login first.');
    }


}
