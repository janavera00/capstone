<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\File;
use App\Models\Project;
use App\Models\Request as ModelsRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Validation\ValidationException;

class ClientController extends Controller
{
    public function showProjects(Client $client)
    {
        // dd($client->projects);
        return view('clientProjectList', ['client' => $client]);
    }

    public function showProjectDetail(Client $client, Project $project)
    {
        return view('clientProjectContent', ['client' => $client, 'project' => $project]);
    }

    public function create(Request $request)
    {
        $request = $request->validate([
            'name' => 'required|max:255',
            'address' => 'nullable|max:255',
            'contact' => 'nullable|numeric|regex:/(9)([0-9]{9})/',
            'email' => 'required|max:255|email|unique:clients,email',
            'img' => 'nullable',
            'duplicate' => 'nullable',
        ]);

        if(is_null($request['duplicate'])){
            $exist = Client::where('name', '=', $request['name'])->first();
            
            if(!($exist === null))
            {
                throw ValidationException::withMessages(['duplicate' => 'duplicate']); 
            }
        }else if($request['duplicate'] != 'password'){
            return redirect(url()->previous());
        }
        
        // dd('asjkdhsj');
        $client = new Client;
        $client['name'] = $request['name'];
        $client['address'] = $request['address'];
        $client['contact'] = $request['contact'];
        $client['email'] = $request['email'];
        $client['password'] = Hash::make('password');

        if (count($request) > 5) {
            $newImageName = time() . '_' . $request['name'] . '.' . $request['img']->extension();
            $request['img']->move(public_path('images/users'), $newImageName);

            $client['image'] = $newImageName;
        } else {
            $client['image'] = "default.svg";
        }

        $client->save();

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

        return redirect(url()->previous())->with('success', 'ahhaha');
    }

    public function submitFile(Client $client, Project $project)
    {
        $request = request()->validate([
            'title' => 'required|max:255',
            'description' => 'max:255',
            'img' => 'required|mimes:jpg,png,jpeg',
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

        return redirect(url()->previous());
    }

    public function requestTask(Client $client, Project $project)
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

        return redirect(url()->previous());
    }

}
