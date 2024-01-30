<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        return view('registration');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create($validatedData);

        return response()->json(['message' => 'User registered successfully', 'user' => $user]);
    }

    public function getUsers()
    {
        $users = User::all();

        return response()->json(['users' => $users]);
    }
}
