<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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

    public function authenticate()
    {
        $projects = Project::where('status', '=', 'Active')->get()->sortByDesc('updated_at');
        $clients = Client::all()->sortByDesc('updated_at');
        $tasks = Task::where('status', '=', 'Active')
                ->orwhere('status', '=', 'Overdue')
                ->get()
                ->sortByDesc('date')
                ->sortByDesc('time');        

        return view('dashboard', ['projects' => $projects, 'clients' => $clients, 'tasks' => $tasks]);
        
        
        $request = request()->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if(Auth::guard('web')->attempt($request)) {
        }
        
        throw ValidationException::withMessages(['username' => 'Your provided credentials could not be verified.']);
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/');
    }
}
