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
        return view('client/filing', ['client' => $client]);
    }

    public function showProjectDetail(Project $project)
    {
        return view('client/file', ['project' => $project]);
    }

    public function showTasks(Client $client)
    {
        return view('client/scheduling', ['client' => $client]);
    }

    public function delete(Client $client)
    {
        $client->delete();

        return redirect('filing');
    }
}
