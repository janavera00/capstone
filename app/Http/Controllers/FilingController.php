<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\File;
use App\Models\Project;
use App\Models\Service;
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
        $users = User::all();
        return view('projectsList', ['client' => $client, 'users' => $users]);
    }

    public function showProjectContent(Project $project)
    {
        $users = User::all();
        return view('projectContent', ['project' => $project, 'users' => $users]);
    }

    public function createProject(Client $client)
    {
        $request = request()->validate([
            'engr' => ['exists:users,id', 'nullable'],
            'loc' => ['required', 'max:255',],
            'lotNum' => ['numeric', 'nullable'],
            'surNum' => ['regex:/[0-9]{2}(-)[0-9]{6}/', 'nullable'],
            'lotArea' => ['numeric', 'nullable'],
            'landOwn' => ['max:255', 'nullable'],
        ]);

        $project = Project::all();
        $exist = true;

        foreach($project as $proj)
        {
            if(('Psd-'.$request['surNum']) == $proj->survey_number)
            {
                $exist = false;
            }
        }

        if($exist){
            $project = new Project();

            $project['client_id'] = $client->id;
            $project['user_id'] = $request['engr'];
            $project['location'] = $request['loc'];
            $project['lot_number'] = ($request['lotNum'])?'Lot '.$request['lotNum']:'';
            $project['survey_number'] = ($request['surNum'])?'Psd-'.$request['surNum']:'';
            $project['lot_area'] = $request['lotArea'];
            $project['land_owner'] = $request['landOwn'];
            $project->save();
    
            return redirect('projectContent/'.$project->id);
        }

        throw ValidationException::withMessages(['surveyNo' => 'Survey Number already exist']);
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

        // dd($request);

        $project['user_id'] = $request['user'];
        $project['location'] = $request['location'];
        $project['lot_number'] = ($request['lot_num'])?'Lot '.$request['lot_num']:'';
        $project['survey_number'] = ($request['sur_num1'] && $request['sur_num2'])?'Psd-'.$request['sur_num1'].'-'.$request['sur_num2']:'';
        $project['lot_area'] = $request['lot_area'].' sqr.m.';
        $project['land_owner'] = $request['land_owner'];
        $project->save();

        
        session(['confirmPass' => 'false']);

        return redirect(url()->previous());
    }

    public function updateStep(Project $project, $step)
    {
        $project['stepNo'] = $step;
        $project->save();

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
