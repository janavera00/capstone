<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\File;
use App\Models\Log;
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
        $clients = DB::table('users')->where('role', '=', 'Client')->orderBy('updated_at', 'desc')->get();
        // dd($clients);
        return view('clientLists', ['clients' => $clients]);
    }
    
    public function showProjects(User $client)
    {
        $users = DB::table('users')->whereNot('role', '=', 'Client')->get();
        $clients = DB::table('users')->where('role', '=', 'Client')->get();
        $services = DB::table('services')->get();
        
        if($client->id === null){
            $projects = DB::table('projects')->orderBy('updated_at')->get();
            return view('projectsList', ['projects' => $projects, 'users' => $users, 'services' => $services]);
        }
        
        // dd($projects);
        return view('projectsList', ['client' => $client, 'clients'=> $clients, 'users' => $users, 'services' => $services]);
    }

    public function showProjectContent(Project $project)
    {
        $users = DB::table('users')->whereNot('role', '=', 'Client')->get();

        foreach($project->tasks as $task){
            if(date('Y-m-d') > $task->date && $task->status == "Active")
            {
                $task['status'] = "Overdue";
                $task->save();
            }
            
            if($task->project->status == 'Archived'){
                $task['status'] = "Reject";
                $task->save();
            }
        }

        // dd($project);
        return view('projectContent', ['project' => $project, 'users' => $users]);
    }

    public function createProject(User $client)
    {
        // dd(request()->all());
        $request = request()->validate([
            'type' => ['exists:services,id', 'required'],
            'engr' => ['exists:users,id', 'nullable'],
            'loc' => ['required', 'max:255',],
            'lotNum' => ['numeric', 'nullable'],
            'surNum' => ['regex:/[0-9]{2}(-)[0-9]{6}/', 'nullable'],
            'lotArea' => ['numeric', 'nullable'],
            'landOwn' => ['max:255', 'nullable'],
        ]);

        $project = DB::table('projects')->where('survey_number', '=', 'Psd-'.$request['surNum'])->get();

        if(count($project) == 0){
            $project = new Project();

            $project['client_id'] = $client->id;
            $project['service_id'] = $request['type'];
            $project['stepNo'] = 1;
            $project['user_id'] = $request['engr'];
            $project['location'] = $request['loc'];
            $project['lot_number'] = ($request['lotNum'])?'Lot '.$request['lotNum']:'';
            $project['survey_number'] = ($request['surNum'])?'Psd-'.$request['surNum']:'';
            $project['lot_area'] = $request['lotArea'];
            $project['land_owner'] = $request['landOwn'];
            $project->save();

            $log = new Log();
            $log['actor'] = Auth()->user()->id;
            $log['project_id'] = $project->id;
            $log['remarks'] = "created a project";
            $log->save();
    
            return redirect('projectContent/'.$project->id)->with(['success' => $project->service->name.' successfully initiated.']);
        }

        throw ValidationException::withMessages(['surveyNumber' => 'Survey Number already exist']);
    }

    public function createFile(Project $project)
    {
        // validate input
        $request = request()->validate([
            'title' => 'required|max:255',
            'description' => 'max:255',
            'img' => 'required',
        ]);

        // change filename of image
        $newImageName = time().'_'.$request['title'].'.'.$request['img']->extension();
        $request['img']->move(public_path('documents'), $newImageName);

        // save 
        $file = new File();
        $file['title'] = $request['title'];
        $file['description'] = $request['description'];
        $file['image_path'] = $newImageName;
        $file['project_id'] = $project->id;
        $file->save();

        $log = new Log();
        $log['actor'] = Auth()->user()->id;
        $log['file_id'] = $file->id;
        $log['remarks'] = "created a file";
        $log->save();

        return redirect(url()->previous())->with(['success' => $file->title.' successfully added.']);
    }

    public function updateFile(File $file)
    {
        $request = request()->validate([
            'fileDescription' => 'max:255',
        ]);

        $file['description'] = $request['fileDescription'];
        $file->save();

        $log = new Log();
        $log['actor'] = Auth()->user()->id;
        $log['file_id'] = $file->id;
        $log['remarks'] = "updated a file";
        $log->save();

        return redirect(url()->previous());
    }

    public function updateProject(Project $project)
    {
        $request = request()->validate([
            'user' => ['exists:users,id', 'nullable'],
            'location' => ['max:255',],
            'lot_num' => ['numeric', 'nullable'],
            'sur_num' => ['nullable'],
            'lot_area' => ['numeric', 'nullable'],
            'land_owner' => ['max:255', 'nullable'],
        ]);


        $project['user_id'] = $request['user'];
        $project['location'] = $request['location'];
        $project['lot_number'] = ($request['lot_num'])?'Lot '.$request['lot_num']:'';
        $project['survey_number'] = ($request['sur_num'])?'Psd-'.$request['sur_num']:'';
        $project['lot_area'] = ($request['lot_area'])?$request['lot_area'].' sqr.m.':'';
        $project['land_owner'] = $request['land_owner'];
        $project->save();

        $log = new Log();
        $log['actor'] = Auth()->user()->id;
        $log['project_id'] = $project->id;
        $log['remarks'] = "updated a project";
        $log->save();

        return redirect(url()->previous())->with(['success' => 'Projcet successfully added.']);
    }

    public function updateStep(Project $project, $step)
    {
        
        $project['stepNo'] = $step;
        $project->save();

        if(count($project->service->steps) == $step)
        {
            $project['status'] = "Archived";
            $project->save();
            $log = new Log();
            $log['actor'] = Auth()->user()->id;
            $log['project_id'] = $project->id;
            $log['remarks'] = "project marked as Done";
            $log->save();
            return redirect('projects/'.$project->client->id)->with(['success' => 'Project moved to '.$project->service->steps[$project->stepNo-1]->name]);
        }
        $log = new Log();
        $log['actor'] = Auth()->user()->id;
        $log['project_id'] = $project->id;
        $log['remarks'] = "updated a project";
        $log->save();

        return redirect(url()->previous())->with(['success' => 'Project moved to '.$project->service->steps[$project->stepNo-1]->name]);
    }

    public function search(Request $request)
    {
        if($request->search === null){
            return redirect('clients');
        }

        $clients = User::where('role', '=', 'Client')
                    ->where("name", "LIKE", "%{$request->search}%")
                    ->orWhere("address", "LIKE", "%{$request->search}%")
                    ->where('role', '=', 'Client')->get();
        
        $projects = Project::where("survey_number", "LIKE", "%{$request->search}%")
                    ->orWhere("land_owner", "LIKE", "%{$request->search}%")->get();

        return view('clientLists', ['clients' => $clients, 'projects' => $projects]);
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

    public function reject(File $file){
        $file['status'] = "Reject";
        $file->save();

        $log = new Log();
        $log['actor'] = Auth()->user()->id;
        $log['file_id'] = $file->id;
        $log['remarks'] = "rejected a submitted file";
        $log->save();

        return redirect(url()->previous());
    }
    public function accept(File $file){
        $file['status'] = "Digital";
        $file->save();

        $log = new Log();
        $log['actor'] = Auth()->user()->id;
        $log['file_id'] = $file->id;
        $log['remarks'] = "accepted a submitted file";
        $log->save();

        return redirect(url()->previous());
    }
}
