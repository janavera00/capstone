@extends('layouts.navbarOnly')

@section('content')
<div class="container">
    <a href="{{ url('project/'.$client->id) }}" class="btn bg-4 py-3 my-2" style="width: 5rem;">
        <i class="fas fa-arrow-left fa fa-2xl"></i>
    </a>
    <div class="container text-white bg-2 rounded overflow-auto" style="height: 80vh;">
        <!-- Project Information -->
        <div class="row mt-3">
            <div class="col-2">
                <!-- buttons -->
                <div class="d-flex flex-column">
                    <button class="btn btn-success w-100" onclick="showInfo()" id="collapseBtn" data-bs-toggle="collapse" data-bs-target="#showInfo">Show More Info</button>
                    <button data-bs-toggle="modal" data-bs-target="#updateFile" id="updateBtn" hidden></button>
                    <button data-bs-toggle="collapse" data-bs-target="#progress" id="progressBtn" hidden></button>
                </div>
                
                <!-- progress tracking -->
                <div class="collapse" id="progress">
                    <hr>
                    <h4 class="text-center">{{ $project->service->name }}</h4>
                    <div class="overflow-auto mt-2" style="height: 260px;">
                        <div class="d-flex flex-column p-2">
                            @foreach($project->service->steps as $step)
                            <div class="btn text-white {{ ($step->stepNo <= $project->stepNo)?'bg-success':'bg-dark' }} mt-2" style="cursor: default;" data-bs-toggle="tooltip" data-bs-placement="left" title="{{$step->description}}">{{ $step->name }}</div>
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

            <div class="col-10">
                <div class="row m-2 pt-2">
                    <p class="col-2 h-100 my-auto">Client</p>
                    <div class="col-10 p-2 rounded bg-white text-black">{{ $project->client->name }}</div>
                </div>
                <div class="row m-2 pt-2">
                    <p class="col-2 h-100 my-auto">Subject Property Location</p>
                    <div class="col-10 p-2 rounded bg-white text-black">{{ $project->location }}</div>
                </div>
                <div class="collapse" id="showInfo">
                    <div class="row m-2 pt-2">
                        <p class="col-2 h-100 my-auto">Engineer In-charge</p>
                        <div class="col-10 p-2 rounded bg-white text-black">{{ ($project->user_id)?$project->user->name:'' }}</div>
                    </div>
                    <div class="row m-2 pt-2">
                        <p class="col-2 h-100 my-auto"></p>
                        <div class="col-10 row w-75 ">
                            <div class="col">
                                <label for="sur_num">Lot Number:</label>
                                <div class="col-10 p-2 rounded bg-white text-black">{{ ($project->lot_number)?$project->lot_number:'' }}</div>
                            </div>
                            <div class="col">
                                <label for="sur_num">Survey Number:</label>
                                <div class="col-10 p-2 rounded bg-white text-black">{{ ($project->survey_number)?$project->survey_number:'' }}</div>
                            </div>
                        </div>

                    </div>
                    <div class="row m-2 pt-2">
                        <p class="col-2 h-100 my-auto">Lot Area</p>
                        <div class="col-10 p-2 rounded bg-white text-black">{{ ($project->lot_area)?$project->lot_area:'' }}</div>
                    </div>
                    <div class="row m-2 pt-2">
                        <p class="col-2 h-100 my-auto">Registered Land Owner</p>
                        <div class="col-10 p-2 rounded bg-white text-black">{{ ($project->land_owner)?$project->land_owner:'' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="row justify-content-center">
            <div class="col-5 rounded border border-2 d-flex flex-column mx-2">
                <div class="row border-bottom m-2 pb-2">
                    <div class="col">
                        <button data-bs-toggle="modal" data-bs-target="#submitDocument" class="btn btn-primary w-100" id="addFileBtn">Submit a document</button>
                    </div>
                    <h1 class="mx-auto pt-2 col">Documents</h1>
                    <div class="col"></div>
                </div>

                <div class="overflow-auto p-2" style="height: 50vh;">
                    <div class="row">
                        @foreach($project->files as $file)
                        @if($file->status != 'Request')
                        <div class="col-6">
                            <div class="m-2 card bg-secondary overflow-auto" onclick="showFile('{{$file->title}}', '{{$file->description}}', '{{$file->image_path}}')" style="cursor: pointer;">
    
                                <button data-bs-toggle="modal" data-bs-target="#showFile" id="showFileBtn" hidden></button>
    
                                <div class="card-header">
                                    <h3 class="card-title">{{ $file->title }}</h3>
                                </div>
                                <div class="card-body">
                                    @if($file->image_path)
                                    <img class="w-100" src="{{ asset('documents/'.$file->image_path) }}" alt="No Image">
                                    @else
                                    <p class="text-center">No Image</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>

            </div>

            <div class="col-5 rounded border border-2 d-flex flex-column mx-2">
                <div class="row border-bottom m-2 pb-2">
                    <div class="col">
                        <button data-bs-toggle="modal" data-bs-target="#newSched" class="btn btn-primary w-100" id="addScheduleBtn">Request a Schedule</button>
                    </div>
                    <h1 class="mx-auto pt-2 col">Tasks</h1>
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
                            <button class="mx-auto btn btn-primary bg-3 text-start mt-2" onclick="{{$link}}">
                                @php
                                $time = explode(':', $task->time);
                                $date = explode('-', $task->date);
                                @endphp
                                <h2>{{ date("l, F j | g:i a", mktime($time[0],$time[1], 0, $date[1], $date[2], $date[0])) }}</h2>
                                <p>{{ $task->task }}</p>
                            </button>
                            <button data-bs-toggle="modal" data-bs-target="#showTask" id="showTaskBtn" hidden></button>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal" id="submitDocument">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
                <div class="modal-header bg-1 text-white">
                    <h1 class="modal-title">Submit a documment</h1>
                </div>
                <form action="{{ url('project/'.$client->id.'/'.$project->id.'/submitFile') }}" method="post" enctype="multipart/form-data">
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


<!-- Modal for adding schedule -->
<div class="modal" id="newSched">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header text-white bg-1">
                <h2 class="modal-title">Request task schedule</h2>
            </div>
            
            <form action="{{ url('project/'.$client->id.'/'.$project->id.'/requestTask') }}" method="post">
                @csrf
                <div class="modal-body overflow-auto" style="height: 60vh;">
                    <div class="m-2 p-2 border rounded">
                        <div class="d-flex">
                            <p class="text-danger">*</p>
                            <label for="task" class="form-label">Task:</label>
                        </div>
                        <input type="text" name="task" id="task" class="form-control">
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
                        <label for="remark" class="form-label">Remarks:</label>
                        <input type="text" name="remark" id="remark" class="form-control">
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
        document.getElementById('progressBtn').click();
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