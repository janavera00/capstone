@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ url('project/'.$client->id) }}" class="btn bg-4 py-3 my-2" style="width: 5rem;">
        <i class="fas fa-arrow-left fa fa-2xl"></i>
    </a>
    <div class="container text-white bg-2 rounded overflow-auto mt-2" style="height: 80vh;">
    <!-- Project Information -->
    <div class="row mt-3">
        <!-- header left side -->
        <div class="col-2 border-end">
            <!-- buttons -->
            <div class="">
                <button class="btn btn-primary w-100" onclick="showInfo()">Show More Info</button>
                <button id="collapseBtn" data-bs-toggle="collapse" data-bs-target="#showInfo" hidden></button>
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
            
                <div class="row m-2 pt-2">
                    <p class="col-2 h-100 my-auto">Subject Property Location</p>
                    <div class="col-10 p-2 rounded bg-white text-black">{{ $project->location }}</div>
                </div>

                <!-- collapsible part -->
                <div class="collapse" id="showInfo">

                    @if($project->user_id)
                    <div class="row m-2 pt-2">
                        <p class="col-2 h-100 my-auto">Engineer In-charge</p>
                        <div class="col-10 p-2 rounded bg-white text-black" style="height: 2.7rem;">{{ $project->user->name }}</div>
                    </div>
                    @endif
                    <div class="row m-2 pt-2">
                        <p class="col-2 h-100 my-auto"></p>
                        <div class="col-10 row w-75 ">
                            <div class="col">
                                @if($project->lot_number)
                                <label>Lot Number:</label>
                                <div class="col-10 p-2 rounded bg-white text-black">{{ $project->lot_number }}</div>
                                @endif
                            </div>
                            <div class="col">
                                @if($project->survey_number)
                                <label for="sur_num">Survey Number:</label>
                                <div class="col-10 p-2 rounded bg-white text-black">{{ $project->survey_number }}</div>
                                @endif
                            </div>
                        </div>

                    </div>
                    @if($project->lot_area)
                    <div class="row m-2 pt-2">
                        <p class="col-2 h-100 my-auto">Lot Area</p>
                        <div class="col-10 p-2 rounded bg-white text-black" style="height: 2.7rem;">{{ $project->lot_area }}</div>
                    </div>
                    @endif
                    @if($project->land_owner)
                    <div class="row m-2 pt-2">
                        <p class="col-2 h-100 my-auto">Registered Land Owner</p>
                        <div class="col-10 p-2 rounded bg-white text-black">{{ $project->land_owner }}</div>
                    </div>
                    @endif
                    
                </div>
            
        </div>
    </div>


    <hr>

    <!-- project contents -->
    <div class="row">
        <div class="col-2 border-end py-2">
            <!-- progress tracking -->
            <div>
                <h4 class="text-center">{{ $project->service->name }}</h4>
                <div class="mt-2">
                    <div class="d-flex flex-column p-2">
                        @foreach($project->service->steps as $step)
                            @if($step->stepNo <= $project->stepNo)
                            <div class="btn text-white bg-success mt-2 mx-auto" style="cursor: default; width: fit-content;" data-bs-toggle="tooltip" data-bs-placement="left" title="{{$step->description}}">{{ $step->name }}</div>
                            @else
                            <div class="btn text-white bg-dark mt-2 mx-auto" style="cursor: default; width: fit-content;" data-bs-toggle="tooltip" data-bs-placement="left" title="{{$step->description}}">{{ $step->name }}</div>
                            @endif
                        
                            @if($step->stepNo < count($project->service->steps))
                            <div class="mx-auto" style="width: 30px; height: 30px;">
                                <div class="{{ ($step->stepNo < $project->stepNo)?'bg-success':'bg-dark' }} mx-auto" style="width: 5px; height: 40px;"></div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col row mt-3">
            <!-- documents list -->
            <div class="col-6">
                <div class="rounded mx-2 border border-2 overflow-auto d-flex flex-column mb-5" style="height: 56vh;">
                <!-- header -->
                    <div class="mx-2 row pt-2 border-bottom">
                        <div class="col">
                            <button data-bs-toggle="modal" data-bs-target="#submitDocument" class="btn bg-primary text-white w-100" id="addFileBtn">Submit</button>
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
                            @if($file->status != "Request")
                            <div class="col-6">
                                <div class="m-2 card bg-secondary overflow-auto" onclick="showFile('{{$file->title}}', '{{$file->description}}', '{{$file->image_path}}')" style="cursor: pointer;">
        
                                    <button data-bs-toggle="modal" data-bs-target="#showFile" id="showFileBtn" hidden></button>
        
                                    <div class="card-header">
                                        <h3 class="card-title">{{ $file->title }}</h3>
                                    </div>
                                    <div class="card-body d-flex">
                                        <div class="m-auto w-50">
                                            @if($file->image_path)
                                            <img class="w-100" src="{{ asset('documents/'.$file->image_path) }}" alt="No Image" style="filter: blur(8px)">
                                            @else
                                            <p class="text-center">No Image</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            @endif
                            @endforeach
                        </div>
        
                        @php
                            $request = 0;
                            foreach($project->files as $file){
                                if($file->status == "Request"){
                                    $request++;
                                }
                            } 
                        @endphp
                        @if($request > 0)
                        <div class="d-flex">
                            <h1 class="mx-auto border-bottom px-5 pt-4" style="width: fit-content;">Submitted</h1>
                        </div>
                        <div class="row">
                            @foreach($project->files as $file)
                            @if($file->status == "Request")
                            <div class="col-6">
                                <div class="m-2 card bg-warning text-black overflow-auto" onclick="showFile('{{$file->title}}', '{{$file->description}}', '{{$file->image_path}}')" style="cursor: pointer;">
        
                                    <button data-bs-toggle="modal" data-bs-target="#showFile" id="showFileBtn" hidden></button>
        
                                    <div class="card-header">
                                        <h3 class="card-title">{{ $file->title }}</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="m-auto w-50">
                                            @if($file->image_path)
                                            <img class="w-100" src="{{ asset('documents/'.$file->image_path) }}" alt="No Image" style="filter: blur(8px)">
                                            @else
                                            <p class="text-center">No Image</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            @endif
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>  
            
    
            <!-- tasks list -->
            <div class="col-6">
                <div class="rounded mx-2 border border-2 overflow-auto d-flex flex-column mb-5" style="height: 56vh;">
                    <div class="row border-bottom m-2">
                        <div class="col">
                            <button data-bs-toggle="modal" data-bs-target="#newSched" class="btn btn-primary w-100" id="addScheduleBtn">Request</button>
                        </div>
                        <h1 class="mx-auto col">Tasks</h1>
                        <div class="col"></div>
                    </div>

                    <div class="overflow-auto p-2" style="height: 50vh;">
                        @foreach($project->tasks as $task)
                        @if($task->status != "Request")
                        <div class="my-2 d-flex flex-column">
                            @php
                            $dateTime = $task->date."|".$task->time;
                            $link = "showTask('".$task->task."', '".$dateTime."'";

                            for($i = 0;$i < count($task->employees);$i++){
                                $link .= ", '".$task->employees[$i]->role ." - ". $task->employees[$i]->name ."'";
                                }
                                $link .= ")";
                                @endphp
                                <button class="mx-auto btn btn-primary text-start mt-2" style="width: fit-content;" onclick="{{$link}}">
                                    @php
                                    $time = explode(':', $task->time);
                                    $date = explode('-', $task->date);
                                    @endphp
                                    <h4>{{ date("l, F j | g:i a", mktime($time[0],$time[1], 0, $date[1], $date[2], $date[0])) }}</h4>
                                    <p>{{ $task->task }}</p>
                                </button>
                                <button data-bs-toggle="modal" data-bs-target="#showTask" id="showTaskBtn" hidden></button>
                        </div>
                        @endif
                        @endforeach

                        @php
                            $request = 0;
                            foreach($project->tasks as $task){
                                if($task->status == 'Request'){
                                    $request++;
                                }
                            } 
                        @endphp

                        @if($request > 0)
                            <div class="d-flex">
                                <h1 class="mx-auto border-bottom px-5 pt-4" style="width: fit-content;">Request</h1>
                            </div>
                            @foreach($project->tasks as $task)
                            @if($task->status == "Request")
                            <div class="my-2 d-flex flex-column">
                                @php
                                $dateTime = $task->date."|".$task->time;
                                $link = "showTask('".$task->task."', '".$dateTime."'";

                                for($i = 0;$i < count($task->employees);$i++){
                                    $link .= ", '".$task->employees[$i]->role ." - ". $task->employees[$i]->name ."'";
                                    }
                                    $link .= ")";
                                    @endphp
                                    <button class="mx-auto btn btn-warning text-start mt-2" style="width: fit-content;" onclick="{{$link}}">
                                        @php
                                        $time = explode(':', $task->time);
                                        $date = explode('-', $task->date);
                                        @endphp
                                        <h4>{{ date("l, F j | g:i a", mktime($time[0],$time[1], 0, $date[1], $date[2], $date[0])) }}</h4>
                                        <p>{{ $task->task }}</p>
                                    </button>
                                    <button data-bs-toggle="modal" data-bs-target="#showTask" id="showTaskBtn" hidden></button>
                            </div>
                            @endif
                            @endforeach
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal" id="submitDocument">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
                <div class="modal-header bg-1 text-white">
                    <h1 class="modal-title">Submit a document</h1>
                </div>
                <form action="{{ url('project/'.$project->id.'/submitFile') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body overflow-auto" style="height: 60vh;">
                        <p>Enter the name of the document, a short description of it, and a scanned/photograph copy of the document</p>
                        <hr>
                        <div class="mt-2">
                            <div class="d-flex">
                                <p class="text-danger">*</p>
                                <label for="title">Title:</label>
                            </div>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                            @error('title')
                            <p class="text-danger">* {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="description">Description:</label>
                            <input type="text" name="description" id="description" class="form-control" value="{{ old('description') }}">
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
                    <div class="modal-footer bg-secondary d-flex justify-content-around mb-0">
                        <a class="btn bg-4 text-white" style="width: 200px;" data-bs-dismiss="modal">Cancel</a>
                        <input type="submit" value="Submit" class="btn btn-primary" style="width: 200px;">
                    </div>
                </form>
           
        </div>
    </div>
</div>
@if($errors->has('title') || $errors->has('description') || $errors->has('img'))
<script>
    document.getElementById('addFileBtn').click();
</script>
@endif


<!-- Modal for adding schedule -->
<div class="modal" id="newSched">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header text-white bg-1">
                <h2 class="modal-title">Request task schedule</h2>
            </div>
            
            <form action="{{ url('project/'.$project->id.'/requestTask') }}" method="post">
                @csrf
                <div class="modal-body overflow-auto" style="height: 60vh;">
                    <div class="m-2 p-2 border rounded">
                        <div class="d-flex">
                            <p class="text-danger">*</p>
                            <label for="task" class="form-label">Task:</label>
                        </div>
                        <input type="text" name="task" id="task" class="form-control">
                        @error('task')
                        <p class="text-danger">* {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="m-2 p-2 border rounded">
                        <div class="d-flex">
                            <p class="text-danger">*</p>
                            <label for="date" class="form-label">Date and Time:</label>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="w-100 pe-2 border-end">
                                <input type="date" name="date" id="date" class="form-control">
                                @error('date')
                                <p class="text-danger">* {{ $message }}</p>
                                @enderror
                            </div>

                            <div class="w-100 ps-2">
                                <input type="time" name="time" id="time" class="form-control">
                                @error('time')
                                <p class="text-danger">* {{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="m-2 p-2 border rounded">
                        <label for="remark" class="form-label">Remarks:</label>
                        <input type="text" name="remark" id="remark" class="form-control">
                        @error('remark')
                        <p class="text-danger">* {{ $message }}</p>
                        @enderror
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-around">
                    <a class="btn bg-4 text-white" style="width: 200px;" data-bs-dismiss="modal">Cancel</a>
                    <input type="submit" value="Submit" class="btn btn-primary" style="width: 200px;">
                </div>
            </form>
        </div>
    </div>
</div>
@if($errors->has('task') || $errors->has('date') || $errors->has('time') || $errors->has('remark'))
<script>
    document.getElementById('addScheduleBtn').click();
</script>
@endif


<div class="modal" id="showFile">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-1 text-white">
                <h2 class="modal-title" id="fileTitle"></h2>
            </div>
            <div class="modal-body overflow-auto" style="height: 60vh;">
                <div class="m-2 p-2 border rounded">
                    <img class="w-100" id="fileImage">
                </div>
                <div class="m-2 p-2 border rounded p-2 bg-white rounded">
                    <p class="my-0" id="fileDescription"></p>
                </div>
            </div>
        </div>
    </div>
</div>


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
        </div>
    </div>
</div>

<script>
    function showInfo() {
        const btn = document.getElementById('collapseBtn');
        btn.click();
        btn.textContent = (btn.textContent == 'Show More Info' ? 'Hide Info' : 'Show More Info');
    }

    function showFile(title, description, path) {
        document.getElementById('showFileBtn').click();
        document.getElementById('fileTitle').textContent = title;
        document.getElementById('fileDescription').textContent = description;
        document.getElementById('fileImage').src = `{{ asset('documents/${path}') }}`;
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
</script>


@endsection