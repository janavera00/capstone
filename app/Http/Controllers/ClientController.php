<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\File;
use App\Models\Project;
use App\Models\Request as ModelsRequest;
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
        ]);

        $newImageName = time().'_'.$request['title'].'.'.$request['img']->extension();

        $request['img']->move(public_path('documents'), $newImageName);

        $file = new File;
        $file['title'] = $request['title'];
        $file['description'] = $request['description'];
        $file['project_id'] = $project->id;
        $file['status'] = "Request";
        $file['image_path'] = $newImageName;

        $file->save();

        $req = new ModelsRequest();
        $req['project_id'] = $project->id;
        $req['file_id'] = $file->id;

        $req->save();

        return redirect(url()->previous());
    }

    public function showTasks(Client $client)
    {
        return view('scheduling', ['client' => $client]);
    }

}
