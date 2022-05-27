<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
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

    public function showTasks(Client $client)
    {
        return view('scheduling', ['client' => $client]);
    }

    public function delete(Client $client)
    {
        $client->delete();

        return redirect('filing');
    }
}
