@extends('layouts.app')

@section('content')

<!-- back button -->
<div class="container px-0">
    <a href="{{ url('projects/'.$project->client->id) }}" class="btn btn-danger mt-4"><img src="{{asset('images/assets/arrow-left-solid-white.svg')}}" width="30rem"></a>
</div>
<div class="container text-white bg-2 rounded overflow-auto mt-2" style="height: 80vh;">
    <!-- Project Information -->
    <div class="row mt-3">
        <!-- header left side -->
        <div class="col-2 border-end">
            <!-- buttons -->
            <div class="bg-white text-black rounded d-flex mb-2" style="height: 5rem;">
                <h1 class="m-auto"><?php printf('%05d', $project->id); ?></h1>
            </div>
            <div class="">
                <button class="btn btn-primary w-100" onclick="showInfo()" id="collapseBtn" data-bs-toggle="collapse" data-bs-target="#showInfo">Show More Info</button>
                <button data-bs-toggle="modal" data-bs-target="#updateFile" id="updateBtn" hidden></button>
                <button data-bs-toggle="collapse" data-bs-target="#progress" id="progressBtn" hidden></button>
            </div>
            <div class="collapse" id="progress">
                <hr>
                <h4 class="text-center">{{ $project->service->name }}</h4>
                <div class="overflow-auto mt-2" style="height: 230px;">
                    <div class="d-flex flex-column p-2">
                        @foreach($project->service->steps as $step)
                        <a href="{{ url('updateProject/step/'.$project->id.'/'.$step->stepNo) }}" data-bs-toggle="tooltip" data-bs-placement="left" title="{{$step->description}}" class="btn {{($step->stepNo <= $project->stepNo)?'btn-success':'btn-dark'}}">{{ $step->name }}</a>
                        @if($step->name != "Done")
                        <div class="mx-auto" style="width: 30px; height: 30px;">
                            <div class="bg-1 mx-auto" style="width: 5px; height: 40px;"></div>
                        </div>
                        @endif
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- header right side -->
        <div class="col-10">
            <!-- project's information -->
            <div class="row m-2 pt-2">
                <p class="col-2 h-100 my-auto">Client</p>
                <div class="col-10 p-2 rounded bg-white text-black">{{ $project->client->name }}</div>
            </div>
            <!-- project updating form -->
            <form action="{{ url('project/update/'.$project->id) }}" method="post">
                @csrf
                <div class="row m-2 pt-2">
                    <p class="col-2 h-100 my-auto">Subject Property Location</p>
                    <input type="text" name="location" id="location" class="col form-control" autocomplete="off" value="{{$project->location}}">
                </div>

                <!-- collapsible part -->
                <div class="collapse" id="showInfo">
                    <div class="row m-2 pt-2">
                        <p class="col-2 h-100 my-auto">Engineer In-charge</p>
                        <select name="user" id="user" class="col form-control">
                            @if(!$project->user_id)
                            <option selected hidden></option>
                            @endif
                            @foreach($users as $user)
                            <option value="{{$user->id}}" {{($project->user_id == $user->id)?'selected':''}}>{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row m-2 pt-2">
                        <p class="col-2 h-100 my-auto"></p>
                        <div class="col-10 row w-75 ">
                            <div class="col">
                                <label>Lot Number:</label>
                                <div class="d-flex">
                                    <p class="p-2">Lot </p>
                                    <input type="text" name="lot_num" id="lot_num" class="form-control" style="height: 2.5rem;" autocomplete="off" value="{{($project->lot_number)?explode(' ', $project->lot_number)[1]:''}}">
                                </div>
                            </div>
                            <div class="col">

                                <label for="sur_num">Survey Number:</label>
                                <div class="d-flex">
                                    <p class="py-2">Psd-</p>
                                    <input type="text" name="sur_num1" id="sur_num1" class="form-control" style="height: 2.5rem; width: 3rem;" maxlength="2" autocomplete="off" value="{{($project->survey_number)?explode('-', $project->survey_number)[1]:''}}">
                                    
                                    <p class="py-2">-</p>
                                    <input type="text" name="sur_num2" id="sur_num2" class="form-control" style="height: 2.5rem;" maxlength="6" autocomplete="off" value="{{($project->survey_number)?explode('-', $project->survey_number)[2]:''}}">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row m-2 pt-2">
                        <p class="col-2 h-100 my-auto">Lot Area</p>

                        <div class="col-10 d-flex" style="padding-left: 0px;">
                            <input type="text" name="lot_area" id="lot_area" class="form-control w-25" value="{{ ($project->lot_area)?(explode(' ', $project->lot_area))[0]:'' }}">
                            <p class="p-2 my-auto">sqr.m.</p>
                        </div>
                    </div>
                    <div class="row m-2 pt-2">
                        <p class="col-2 h-100 my-auto">Registered Land Owner</p>
                        <input type="text" name="land_owner" id="land_owner" class="form-control col" value="{{ ($project->land_owner)?$project->land_owner:'' }}">
                    </div>
                    <hr>
                    <!-- update button -->
                    <div class="my-2 d-flex justify-content-center">
                        <input type="submit" value="Update" class="btn bg-3 text-white" style="width: 12rem;">
                    </div>
                </div>
            </form>
        </div>
    </div>


    <hr>

    <!-- project contents -->
    <div class="row justify-content-center">
        <!-- documents list -->
        <div class="col-5 rounded mx-2 border border-2 overflow-auto d-flex flex-column mb-5" style="height: 56vh;">
            <!-- header -->
            <div class="mx-2 row pt-2 border-bottom">
                <div class="col">
                    <button data-bs-toggle="modal" data-bs-target="#addDocument" class="btn bg-3 text-white w-100" id="addFileBtn">Add</button>
                </div>
                <h1 class="col text-center">Documents</h1>
                <div class="col"></div>
            </div>

            <div class="overflow-auto m-1" style="height: 50vh;">
                @if(count($project->files) < 1) 
                <div class="w-100 h-100 d-flex pb-5">
                    <h1 class="m-auto text-secondary" style="width: fit-content; border-bottom:1px solid gray">Document list empty</h1>
                </div>
                @endif
                <div class="row">
                    @foreach($project->files as $file)
                    <div class="col-6">
                        <a href="#file-{{$file->id}}" class="text-white text-decoration-none" data-bs-toggle="modal">
                            <div class="m-2 card bg-secondary overflow-auto">
    
                                <button data-bs-toggle="modal" data-bs-target="#showFile" id="showFileBtn" hidden></button>
    
                                <div class="card-header">
                                    <h3 class="card-title">{{ $file->title }}</h3>
                                </div>
                                <div class="card-body">
                                    @if($file->image_path)
                                    <img class="w-100" src="{{ asset('documents/'.$file->image_path) }}" alt="{{ $file->image_path }}">
                                    @else
                                    <p class="text-center">No Image</p>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    <!-- tasks list -->
    <div class="col-5 rounded border border-2 overflow-auto d-flex flex-column" style="height: 56vh;">
        <div class="mx-2 row pt-2 border-bottom">
            <div class="col">
                <button data-bs-toggle="modal" data-bs-target="#newSched" class="btn bg-3 text-white w-100" id="addScheduleBtn">Schedule a Task</button>
            </div>
            <h1 class="col text-center">Tasks</h1>
            <div class="col">
                <a href="{{ url('scheduling') }}" class="btn btn-success w-100">Show all task</a>
            </div>
        </div>
        
        <div class="overflow-auto m-1" style="height: 50vh;">
            @if(count($project->tasks) < 1) 
            <div class="w-100 h-100 d-flex pb-5">
                <h1 class="m-auto text-secondary text-center" style="width: fit-content; border-bottom:1px solid gray">No tasks scheduled</h1>
            </div>
            @endif
            @foreach($project->tasks as $task)
            <div class="my-2 d-flex flex-column">
                @php
                $dateTime = $task->date."|".$task->time;
                $link = "showTask('".$task->task."', '".$dateTime."'";
    
                for($i = 0;$i < count($task->employees);$i++){
                    $link .= ", '".$task->employees[$i]->role ." - ". $task->employees[$i]->name ."'";
                    }
                    $link .= ")";
                    @endphp
                    <button class="mx-auto btn btn-primary bg-3 text-start mt-2" onclick="{{$link}}">
                        @php
                        $time = explode(':', $task->time);
                        $date = explode('-', $task->date);
                        @endphp
                        <h2>{{ date("l, F j | g:i a", mktime($time[0],$time[1], 0, $date[1], $date[2], $date[0])) }}</h2>
                        <p>{{ $task->task }}</p>
                    </button>
                    <button data-bs-toggle="modal" data-bs-target="#showTask" id="showTaskBtn" hidden></button>
                    <button data-bs-toggle="modal" data-bs-target="#task-{{$task->id}}" id="editTask-{{$task->id}}" hidden></button>
            </div>
            @endforeach
        </div>

    </div>
</div>
</div>



<!-- modal for adding a document -->
<div class="modal" id="addDocument">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-1 text-white">
                <h1 class="modal-title">Add a new documment</h1>
            </div>
            <form action="{{ url('project/'.$project->id.'/createFile') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body overflow-auto" style="height: 60vh;">
                    <p>Enter the name of the document, a short description of it, and a scanned/photograph copy of the document</p>
                    <hr>
                    <div class="mt-2">
                        <div class="d-flex">
                            <p class="text-danger">*</p>
                            <label for="title">Title:</label>
                        </div>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" autocomplete="off" required>
                        @error('title')
                        <p class="text-danger">* {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label for="description">Description:</label>
                        <input type="text" name="description" id="description" class="form-control" value="{{ old('description') }}" autocomplete="off">
                        @error('description')
                        <p class="text-danger">* {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <div class="d-flex">
                            <p class="text-danger">*</p>
                            <label for="img">Document:</label>
                        </div>
                        <input type="file" name="img" id="img" class="form-control" accept="image/*" value="{{ old('img') }}">
                        @error('img')
                        <p class="text-danger">* {{ $message }}</p>
                        @enderror
                    </div>

                </div>
                <div class="modal-footer bg-secondary">
                    <a class="btn bg-4 text-white" style="width: 200px;" data-bs-dismiss="modal">Cancel</a>
                    <input type="submit" value="Add" class="btn btn-primary" style="width: 200px;">
                </div>
            </form>

        </div>
    </div>
</div>


<!-- Modal for adding schedule -->
<div class="modal" id="newSched">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header text-white bg-1">
                <h2 class="modal-title">Schedule a new task</h2>
            </div>

            <form action="{{ url('scheduling/create/'.$project->id) }}" method="post">
                @csrf
                <div class="modal-body overflow-auto" style="height: 60vh;">
                    <div class="m-2 p-2 border rounded">
                        <div class="d-flex">
                            <p class="text-danger">*</p>
                            <label for="task" class="form-label">Task:</label>
                        </div>
                        <input type="text" name="task" id="task" class="form-control" autocomplete="off">
                    </div>
                    <div class="m-2 p-2 border rounded">
                        <div class="d-flex">
                            <p class="text-danger">*</p>
                            <label for="date" class="form-label">Date and Time:</label>
                        </div>
                        <div class="d-flex justify-content-between">
                            <input type="date" name="date" id="date" class="form-control" style="width: 49%;">
                            <input type="time" name="time" id="time" class="form-control" style="width: 49%;">
                        </div>
                    </div>

                    <div class="m-2 p-2 border rounded">
                        <label for="employee" class="fomr-label">Employee/s Assigned:</label>
                        <div>
                            <table id="dynamicField" class="w-100">
                                <tr id="toClone" hidden>
                                    <td>
                                        <!-- <input type="text" name="employee[]" id="employee" class="form-control"> -->
                                        <select name="employee[]" class="form-control employee">
                                            <option selected hidden></option>
                                            @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->role }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <!-- <input type="text" name="employee[]" id="employee" class="form-control"> -->
                                        <select name="employee[]" class="form-control employee">
                                            <option selected hidden></option>
                                            @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->role }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td style="width: 1rem;"><a class="btn btn-success" onclick="addEmployee('dynamicField')">+</a></td>
                                    <td style="width: 1rem;"><a class="btn btn-danger" onclick="removeEmployee('dynamicField')">-</a></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="modal-footer bg-secondary">
                    <a class="btn bg-4 text-white" style="width: 200px;" data-bs-dismiss="modal">Cancel</a>
                    <input type="submit" value="Submit" class="btn btn-primary" style="width: 200px;">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- showing and updating document's information -->
@foreach($project->files as $file)
<div class="modal" id="file-{{$file->id}}">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ url('file/update/'.$file->id) }}" method="post">
                @csrf
                <div class="modal-header bg-1 text-white">
                    <h2 class="modal-title" id="fileTitle">{{ $file->title }}</h2>
                </div>
                <div class="modal-body overflow-auto" style="height: 60vh;">
                    <div class="m-2 p-2 border rounded">
                        <img class="w-100" id="fileImage" src="{{ asset('documents/'.$file->image_path) }}">
                    </div>
                    <div class="m-2 p-2 border rounded p-2 bg-white rounded">
                        <p class="my-2">Description: </p>
                        <input type="text" name="fileDescription" id="fileDescription" class="form-control" autocomplete="off" value="{{ $file->description }}">
                    </div>
                </div>
                <div class="modal-footer bg-secondary">
                    <input type="submit" value="Update" class="btn btn-primary" style="width: 15rem;">
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- showing task's information -->
@if(count($project->tasks) > 0)
<div class="modal" id="showTask">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-1 text-white">
                <h2 class="modal-title" id="taskTitle"></h2>
            </div>
            <div class="modal-body">
                <div class="my-2 row">
                    <p class="col-2 pt-2">Schedule:</p>
                    <h2 class="col-9 p-2 border rounded" id="taskSchedule"></h2>
                </div>
                <div class="my-2">
                    <p>Employees Assigned:</p>
                    <ul class="border rounded" id="taskEmployees"></ul>
                </div>
            </div>
            <div class="modal-footer bg-secondary">
                <button class="btn btn-primary" onclick="editTask('{{$task->id}}')">Edit Task</button>
            </div>
        </div>
    </div>
</div>
@endif

<!-- modal for editing task -->
@foreach($project->tasks as $task)
<div class="modal" id="task-{{$task->id}}">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header text-white bg-1">
                <h2 class="modal-title">Edit task</h2>
            </div>

            <form action="{{ url('scheduling/update/'.$task->id) }}" method="post">
                @csrf
                <div class="modal-body overflow-auto" style="height: 60vh;">
                    <div class="m-2 p-2 border rounded">
                        <div class="d-flex">
                            <p class="text-danger">*</p>
                            <label for="title" class="form-label">Task:</label>
                        </div>
                        <input type="text" name="title" id="title" class="form-control" autocomplete="off" value="{{$task->task}}">
                    </div>
                    <div class="m-2 p-2 border rounded">
                        <div class="d-flex">
                            <p class="text-danger">*</p>
                            <label for="date" class="form-label">Date and Time:</label>
                        </div>
                        <div class="d-flex justify-content-between">
                            <input type="date" name="date" id="date" class="form-control" style="width: 49%;" value="{{$task->date}}">
                            <input type="time" name="time" id="time" class="form-control" style="width: 49%;" value="{{$task->time}}">
                        </div>
                    </div>

                    <div class="m-2 p-2 border rounded">
                        <label for="employee" class="fomr-label">Employee/s Assigned:</label>
                        <div>
                            <table id="editDynamicField" class="w-100">
                                <tr id="toClone" hidden>
                                    <td>
                                        <select name="employee[]" class="form-control employee">
                                            <option hidden selected></option>
                                            @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->role }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                @for($i = 0;$i < count($task->employees);$i++)
                                    <tr>
                                        <td>
                                            <select name="employee[]" class="form-control employee">
                                                @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{($task->employees[$i]->id == $user->id)?'selected':''}}>{{ $user->name }} - {{ $user->role }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        @if($i == 0)
                                        <td style="width: 1rem;"><a class="btn btn-success" onclick="addEmployee('editDynamicField')">+</a></td>
                                        <td style="width: 1rem;"><a class="btn btn-danger" onclick="removeEmployee('editDynamicField')">-</a></td>
                                        @endif
                                    </tr>
                                    @endfor
                            </table>
                        </div>
                    </div>

                </div>
                <div class="modal-footer bg-secondary">
                    <a class="btn bg-4 text-white" style="width: 200px;" data-bs-dismiss="modal">Cancel</a>
                    <input type="submit" value="Submit" class="btn btn-primary" style="width: 200px;">
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<script>
    function showInfo() {
        const btn = document.getElementById('collapseBtn');
        document.getElementById('progressBtn').click();
        btn.textContent = (btn.textContent == 'Show More Info' ? 'Hide Info' : 'Show More Info');
    }

    function showFile() {
        document.getElementById('showFileBtn').click();
        
        const node = document.getElementById(arguments[0]).classList;
        node.remove('d-node');
    }

    function showTask() {
        document.getElementById('showTaskBtn').click();
        document.getElementById('taskTitle').textContent = arguments[0];

        let dateSplit = arguments[1].split("|");
        let date = new Date(dateSplit[0].split("-")[0], dateSplit[0].split("-")[1], dateSplit[0].split("-")[2], dateSplit[1].split(":")[0], dateSplit[1].split(":")[1]);

        const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        let minutes = ('0' + date.getMinutes()).slice(-2);

        document.getElementById('taskSchedule').textContent = `${days[date.getDay()]} | ${months[date.getMonth()]} ${date.getDate()}, ${date.getFullYear()} | ${(date.getHours())%12}:${minutes} ${(date.getHours() > 12)?'pm':'am'}`;

        let employeeContainer = document.getElementById('taskEmployees');
        removeAllChildNodes(employeeContainer);

        for (let i = 2; i < arguments.length; i++) {
            const node = document.createElement('li');
            node.appendChild(document.createTextNode(arguments[i]));
            employeeContainer.appendChild(node);
        }
    }

    function removeAllChildNodes(parent) {
        while (parent.firstChild) {
            parent.removeChild(parent.firstChild);
        }
    }

    function editTask(task) {
        document.getElementById('editTask-' + task).click();
    }


    function addEmployee(name) {
        let field = document.getElementById(name);
        const elmt = field.childNodes[1].childNodes[0];
        const newElmt = elmt.cloneNode(true);
        newElmt.hidden = false;

        field.childNodes[1].appendChild(newElmt);
    }

    function removeEmployee(name) {
        let field = document.getElementById(name).childNodes[1];
        if (field.childElementCount > 2)
            field.removeChild(field.lastElementChild);
    }
</script>

@endsection