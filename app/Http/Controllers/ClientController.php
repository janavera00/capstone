<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\File;
use App\Models\Log;
use App\Models\Project;
use App\Models\Request as ModelsRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Validation\ValidationException;

class ClientController extends Controller
{
    public function showProjects()
    {
        // dd($client->projects);
        return view('clientProjectList');
    }

    public function showProjectDetail(User $client, Project $project)
    {
        return view('clientProjectContent', ['client' => $client, 'project' => $project]);
    }

    public function create(Request $request)
    {
        $request = $request->validate([
            'name' => 'required|max:255',
            'address' => 'nullable|max:255',
            'contact' => 'nullable|numeric|regex:/(9)([0-9]{9})/',
            'email' => 'nullable|max:255|email|unique:users,email',
            'username' => 'required|max:255|unique:users,username',
            'img' => 'nullable',
            'duplicate' => 'nullable',
        ]);

        if(is_null($request['duplicate'])){
            $exist = DB::table('users')->where('name', '=', $request['name'])->where('role', '=', 'Client')->first(); 
            
            if(!($exist === null))
            {
                throw ValidationException::withMessages(['duplicate' => 'duplicate']); 
            }
        }else if($request['duplicate'] != 'password'){
            return redirect(url()->previous());
        }
        
        // dd('asjkdhsj');
        $client = new User;
        $client['name'] = $request['name'];
        $client['address'] = $request['address'];
        $client['contact'] = $request['contact'];
        $client['email'] = $request['email'];
        $client['username'] = $request['username'];
        $client['role'] = "Client";
        $client['password'] = Hash::make('password');

        if (count($request) > 6) {
            $newImageName = time() . '_' . $request['name'] . '.' . $request['img']->extension();
            $request['img']->move(public_path('images/users'), $newImageName);

            $client['image'] = $newImageName;
        } else {
            $client['image'] = "default.svg";
        }

        $client->save();

        $log = new Log();
        $log['actor'] = Auth()->user()->id;
        $log['client_id'] = $client->id;
        $log['remarks'] = "created client's account";
        $log->save();

        return redirect(url()->previous());
    }

    public function update(Client $client)
    {
        $request = request()->validate([
            'address' => 'max:255',
            'contact' => 'numeric|regex:/(09)([0-9]{9})/',
        ]);

        $client['address'] = $request['address'];
        $client['contact'] = $request['contact'];
        $client->save();

        $log = new Log();
        $log['actor'] = Auth()->user()->id;
        $log['client_id'] = $client->id;
        $log['remarks'] = "updated client's account";
        $log->save();

        return redirect(url()->previous())->with('success', 'ahhaha');
    }

    public function submitFile(Project $project)
    {
        $request = request()->validate([
            'title' => 'required|max:255',
            'description' => 'max:255',
            'img' => 'required',
            'remark' => 'max:255',
        ]);

        $newImageName = time() . '_' . $request['title'] . '.' . $request['img']->extension();
        $request['img']->move(public_path('documents'), $newImageName);

        $file = new File;
        $file['title'] = $request['title'];
        $file['description'] = $request['description'];
        $file['status'] = "Request";
        $file['project_id'] = $project->id;
        $file['image_path'] = $newImageName;

        $file->save();

        $req = new ModelsRequest();
        $req['file_id'] = $file->id;
        $req['status'] = "Request";

        $req->save();

        $log = new Log();
        $log['actor'] = Auth()->user()->id;
        $log['file_id'] = $file->id;
        $log['remarks'] = "submitted document";
        $log->save();

        return redirect(url()->previous());
    }

    public function requestTask(Project $project)
    {
        $request = request()->validate([
            'task' => 'required|max:255',
            'date' => 'required',
            'time' => 'required',
            'remark' => 'max:255',
        ]);

        $task = new Task;
        $task['task'] = $request['task'];
        $task['date'] = $request['date'];
        $task['time'] = $request['time'];
        $task['status'] = "Request";
        $task['project_id'] = $project->id;
        $task->save();

        $req = new ModelsRequest();
        $req['task_id'] = $task->id;
        $req['remarks'] = $request['remark'];
        $req['status'] = "Request";
        $req->save();

        $log = new Log();
        $log['actor'] = Auth()->user()->id;
        $log['task_id'] = $task->id;
        $log['remarks'] = "requested for a task";
        $log->save();

        return redirect(url()->previous());
    }

}
