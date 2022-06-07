<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Log;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            'address' => 'nullable',
            'contact' => ['nullable', 'regex:/(09)([0-9]{9})/'],
            'email' => 'nullable|email|unique:users,email',
            'user' => 'required|unique:users,username',
            'pass' => 'required',
            'img' => 'nullable',
            'role' => 'required',
        ]);

        // dd($request);
        
        $user = new User;
        $user['name'] = $request['name'];
        $user['address'] = $request['address'];
        $user['contact'] = $request['contact'];
        $user['email'] = $request['email'];
        $user['username'] = $request['user'];
        $user['password'] = bcrypt($request['pass']);
        $user['role'] = $request['role'];

        if(count($request) > 7)
        {
            $newImageName = time() . '_' . $request['name'] . '.' . $request['img']->extension();
            $request['img']->move(public_path('images/users'), $newImageName);
    
            $user['image'] = $newImageName;
        }else{
            $user['image'] = "default.svg";
        }
        $user->save();


        $log = new Log;
        $log['actor'] = Auth()->user()->id;
        $log['user_id'] = $user->id;
        $log['remarks'] = "Created User Account";
        $log->save();

        return redirect(url()->previous());
    }

    public function authenticate()
    {
        $request = request()->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        // dd(filter_var($request['username'], FILTER_VALIDATE_EMAIL));
        
        if(Auth::guard('web')->attempt($request)) {
            if(Auth()->user()->role == "Client"){
                // dd(Auth()->user()->role == "Client");
                return redirect('project');
            }else{
                $projects = Project::all();

                $clients = DB::table('users')
                        ->where('role', '=', 'Client')
                        ->orderBy('updated_at', 'desc')
                        ->get();
                        
                $tasks = DB::table('tasks')
                        ->orderBy('status', 'desc')
                        ->orderBy('date')
                        ->orderBy('time')
                        ->get();



                return view('dashboard', ['projects' => $projects, 'clients' => $clients, 'tasks' => $tasks]);
            }
        }
        
        
        
        throw ValidationException::withMessages(['username' => 'Your provided credentials could not be verified.']);
    }

    public function home()
    {
        $projects = Project::all();

        $clients = DB::table('users')
                ->where('role', '=', 'Client')
                ->orderBy('updated_at', 'desc')
                ->get();
                
        $tasks = DB::table('tasks')
                ->orderBy('status', 'desc')
                ->orderBy('date')
                ->orderBy('time')
                ->get();
        // Task::all()->sortBy('date')->sortBy('time'); 

        // dd($projects, $clients, $tasks);

        return view('dashboard', ['projects' => $projects, 'clients' => $clients, 'tasks' => $tasks]);
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/');
    }
}
