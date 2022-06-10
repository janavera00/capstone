<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function show()
    {
        $tasks = Task::all()
            ->sortBy('date')
            ->sortBy('time');
     
        // dd(date('Y-m-d') < $tasks[0]->date);

        foreach($tasks as $task){
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

        
        $users = DB::table('users')->whereNot('role', '=', 'Client')->get();
        $projects = Project::all()->sortByDesc('updated_at');

        return view('scheduling', ['tasks' => $tasks, 'projects' => $projects, 'users' => $users]);
    }

    public function openTask(Task $task, $from)
    {
        $users = User::whereNot('role', '=', 'Client')->get();
        return view('schedDetails', ['task' => $task, 'users' => $users, 'from' => $from]);
    }

    public function showProjectTask(Project $project)
    {
        $projects = Project::all();
        $users = User::whereNot('role', '=', 'Client')->get();

        return view('projectTask', ['projects' => $projects, 'proj' => $project, 'users' => $users]);
    }

    public function createTask(Project $project)
    {
        $request = request()->validate([
            'task' => 'required|max:255',
            'date' => 'required',
            'time' => 'required',
            'employee' => 'required',
        ]);


        $task = new Task();
        $task['task'] = $request['task'];
        $task['date'] = $request['date'];
        $task['time'] = $request['time'];
        if($project->id){
            $task['project_id'] = $project->id;
        }else{
            $request += request()->validate([
                'project' => 'required|exists:projects,id'
            ]);
            $task['project_id'] = $request['project'];
        }

        $task->save();

        foreach($request['employee'] as $user)
        {
            $task->employees()->attach($user);
        }

        $log = new Log;
        $log['actor'] = Auth()->user()->id;
        $log['task_id'] = $task->id;
        $log['remarks'] = "Scheduled a task";
        $log->save();

        return redirect(url()->previous())->with(['success' => 'Task successfully created']);
    }

    public function updateTask(Task $task)
    {
        $request = request()->validate([
            'taskTitle' => 'required',
            'taskDate' => 'required',
            'taskTime' => 'required',
            'taskEmployee' => 'required',
        ]);
        // dd($task->employees);

        $task['task'] = $request['taskTitle'];
        $task['date'] = $request['taskDate'];
        $task['time'] = $request['taskTime'];
        $task['status'] = "Active";
        $task->save();
        
        $task->employees()->detach();

        for($i = 0;$i < count($request['taskEmployee']);$i++)
        {  
            $task->employees()->attach($request['taskEmployee'][$i]);
         
        }

        $log = new Log;
        $log['actor'] = Auth()->user()->id;
        $log['task_id'] = $task->id;
        $log['remarks'] = "updated a task";
        $log->save();

        return redirect(url()->previous())->with(['success' => 'Task successfully updated']);;
    }

    public function resched(Task $task)
    {
        $request = request()->validate([
            'reschedDate' => 'required',
            'reschedTime' => 'required',
        ]);

        $task['date'] = $request['reschedDate'];
        $task['time'] = $request['reschedTime'];
        $task['status'] = "Active";
        $task->save();

        $log = new Log;
        $log['actor'] = Auth()->user()->id;
        $log['task_id'] = $task->id;
        $log['remarks'] = "rescheduled overdue task";
        $log->save();

        return redirect('projectContent/'.$task->project->id)->with(['success' => 'Task rescheduled']);;
    }

    public function delete(Task $task){
        $task['status'] = "Reject";
        $task->save();

        $log = new Log;
        $log['actor'] = Auth()->user()->id;
        $log['task_id'] = $task->id;
        $log['remarks'] = "deleted overdue task";
        $log->save();

        return redirect('projectContent/'.$task->project->id)->with(['success' => 'Task deleted']);;
    }

    public function reject(Task $task){
        $task['status'] = "Reject";
        $task->save();

        $log = new Log;
        $log['actor'] = Auth()->user()->id;
        $log['task_id'] = $task->id;
        $log['remarks'] = "rejected requested task";
        $log->save();

        return redirect('projectContent/'.$task->project->id)->with(['success' => 'Task deleted']);;
    }
    public function accept(Task $task){
        $task['status'] = "Active";
        $task->save();

        $log = new Log;
        $log['actor'] = Auth()->user()->id;
        $log['task_id'] = $task->id;
        $log['remarks'] = "accepted requested task";
        $log->save();

        return redirect('projectContent/'.$task->project->id)->with(['success' => 'Task accepted']);;
    }
    public function done(Task $task){
        $task['status'] = "Done";
        $task->save();

        $log = new Log;
        $log['actor'] = Auth()->user()->id;
        $log['task_id'] = $task->id;
        $log['remarks'] = "task marked as Done";
        $log->save();

        return redirect('projectContent/'.$task->project->id)->with(['success' => $task->task.' is marked as Done']);;
    }
}
