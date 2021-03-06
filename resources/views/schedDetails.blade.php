@extends('layouts.app')

@section('content')
<div class="container-fluid w-75">

    <a href="{{ ($from == 'project')?url('projectContent/'.$task->project->id):url('scheduling') }}" class="btn bg-4 px-4 py-3 my-4">
        <i class="fas fa-arrow-left fa fa-2xl"></i>
    </a>

    <div class="container bg-2 text-white rounded p-5" style="height: 42rem;">
        <div class="d-flex flex-column justify-content-between px-5 h-100">
            <div class="d-flex justify-content-between mx-5">
                <h3 class="p-3">Task:</h3>
                <div class="w-75 rounded p-3 ps-4 h3 bg-white text-black">{{ ($task->task)?$task->task:'' }}</div>
            </div>
            <div class="d-flex justify-content-between mx-5">
                <h3 class="p-3">Schedule:</h3>
                @php
                    if($task->date) {
                        $date = explode('-', $task->date);
                        $day = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                    }
                    if($task->time) {
                        $time = explode(':', $task->time);
                    }
                @endphp
                <div class="w-75 h3 text-black d-flex justify-content-between">
                    <div class="bg-white p-3 ps-4 rounded" style="width: 24%;">{{ ($date)?$day[(date("N", mktime(0,0,0,$date[1],$date[2],$date[0]))-1)]:'' }}</div>
                    <div class="bg-white p-3 ps-4 rounded" style="width: 49%;">{{ ($date)?date("F j, Y", mktime(0,0,0,$date[1],$date[2],$date[0])):'' }}</div>
                    <div class="bg-white p-3 ps-4 rounded" style="width: 24%;">{{ ($time)?date("g:i a", mktime($time[0],$time[1])):'' }}</div>
                </div>
            </div>
            <div class="d-flex justify-content-between mx-5">
                <h3 class="p-3">Client:</h3>
                <div class="w-75 rounded p-3 ps-4 h3 bg-white text-black">{{ $task->project->client->name }}</div>
            </div>
            <div class="d-flex justify-content-between mx-5">
                <h3 class="p-3">Location:</h3>
                <div class="w-75 rounded p-3 ps-4 h3 bg-white text-black">{{ $task->project->location }}</div>
            </div>

            <div class="mx-5">
                <div class="d-flex justify-content-between">
                    <h3 class="p-3">Employee Assigned:</h3>
                </div>

                <div class="d-flex justify-content-around">
                    <div class="overflow-auto rounded bg-white w-50 ms-5" style="height: 11rem;">
                        <ul class="list-group list-group-vertical h4">
                            @foreach($task->employees as $employee)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between m-1">
                                    <div class="w-100">{{ $employee->name }}</div>
                                    -
                                    <div class="w-100 text-end">{{ $employee->role }}</div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="my-auto d-flex flex-column">
                        @if($task->project->status != 'Archived')
                        @if(Auth()->user()->role == "Head of Office" || Auth()->user()->role == "Secretary")
                            <button class="btn btn-primary my-2" id="editSchedBtn" data-bs-toggle="modal" data-bs-target="#editSched">Edit Schedule</button>
                            <a href="{{ url('taskDone/'.$task->id) }}" class="btn btn-success my-2">Mark as Done</a>
                            
                            @if($task->status == "Overdue")
                                <a href="{{ url('deleteTask/'.$task->id) }}" class="btn btn-danger my-2">Remove</a>
                                <a data-bs-toggle="modal" href="#resched" class="btn btn-success my-2">Reschedule</a>
                            @elseif($task->status == "Request")
                                <a href="{{ url('taskReject/'.$task->id) }}" class="btn btn-danger my-2">Reject</a>
                                <a href="{{ url('taskAccept/'.$task->id) }}" class="btn btn-success my-2">Accept</a>
                            @endif
                        @endif
                        @endif
                    </div>

                </div>
            </div>
            
        </div>
    </div>
</div>

<!-- Modal for editing schedule -->
<div class="modal" id="editSched">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header text-white bg-1">
                <h2 class="modal-title">Edit Schedule</h2>
            </div>

            <form action="{{ url('scheduling/update/'.$task->id) }}" method="post">
                @csrf
                <div class="modal-body overflow-auto" style="height: 60vh;">
                    <div class="mt-2">
                        <label for="taskTitle" class="form-label">Title:</label>
                        <input type="text" name="taskTitle" id="taskTitle" class="form-control" value="{{ ($task->task)?$task->task:'' }}">
                        @error('taskTitle')
                        <p class="text-danger">*{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="taskDate" class="form-label">Date:</label>
                        <input type="date" name="taskDate" id="taskDate" class="form-control" value="{{ ($task->date)?$task->date:'' }}">
                        @error('taskDate')
                        <p class="text-danger">*{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="taskTime" class="form-label">Time:</label>
                        <input type="time" name="taskTime" id="taskTime" class="form-control" value="{{ ($task->time)?$task->time:'' }}">
                        @error('taskTime')
                        <p class="taskText-danger">*{{$message}}</p>
                        @enderror
                    </div>
                    <hr>
                    <div>
                        <label for="time" class="form-label">Client:</label>
                        <div class="border rounded px-2 py-1" style="background-color: #b8b8b8;">{{ $task->project->client->name }}</div>
                    </div>
                    <div>
                        <label for="time" class="form-label">Project Location:</label>
                        <div class="border rounded px-2 py-1" style="background-color: #b8b8b8;">{{ $task->project->location }}</div>
                    </div>
                    <hr>
                    <div class="mb-2">
                        <label for="assigned" class="form-label">Assigned To:</label>
                        <div>
                            <table id="dynamicField" class="w-100">
                                <tr id="toClone" hidden>
                                    <td>
                                        <select name="taskEmployee[]" class="form-control employee" style="width: 680px;"> 
                                            <option selected hidden></option>
                                            @foreach($users as $user)
                                            @if($user->role != 'Head of Office')
                                            <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->role }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                
                                @if(count($task->employees) < 1)
                                <tr class="d-flex justify-content-around">
                                    <td>
                                        <!-- <input type="text" name="employee[]" id="employee" class="form-control"> -->
                                        <select name="taskEmployee[]" class="form-control employee" style="width: 680px;">
                                            <option selected hidden></option>
                                            @foreach($users as $user)
                                            @if($user->role != 'Head of Office')
                                            <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->role }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="d-flex justify-content-around" style="width: 80px;">
                                        <a class="btn btn-success" onclick="addEmployee('dynamicField')" style="width: fit-content;">+</a>
                                        <a class="btn btn-danger" onclick="removeEmployee('dynamicField')" style="width: fit-content;">-</a>
                                    </td>
                                </tr>
                                @endif
                                @php
                                    for($i = 0;$i < count($task->employees);$i++)
                                    {
                                    $usr = $task->employees[$i]; 
                                @endphp
                                <tr>
                                    <td>
                                        <!-- <input type="text" name="employee[]" id="employee" class="form-control"> -->
                                        <select name="taskEmployee[]" class="form-control employee" style="width: 680px;">
                                            <option value=""></option>
                                            @foreach($users as $user)
                                            @if($user->role != 'Head of Office')
                                            <option value="{{ $user->id }}" {{ ($usr->id == $user->id)?'selected':'' }}>{{ $user->name }} - {{ $user->role }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </td>

                                    @if($i == 0)
                                    <td class="d-flex justify-content-around" style="width: 80px;">
                                        <a class="btn btn-success" onclick="addEmployee('dynamicField')" style="width: fit-content;">+</a>
                                        <a class="btn btn-danger" onclick="removeEmployee('dynamicField')" style="width: fit-content;">-</a>
                                    </td>
                                    @endif
                                </tr>
                                @php
                                    }
                                    $usr = null;
                                @endphp
                            </table>

                            @error('taskEmployee')
                            <p class="text-danger">*{{$message}}</p>
                            @enderror
                        </div>
                        
                    </div>
                   
                </div>
                <div class="modal-footer bg-secondary">
                    <a class="btn bg-4 text-white" data-bs-dismiss="modal">Cancel</a>
                    <input type="submit" value="Update" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="resched">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-1"><h1 class="modal-title text-white">Reschedule Task</h1></div>
            <form action="{{ url('reschedule/'.$task->id) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="m-2 p-2 border rounded">
                        <label for="reschedDate">Date</label>
                        <input type="date" name="reschedDate" id="reschedDate" class="form-control">
                    </Div>
                    <div class="m-2 p-2 border rounded">
                        <label for="reschedTime">Time</label>
                        <input type="time" name="reschedTime" id="reschedTime" class="form-control">
                    </div>
                </div>
                <div class="modal-footer bg-secondary">
                    <a data-bs-dismiss="modal" class="btn btn-danger">Cancel</a>
                    <input type="submit" value="Reschedule" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

@foreach($errors->all() as $error)
<p>{{ $error }}</p>
@endforeach

@if($errors->any())
<script>
    document.getElementById('editSchedBtn').click();
</script>
@endif




<script>
    function addEmployee(name) {
        let field = document.getElementById(name);
        const elmt = field.childNodes[1].childNodes[0];
        const newElmt = elmt.cloneNode(true);
        newElmt.hidden = false;
        // console.log(newElmt.childNodes);
        field.childNodes[1].appendChild(newElmt);
    }

    function removeEmployee(name) {
        let field = document.getElementById(name).childNodes[1];
        if (field.childElementCount > 2)
            field.removeChild(field.lastElementChild);
    }
</script>

@if(session()->has('success'))      
    <div class="modal" id="success">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success"><h1 class="modal-title text-white">Success</h1></div>
                <div class="modal-body d-flex flex-column">
                    <p class="m-auto">{{ session()->get('success') }}</p>
                    <button class="btn btn-primary mx-auto" data-bs-dismiss="modal">Continue</button>
                </div>
            </div>
        </div>
    </div>
    <button data-bs-toggle="modal" data-bs-target="#success" id="successBtn" hidden></button>
    <script>
        document.getElementById('successBtn').click();
    </script>
    @endif
@endsection