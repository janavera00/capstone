@extends('layouts.app')

@section('content')

<!-- back button -->
<div class="container px-0">
    <a href="{{ url('projects/'.$project->client->id) }}" class="btn btn-danger mt-4"><img src="{{asset('images/assets/arrow-left-solid-white.svg')}}" width="30rem"></a>
</div>
<!-- header -->
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
                <button class="btn btn-primary w-100" onclick="showInfo()">Show More Info</button>
                <button id="collapseBtn" data-bs-toggle="collapse" data-bs-target="#showInfo" hidden></button>
                <button data-bs-toggle="modal" data-bs-target="#updateFile" id="updateBtn" hidden></button>
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
                    <hr>
                    <!-- update button -->
                    <div class="my-2 d-flex justify-content-center">
                        <button class="btn btn-primary" id="projectUpdateBtn" data-bs-toggle="modal" data-bs-target="#projectUpdate">Update</button>    
                    </div>
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
                            <a href="{{ url('updateProject/step/'.$project->id.'/'.$step->stepNo) }}" style="width: fit-content;" data-bs-toggle="tooltip" data-bs-placement="left" title="{{$step->description}}" class="btn btn-dark mt-2 mx-auto">{{ $step->name }}</a>
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
                <div class="rounded mx-2 border border-2 overflow-auto d-flex flex-column mb-5" style="height: 53vh;">
                <!-- header -->
                    <div class="mx-2 row pt-2 border-bottom">
                        <div class="col">
                            <button data-bs-toggle="modal" data-bs-target="#addDocument" class="btn bg-primary text-white w-100" id="addFileBtn">Add</button>
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
                                <a href="#file-{{$file->id}}" class="text-white text-decoration-none" data-bs-toggle="modal">
                                    <div class="m-2 card bg-secondary overflow-auto">
        
                                        <button data-bs-toggle="modal" data-bs-target="#showFile" id="showFileBtn" hidden></button>
        
                                        <div class="card-header">
                                            <h4 class="card-title">{{ $file->title }}</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="w-50 m-auto bg-white rounded p-2">
                                                @if($file->image_path)
                                                <img class="w-100" src="{{ asset('documents/'.$file->image_path) }}" alt="No Image" style="filter: blur(8px);">
                                                @else
                                                <p class="text-center">No Image</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
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
                                <a href="#file-{{$file->id}}" class="text-white text-decoration-none" data-bs-toggle="modal">
                                    <div class="m-2 card bg-warning text-black overflow-auto">
        
                                        <button data-bs-toggle="modal" data-bs-target="#showFile" id="showFileBtn" hidden></button>
        
                                        <div class="card-header">
                                            <h4 class="card-title">{{ $file->title }}</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="w-50 m-auto bg-white rounded p-2">
                                                @if($file->image_path)
                                                <img class="w-100" src="{{ asset('documents/'.$file->image_path) }}" alt="No Image">
                                                @else
                                                <p class="text-center">No Image</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
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
                <div class="rounded mx-2 border border-2 overflow-auto d-flex flex-column mb-5" style="height: 53vh;">
                    <div class="mx-2 row pt-2 border-bottom">
                        <div class="col">
                            <button data-bs-toggle="modal" data-bs-target="#newSched" class="btn bg-primary text-white w-100" id="addScheduleBtn">Schedule a Task</button>
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
                        
                        @foreach($project->tasks->sortByDesc('status') as $task)
                        @if($task->status == "Active" || $task->status == "Overdue")
                        <div class="my-2 d-flex flex-column">
                            <a href="{{ url('task/'.$task->id.'/project') }}" class="mx-auto btn btn-{{($task->status == 'Overdue')?'danger':'primary'}} text-start mt-2" style="width: fit-content;">
                                @php
                                $time = explode(':', $task->time);
                                $date = explode('-', $task->date);
                                @endphp
                                <h4>{{ date("l, F j | g:i a", mktime($time[0],$time[1], 0, $date[1], $date[2], $date[0])) }}</h4>
                                <p>{{ $task->task }}</p>
                            </a>
                        </div>
                        @endif
                        @endforeach
                        
                        @php
                            $request = 0;
                            foreach($project->tasks as $task){
                                if($task->status == "Request"){
                                    $request++;
                                }
                            } 
                        @endphp

                        @if($request > 0)
                            <div class="d-flex">
                                <h1 class="mx-auto border-bottom px-5 pt-4" style="width: fit-content;">Request</h1>
                            </div>
                            @foreach($project->tasks->sortByDesc('status') as $task)
                            @if($task->status == "Request")
                            <div class="my-2 d-flex flex-column">
                                <a href="{{ url('task/'.$task->id.'/project') }}" class="mx-auto btn btn-{{($task->status == 'Overdue')?'danger':'warning'}} text-start mt-2" style="width: fit-content;">
                                    @php
                                    $time = explode(':', $task->time);
                                    $date = explode('-', $task->date);
                                    @endphp
                                    <h4>{{ date("l, F j | g:i a", mktime($time[0],$time[1], 0, $date[1], $date[2], $date[0])) }}</h4>
                                    <p>{{ $task->task }}</p>
                                </a>
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


<!-- start of modals -->
<!-- ---------------------------------------------------------------------------------------------------------------------- -->
<!-- Modal for updateing project details -->
<div class="modal fade" id="projectUpdate">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header text-white bg-1">
                <h2 class="modal-title">Update project details</h2>
            </div>

            <form action="{{ url('project/update/'.$project->id) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="m-2 p-2 border rounded">
                        <label>Subject Property Location</label>
                        <input type="text" name="location" id="location" class="form-control" autocomplete="off" value="{{$project->location}}">
                        @error('location')
                        <p class="text-danger">*{{$message}}</p>
                        @enderror
                    </div>
    
                    <div class="m-2 p-2 border rounded">
                        <label>Engineer In Charge</label>
                        <select name="user" id="user" class="form-control">
                            @if(!$project->user_id)
                            <option selected></option>
                            @endif
                            @foreach($users as $user)
                            @if($user->role == 'Engineer')
                            <option value="{{$user->id}}" {{($project->user_id == $user->id)?'selected':''}}>{{$user->name}}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('user')
                        <p class="text-danger">*{{$message}}</p>
                        @enderror
                    </div>
                    <div class="m-2 p-2 border rounded">

                        <div class="col-10 row w-75 ">
                            <div class="col border-end">
                                <label>Lot Number</label>
                                <div class="d-flex">
                                    <p class="p-2">Lot </p>
                                    <input type="text" name="lot_num" id="lot_num" class="form-control" style="height: 2.5rem;" autocomplete="off" value="{{($project->lot_number)?explode(' ', $project->lot_number)[1]:''}}">
                                </div>
                                @error('lot_num')
                                <p class="text-danger">*{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col">
    
                                <label for="sur_num">Survey Number</label>
                                <div class="d-flex">
                                    <p class="py-2">Psd-</p>
                                    <input type="text" name="sur_num1" id="sur_num1" class="form-control" style="height: 2.5rem; width: 3rem;" maxlength="2" autocomplete="off" value="{{($project->survey_number)?explode('-', $project->survey_number)[1]:''}}">
    
                                    <p class="py-2">-</p>
                                    <input type="text" name="sur_num2" id="sur_num2" class="form-control" style="height: 2.5rem;" maxlength="6" autocomplete="off" value="{{($project->survey_number)?explode('-', $project->survey_number)[2]:''}}">
                                </div>
                                @error('sur_num1')
                                <p class="text-danger">*{{$message}}</p>
                                @enderror
                                @error('sur_num2')
                                <p class="text-danger">*{{$message}}</p>
                                @enderror
                            </div>
                        </div>
    
                    </div>
                    <div class="m-2 p-2 border rounded">
                        <label>Lot Area</label>
    
                        <div class="col-10 d-flex" style="padding-left: 0px;">
                            <input type="text" name="lot_area" id="lot_area" class="form-control w-25" value="{{ ($project->lot_area)?(explode(' ', $project->lot_area))[0]:'' }}">
                            <p class="px-2 my-auto">sqr.m.</p>
                            @error('lot_area')
                            <p class="text-danger">*{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="m-2 p-2 border rounded">
                        <label>Registered Land Owner</label>
                        <input type="text" name="land_owner" id="land_owner" class="form-control col" value="{{ ($project->land_owner)?$project->land_owner:'' }}">
                        @error('land_owner')
                        <p class="text-danger">*{{$message}}</p>
                        @enderror
                    </div>

                </div>
                
                
                <!-- update button -->
                <div class="modal-footer bg-secondary">
                    <input type="submit" value="Update" class="btn bg-3 text-white" style="width: 12rem;">
                </div>
                
            </form>
        </div>
    </div>
</div>
<!-- automatically open the modal if any of the following errors exists -->
@if($errors->has('location') || $errors->has('user') || $errors->has('lot_num') || $errors->has('sur_num1') || $errors->has('sur_num2') || $errors->has('lot_area') || $errors->has('land_owner')) 
<script>
    document.querySelector('#projectUpdateBtn').click();
</script>
@endif




<!-- ---------------------------------------------------------------------------------------------------------------------- -->
<!-- modal for adding a document -->
<div class="modal fade" id="addDocument">
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
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" autocomplete="off">
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
<!-- automatically open the modal if any of the following errors exists -->
@if($errors->has('title') || $errors->has('description') || $errors->has('img')) 
<script>
    document.querySelector('#addFileBtn').click();
</script>
@endif



<!-- ---------------------------------------------------------------------------------------------------------------------- -->
<!-- Modal for adding schedule -->
<div class="modal fade" id="newSched">
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
                        <input type="text" name="task" id="task" class="form-control" value="{{ old('task') }}" autocomplete="off">
                        @error('task')
                        <p class="text-danger">* {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="m-2 p-2 border rounded">
                        <div class="d-flex">
                            <p class="text-danger">*</p>
                            <label for="date" class="form-label">Date and Time:</label>
                        </div>
                        <div class="row">
                            <div class="col border-end">
                                <input type="date" name="date" id="date" class="form-control w-100" value="{{ old('date') }}">
                                @error('date')
                                <p class="text-danger">* {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col">
                                <input type="time" name="time" id="time" class="form-control  w-100" value="{{ old('time') }}">
                                @error('time')
                                <p class="text-danger">* {{ $message }}</p>
                                @enderror
                            </div>
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
                                            @if($user->role != 'Head of Office')
                                            <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->role }}</option>
                                            @endif
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
                                            @if($user->role != 'Head of Office')
                                            <option value="{{ $user->id }}" {{(old('task') == $user->id)?'selected':''}}>{{ $user->name }} - {{ $user->role }}</option>
                                            @endif
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
                            <p class="text-danger">* {{ $message }}</p>
                            @enderror
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
@if($errors->has('task') || $errors->has('date') || $errors->has('time') || $errors->has('employee')) 
<script>
    document.querySelector('#addScheduleBtn').click();
</script>
@endif



<!-- ---------------------------------------------------------------------------------------------------------------------- -->
<!-- showing and updating document's information -->
@foreach($project->files as $file)
<div class="modal fade" id="file-{{$file->id}}">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ url('file/update/'.$file->id) }}" method="post">
                @csrf
                <div class="modal-header bg-1 text-white">
                    <h2 class="modal-title" id="fileTitle">{{ $file->title }}</h2>
                </div>
                <div class="modal-body overflow-auto" style="height: 60vh;">
                    <div class="m-2 p-2 border rounded p-2 bg-white rounded">
                        <p class="my-2">Description: </p>
                        <input type="text" name="fileDescription" id="fileDescription" class="form-control" autocomplete="off" value="{{ $file->description }}">
                    </div>
                    <div class="m-2 p-2 border rounded">
                        <img class="w-100" id="fileImage" src="{{ asset('documents/'.$file->image_path) }}">
                    </div>
                </div>
                <div class="modal-footer bg-secondary">
                    @if($file->status == "Request")
                    <a href="{{ url('fileReject/'.$file->id) }}" class="btn btn-danger">Reject</a>
                    <a href="{{ url('fileAccept/'.$file->id) }}" class="btn btn-primary">Accept</a>
                    @else
                    <input type="submit" value="Update" class="btn btn-primary" style="width: 15rem;">
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@error('fileDescription')
<div class="modal fade" id="fileError">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h1 class="modal-title">File Update Error</h1>
            </div>
            <div class="modal-body">
                <ul>
                    <li>{{$message}}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<button id="fileErrorBtn" data-bs-toggle="modal" data-bs-target="#fileError" hidden></button>
<script>
    document.querySelector('#fileErrorBtn').click();
</script>
@enderror



<!-- ---------------------------------------------------------------------------------------------------------------------- -->
<!-- JavaScript -->
<script>
    function showInfo() {
        const btn = document.getElementById('collapseBtn');
        btn.click();
        btn.textContent = (btn.textContent == 'Show More Info' ? 'Hide Info' : 'Show More Info');
    }

    function showFile() {
        document.getElementById('showFileBtn').click();

        const node = document.getElementById(arguments[0]).classList;
        node.remove('d-node');
    }


    function removeAllChildNodes(parent) {
        while (parent.firstChild) {
            parent.removeChild(parent.firstChild);
        }
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