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
        $projects = Project::all();
        $clients = Client::all();

        // dd($projects);

        return view('filing', ['projects' => $projects, 'clients' => $clients]);
    }

    public function showFiles(Project $project)
    {
        $users = User::all();
        return view('file', ['project' => $project, 'users' => $users]);
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
    }

    public function createFile(Project $project)
    {
        $request = request()->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        // $newImageName = time().'_'.$request['title'].'.'.$request['img']->extension();

        // dd($newImageName);

        $file = new File();
        $file['title'] = $request['title'];
        $file['description'] = $request['description'];
        // $file['image_path'] = $request['img'];
        $file['project_id'] = $project->id;
        $file->save();

        return redirect('filing/'.$project->id);
    }

    public function updateFile(File $file)
    {
        $request = request()->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        // $file['title'] = $request['title'];
        $file['description'] = $request['description'];
        // $file['project_id'] = $project->id;
        $file->save();

        return redirect('filing/'.$file->project_id);
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

        // DB::table('projects')
        //     ->where('id', $project)
        //     ->limit(1)
        //     ->update(
        //         ['user_id' => $user->id],
        //         ['location' => $request['location']],
        //         ['survey_number' => 'Lot '.$request['lot_num'].' Psd-'.$request['sur_num1'].'-'.$request['sur_num2']],
        //         ['lot_area' => $request['lot_area'].'sqr.m.'],
        //         ['land_owner' => $request['land_owner']],
        //     );

        // $project = Project::find($project)->get();


        $project['user_id'] = $request['user'];
        $project['location'] = $request['location'];
        $project['survey_number'] = 'Lot '.$request['lot_num'].' Psd-'.$request['sur_num1'].'-'.$request['sur_num2'];
        $project['lot_area'] = $request['lot_area'].' sqr.m.';
        $project['land_owner'] = $request['land_owner'];
        $project->save();

        // dd($project);
        
        session(['confirmPass' => 'false']);

        return redirect('filing/'.$project->id);
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
