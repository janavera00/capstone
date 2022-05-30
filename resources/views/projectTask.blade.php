@extends('layouts.app')

@section('content')
    <div class="container bg-2 mt-3 px-5 rounded">
        <div class="row"  style="height: 90vh;">
            <div class="col-4">
                
                <div class="d-flex bg-white mt-4 p-2 rounded-top" style="border-bottom: 1px black solid;">
                    <h2 class="mx-auto">Projects</h2>
                </div>
                <div class="bg-white p-2 overflow-auto rounded-bottom" style="height: 76vh;">
                    @foreach($projects as $project)
                    <div class="p-2 row" onclick="location.href='../scheduling/{{$project->id}}'" style="cursor: pointer; border-bottom:1px solid ;">
                        <p class="col-4">
                            {{ $project->client->name }}
                        </p>
                        <p class="col">
                            {{ $project->location }}
                        </p>
                    </div>
                    @endforeach
                    
                </div>
            </div>

            <div class="col mt-3">
                <div class="container">
                    <div class="row text-white mx-auto mt-2 p-2 overflow-auto" style="height: 17vh;">
                        <div class="col-2 d-flex flex-column justify-content-between">
                            <button class="btn btn-primary m-auto" data-bs-toggle="modal" data-bs-target="#newSched">Schedule new task</button>
                            <a href="../scheduling" class="btn btn-success m-auto">Show All Tasks</a>
                        </div>
                        <div class="col d-flex">
                            <div class="m-auto text-center">
                                <h1>{{ $proj->client->name }}</h1>
                                <p>{{ $proj->location }}</p>
                            </div>
                        </div>
                        <div class="col-2 d-flex">
                        </div>
                    </div>
            
                    <div class="bg-white p-3 rounded overflow-auto d-flex flex-column" style="height: 65vh;">
    
                        @if(count($proj->tasks) > 0)
                        @foreach($proj->tasks as $task)
                            <div>
                                <a href="{{ url('task/'.$task->id) }}" class="btn btn-primary bg-3 w-100 text-start" style="width: fit-content;">
                                    @php
                                        $time = explode(':', $task->time); 
                                        $date = explode('-', $task->date); 
                                    @endphp
                                    <h2>{{ date("l, F j | g:i a", mktime($time[0],$time[1], 0, $date[1], $date[2], $date[0])) }} | {{ $task->task }}</h2>
                                    <p>{{ $task->project->client->name }}<br>{{ $task->project->location }}</p>
                                </a>
                                <hr>
                            </div>
                        @endforeach
                        @else
                            <div class="m-auto" id="selectedDateMessage">
                                <h2 class="text-secondary text-center" style="border-bottom: 1px solid gray; width: fit-content;">No Task Scheduled for this project</h2>
                            </div>
                        @endif

                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Modal for adding schedule -->
    <div class="modal" id="newSched">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header text-white bg-1">
                    <h2 class="modal-title">Schedule new task</h2>
                </div>

                <form action="{{ url('scheduling/create') }}" method="post">
                    @csrf
                    <div class="modal-body overflow-auto" style="height: 60vh;">
                        <div class="mt-2">
                            <label for="task" class="form-label">Task:</label>
                            <input type="text" name="task" id="task" class="form-control">
                        </div>
                        <div class="mt-2">
                            <label for="date" class="form-label">Date and Time:</label>
                            <div class="d-flex justify-content-between">
                                <input type="date" name="date" id="date" class="form-control" style="width: 49%;">
                                <input type="time" name="time" id="time" class="form-control" style="width: 49%;">
                            </div>
                        </div>
                        <div class="mt-2">
                            <label for="project" class="form-label">Project(client and location):</label>
                            <input type="text" name="project" id="project" class="form-control" value="{{ $proj->id }}" hidden>
                            <input type="text" class="form-control" value="{{ $proj->client->name }} - {{ $proj->location }}" readonly>
                        </div>
                        <div class="mt-2">
                            <label for="employee" class="fomr-label">Employee/s Assigned:</label>
                            <div>
                                <table id="dynamicField" class="w-100">
                                    <tr>
                                        <td>
                                            <!-- <input type="text" name="employee[]" id="employee" class="form-control"> -->
                                            <select name="employee[]" id="employee" class="form-control employee">
                                                <option selected hidden></option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->role }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td style="width: 1rem;"><a class="btn btn-success" onclick="addEmployee()">+</a></td>
                                        <td style="width: 1rem;"><a class="btn btn-danger" onclick="removeEmployee()">-</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-secondary d-flex justify-content-around">
                        <a class="btn bg-4 text-white" style="width: 200px;" data-bs-dismiss="modal">Cancel</a>
                        <input type="submit" value="Add" class="btn btn-primary" style="width: 200px;">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let field = document.getElementById('dynamicField');
        const elmt = document.getElementById('employee');
        function addEmployee(){
            const row = document.createElement('tr');
            row.appendChild(elmt.cloneNode(true));
            field.appendChild(row);
        }
        function removeEmployee(){
            if(field.childElementCount > 1)
                field.removeChild(field.lastElementChild);
        }
    </script>
@endsection