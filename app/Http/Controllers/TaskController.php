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
        $projects = Project::all();
        $users = User::all();

        return view('scheduling', ['tasks' => $tasks, 'projects' => $projects, 'users' => $users]);
    }

    public function openTask(Task $task)
    {
        $users = User::all();
        return view('schedDetails', ['task' => $task, 'users' => $users]);
    }

    public function createTask()
    {
        $request = request()->validate([
            'task' => 'required|max:255',
            'date' => 'required',
            'time' => 'required',
            'project' => 'required',
            'employee' => 'required',
        ]);

        $task = new Task();
        $task['task'] = $request['task'];
        $task['date'] = $request['date'];
        $task['time'] = $request['time'];
        $task['project_id'] = $request['project'];
        $task->save();

        foreach($request['employee'] as $user)
        {
            $task->employees()->attach($user);
        }

        return redirect('scheduling');
    }

    public function updateTask(Task $task)
    {
        $request = request()->validate([
            'title' => 'required',
            'date' => 'required',
            'time' => 'required',
            'employee' => 'required',
        ]);
        // dd($task->employees);

        $task['task'] = $request['title'];
        $task['date'] = $request['date'];
        $task['time'] = $request['time'];
        $task->save();

        for($i = 0;$i < count($request['employee']);$i++)
        {
            $exist = false;
            for($j = 0;$j < count($task->employees);$j++)
            {
                if($request['employee'][$i] == $task->employees[$j]->id)
                {
                    $exist = true;
                }
            }

            if(!$exist)
            {
                $task->employees()->attach($request['employee'][$i]);
            }
        }

        return redirect('/scheduling/'.$task->id);
    }
}
