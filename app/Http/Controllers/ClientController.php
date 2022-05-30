<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\File;
use App\Models\Project;
use App\Models\Request as ModelsRequest;
use App\Models\Task;
use Illuminate\Http\Request;

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

    public function submitFile(Client $client, Project $project)
    {
        $request = request()->validate([
            'title' => 'required|max:255',
            'description' => 'max:255',
            'img' => 'required|mimes:jpg,png,jpeg',
            'remark' => 'max:255',
        ]);

        $newImageName = time().'_'.$request['title'].'.'.$request['img']->extension();

        $request['img']->move(public_path('documents'), $newImageName);

        $file = new File;
        $file['title'] = $request['title'];
        $file['description'] = $request['description'];
        $file['status'] = "Request";
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
