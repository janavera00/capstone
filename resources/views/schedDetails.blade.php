@extends('layouts.app')

@section('content')
<div class="container-fluid w-75">

    <a href="{{ url('scheduling') }}" class="btn bg-4 px-4 py-3 my-4">
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
                    <div class="my-auto">
                        <button class="btn btn-primary" id="editSchedBtn" data-bs-toggle="modal" data-bs-target="#editSched" style="width: 200px;">Edit Schedule</button>
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
                        @error('time')
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
                                @php
                                    for($i = 0;$i < count($task->employees);$i++)
                                    {
                                    $usr = $task->employees[$i]; 
                                @endphp
                                    <tr>
                                        <td>
                                            <select name="taskEmployee[]" class="form-control employee">
                                                @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ ($usr->id == $user->id)?'selected':'' }}>{{ $user->name }} - {{ $user->role }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        @if($i == 0)
                                            <td style="width: 1rem;"><a class="btn btn-success" onclick="addEmployee()">+</a></td>
                                            <td style="width: 1rem;"><a class="btn btn-danger" onclick="removeEmployee()">-</a></td>
                                        @endif
                                    </tr>
                                @php
                                    }
                                    $usr = null;
                                @endphp
                            </table>
                            @error('employee')
                            <p class="text-danger">*{{$message}}</p>
                            @enderror
                        </div>
                        
                    </div>
                    <hr>
                </div>
                <div class="modal-footer bg-secondary d-flex justify-content-around">
                    <a class="btn bg-4 text-white" style="width: 45%;" data-bs-dismiss="modal">Cancel</a>
                    <input type="submit" value="Update" class="btn btn-primary" style="width: 45%;">
                </div>
            </form>
        </div>
    </div>
</div>

@if($errors->any())
<script>
    document.getElementById('editSchedBtn').click();
</script>
@endif




<script>
        let field = document.getElementById('dynamicField');
        const elmt = document.getElementsByTagName('td')[0];
        function addEmployee(){
            const row = document.createElement('tr');
            let inp = elmt.cloneNode(true);
            let empt = document.createElement('option');
            empt.hidden = true;
            empt.selected = true;
            // let selectNode = ;
            inp.childNodes[1].appendChild(empt);

            // console.log(selectNode);
            row.appendChild(inp);
            field.appendChild(row);
        }
        function removeEmployee(){
            if(field.childElementCount > 1)
                field.removeChild(field.lastElementChild);
        }
    </script>
@endsection