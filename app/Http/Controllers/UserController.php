<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show()
    {
        $users = User::all();

        return view('userProfile', ['users' => $users]);
    }

    public function create()
    {
        $request = request()->validate([
            'name' => 'required',
            'address' => 'required',
            'contact' => ['required', 'regex:/(09)([0-9]{9})/'],
            'email' => 'email|unique:users,email',
            'user' => 'required|unique:users,username',
            'pass' => 'required',
            'role' => 'required',
        ]);

        $user = new User;
        $user['name'] = $request['name'];
        $user['address'] = $request['address'];
        $user['contact'] = $request['contact'];
        $user['email'] = $request['email'];
        $user['username'] = $request['user'];
        $user['password'] = Hash::make($request['pass']);
        $user['role'] = $request['role'];
        $user->save();

        return redirect(url()->previous());
    }
}
