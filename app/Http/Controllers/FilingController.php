<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FilingController extends Controller
{
    public function show()
    {
        $projects = Project::all();
        $clients = Client::all();

        // dd($projects);

        return view('filing', ['projects' => $projects, 'clients' => $clients]);
    }

    public function showFiles($project_id)
    {
        $project = Project::find($project_id);
        // dd($project->files);

        return view('file', ['project' => $project]);
    }

    public function createProject(Request $req)
    {
        $request = request()->validate([
            'client' => ['required', 'max:255',],
            'location' => ['required', 'max:255',],
        ]);

        $project = new Project();
        $project['location'] = $request['location'];

        $client = Client::where('name', $req['client'])->first();
        if(!$client)
        {   
            $request += request()->validate([
                'address' => ['required', 'max:255',],
                'contact' => ['required', 'max:9',],
                'email' => ['required', 'max:255', 'email', 'unique:clients,email'],
            ]);
            
            $newClient = new Client();
            
            $newClient['name'] = $request['client'];
            $newClient['address'] = $request['address'];
            $newClient['contact'] = '09'.$request['contact'];
            $newClient['email'] = $request['email'];
            $newClient['password'] = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
            
            $newClient->save();

            $project['client_id'] = $newClient['id'];
            $project->save();
            
            return redirect('filing');
        }

        $project['client_id'] = $client->id;
        $project->save();

        return redirect('filing');

        // if($req['clientError'] == 'show')
        // {
        //     $request += request()->validate([
        //         'address' => ['required', 'max:255',],
        //         'contact' => ['required', 'max:9',],
        //         'email' => ['required', 'max:255', 'email', 'unique:clients,email'],
        //     ]);
            
        //     $newClient = new Client();
            
        //     $newClient['name'] = $request['client'];
        //     $newClient['address'] = $request['address'];
        //     $newClient['contact'] = '09'.$request['contact'];
        //     $newClient['email'] = $request['email'];
        //     $newClient['password'] = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
            
        //     $newClient->save();
        // }
        
        
        // dd($request);
    }
}
