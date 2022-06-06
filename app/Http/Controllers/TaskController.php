<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function show()
    {
        $tasks = Task::all();

        // dd(date('Y-m-d') < $tasks[0]->date);

        foreach($tasks as $task){
            if(date('Y-m-d') > $task->date && $task->status != "Done")
            {
                $task['status'] = "Overdue";
                $task->save();
            }
        }

        $users = User::all();
        $projects = Project::all()->sortByDesc('updated_at');

        $tasks = $tasks->sortBy('date')->sortBy('time');

        return view('scheduling', ['tasks' => $tasks, 'projects' => $projects, 'users' => $users]);
    }

    public function openTask(Task $task, $from)
    {
        $users = User::all();
        return view('schedDetails', ['task' => $task, 'users' => $users, 'from' => $from]);
    }

    public function showProjectTask(Project $project)
    {
        $projects = Project::all();
        $users = User::all();

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

        return redirect(url()->previous());
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

        return redirect(url()->previous());
    }

    public function resched(Task $task)
    {
        $request = request()->validate([
            'taskDate' => 'required',
            'taskTime' => 'required',
        ]);

        $task['date'] = $request['taskDate'];
        $task['time'] = $request['taskTime'];
        $task['status'] = "Active";
        $task->save();

        return redirect(url()->previous());
    }

    public function delete(Task $task){
        $task->employees()->detach();
        $task->delete();

        return redirect(url()->previous());
    }

    public function reject(Task $task){
        $task['status'] = "Reject";
        $task->save();
        return redirect(url()->previous());
    }
    public function accept(Task $task){
        $task['status'] = "Active";
        $task->save();
        return redirect(url()->previous());
    }
}
