@extends('layouts.app')

@section('content')
<div class="container bg-2 mt-3 px-5 rounded">
    <div class="row" style="height: 90vh;">
        <div class="col-4">

            <div class="bg-white mt-4 rounded pb-4" style="height: fit-content;">
                <div class="container overflow-auto pt-3" style="height: 50vh; width: fit-content;">
                    @for($i = 0;$i < 10;$i++) <hr class="text-black">

                        <div class="calendar mt-2" id="{{$i}}">
                            <div class="month">
                                <div class="date">
                                    <h1></h1>
                                </div>
                            </div>
                            <div class="weekdays"></div>
                            <div class="days"></div>
                        </div>
                        @endfor
                </div>
            </div>

            <div class="d-flex bg-white mt-2 p-2 rounded-top" style="border-bottom: 1px black solid;">
                <h2 class="mx-auto">Projects</h2>
            </div>
            <div class="bg-white p-2 overflow-auto rounded-bottom" style="height: 25vh;">
                <table class="table table-light table-hover">
                    @foreach($projects as $project)
                    <tr onclick="location.href='../projectContent/{{$project->id}}'" style="cursor: pointer;">
                        <td>{{ $project->client->name }}</td>
                        <td>{{ $project->location }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <div class="col mt-3">
            <div class="container">
                <div class="row text-white mx-auto mt-2 p-2">
                    <div class="col d-flex">
                        <button class="btn btn-primary m-auto" style="width: 200px;" data-bs-toggle="modal" data-bs-target="#newSched" id="newSchedBtn">Schedule new task</button>
                    </div>
                    <div class="col d-flex">
                        <div class="m-auto text-center" id="date"></div>
                    </div>
                    <div class="col"></div>
                </div>

                <div class="bg-white p-3 rounded overflow-auto d-flex flex-column" style="height: 70vh;">
                    <ul id="eventsOnCalendar" hidden>

                        @foreach($tasks as $task)
                        <li>{{$task->date}}</li>
                        @endforeach

                    </ul>

                    <div class="m-auto" id="selectedDateMessage">
                        <h2 class="text-secondary text-center" style="border-bottom: 1px solid gray; width: fit-content;">No Task Scheduled for this day</h2>
                    </div>
                    
                    @foreach($tasks as $task)
                    @if($task->status == "Active" || $task->status == "Overdue")

                    <div class="selectedDate" id="{{ $task->date }}">
                        <a href="{{ url('task/'.$task->id.'/sched') }}" class="btn btn-{{($task->status == 'Overdue')?'danger':'primary'}} w-100 text-start" style="width: fit-content;">
                            @php
                            $time = explode(':', $task->time);
                            @endphp
                            <h2>{{ date("g:i a", mktime($time[0],$time[1])) }} - {{ $task->task }}</h2>
                            <p>{{ $task->project->client->name }}<br>{{ $task->project->location }}</p>
                        </a>
                        <hr>
                    </div>
                    @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <script src="/js/calendar.js"></script>
</div>


<!-- Modal for adding schedule -->
<div class="modal fade" id="newSched">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header text-white bg-1">
                <h2 class="modal-title">Schedule new task</h2>
            </div>

            <form action="{{ url('scheduling/create') }}" method="post">
                @csrf
                <div class="modal-body overflow-auto" style="height: 60vh;">
                    <div class="mt-2">
                        <label for="task" class="form-label">*Task:</label>
                        <input type="text" name="task" id="task" class="form-control">
                        @error('task')
                        <p class="text-danger">*{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label for="date" class="form-label">*Date and Time:</label>
                        <div class="row justify-content-between">
                            <div class="col">
                                <input type="date" name="date" id="date" class="form-control w-100">
                                @error('date')
                                <p class="text-danger">*{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col">
                                <input type="time" name="time" id="time" class="form-control w-100">
                                @error('time')
                                <p class="text-danger">*{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <label for="project" class="form-label">*Project(client and location):</label>
                        <select name="project" id="project" class="form-control">
                            <option disabled selected hidden></option>
                            @foreach($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->client->name }} - {{ $project->location }}</option>
                            @endforeach
                        </select>
                        @error('project')
                        <p class="text-danger">*{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label for="employee" class="fomr-label">*Employee/s Assigned:</label>
                        <div>
                            <table id="dynamicField" class="w-100">
                                <tr id="toClone" hidden>
                                    <td>
                                        <select name="employee[]" class="form-control employee">
                                            <option selected hidden></option>
                                            @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->role }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr class="d-flex justify-content-around">
                                    <td>
                                        <!-- <input type="text" name="employee[]" id="employee" class="form-control"> -->
                                        <select name="employee[]" class="form-control employee" style="width: 680px;">
                                            <option selected hidden></option>
                                            @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->role }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="d-flex justify-content-around" style="width: 80px;">
                                        <a class="btn btn-success" onclick="addEmployee('dynamicField')" style="width: fit-content;">+</a>
                                        <a class="btn btn-danger" onclick="removeEmployee('dynamicField')" style="width: fit-content;">-</a>
                                    </td>
                                </tr>
                            </table>
                            @error('employee')
                            <p class="text-danger">*{{$message}}</p>
                            @enderror
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
@foreach($errors->all() as $error)
<p>{{$error}}</p>
@endforeach

@if($errors->has('task') || $errors->has('date') || $errors->has('time') || $errors->has('project') || $errors->has('employee'))
<script>
    document.getElementById('newSchedBtn').click();
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
@endsection