<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\File;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class FilingController extends Controller
{
    public function show()
    {
        $clients = Client::all();

        return view('clientLists', ['clients' => $clients]);
    }

    public function showProjects(Client $client)
    {
        return view('projectsList', ['client' => $client]);
    }

    public function showProjectContent(Project $project)
    {
        $users = User::all();
        return view('projectContent', ['project' => $project, 'users' => $users]);
    }

    public function createProject()
    {
        $request = request()->validate([
            'client' => ['required', 'max:255',],
            'location' => ['required', 'max:255',],
        ]);

        $project = new Project();
        $project['location'] = $request['location'];

        $client = Client::where('name', $request['client'])->first();
        
        if(!$client)
        {   
            $request += request()->validate([
                'address' => ['required', 'max:255',],
                'contact' => ['required', 'numeric',],
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
    }

    public function createFile(Project $project)
    {
        $request = request()->validate([
            'title' => 'required|max:255',
            'description' => 'max:255',
            'img' => 'required|mimes:jpg,png,jpeg',
        ]);

        $newImageName = time().'_'.$request['title'].'.'.$request['img']->extension();

        $request['img']->move(public_path('documents'), $newImageName);

        $file = new File();
        $file['title'] = $request['title'];
        $file['description'] = $request['description'];
        $file['image_path'] = $newImageName;
        $file['project_id'] = $project->id;
        $file->save();

        return redirect(url()->previous());
    }

    public function updateFile(File $file)
    {
        $request = request()->validate([
            'fileDescription' => 'max:255',
        ]);

        $file['description'] = $request['fileDescription'];
        $file->save();

        return redirect(url()->previous());
    }

    public function updateProject(Project $project)
    {
        $request = request()->validate([
            'user' => ['exists:users,id'],
            'location' => ['max:255',],
            'lot_num' => ['numeric',],
            'sur_num1' => ['numeric',],
            'sur_num2' => ['numeric',],
            'lot_area' => ['numeric',],
            'land_owner' => ['max:255',],
        ]);

        $project['user_id'] = $request['user'];
        $project['location'] = $request['location'];
        $project['survey_number'] = 'Lot '.$request['lot_num'].' Psd-'.$request['sur_num1'].'-'.$request['sur_num2'];
        $project['lot_area'] = $request['lot_area'].' sqr.m.';
        $project['land_owner'] = $request['land_owner'];
        $project->save();

        
        session(['confirmPass' => 'false']);

        return redirect(url()->previous());
    }

    // might remove
    public function confirmPass(Request $request, Project $project)
    {
        $pass = Hash::make($request->pass);
        if($pass)
        {
            session(['confirmPass' => 'true']);
            // dd(session('confirmPass'));
            return redirect('filing/'.$project->id);
        }
    }
}
