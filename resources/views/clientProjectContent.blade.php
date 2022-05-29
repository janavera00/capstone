@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ url('project/'.$client->id) }}" class="btn bg-4 py-3 my-2" style="width: 5rem;">
        <i class="fas fa-arrow-left fa fa-2xl"></i>
    </a>
    <div class="container text-white bg-2 overflow-auto" style="height: 80vh;">
        <div class="mt-3">
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
                        @php
                        if($project->survey_number)
                        {
                        $survey_num = explode(" ", $project->survey_number);
                        }
                        @endphp
                        <div class="col">
                            <label for="sur_num">Lot Number:</label>
                            <div class="col-10 p-2 rounded bg-white text-black">{{ ($project->survey_number)?$survey_num[0].' '.$survey_num[1]:'' }}</div>
                        </div>
                        <div class="col">
                            <label for="sur_num">Survey Number:</label>
                            <div class="col-10 p-2 rounded bg-white text-black">{{ ($project->survey_number)?$survey_num[2]:'' }}</div>
                        </div>
                    </div>

                </div>
                <div class="row m-2 pt-2">
                    <p class="col-2 h-100 my-auto">Lot Area</p>
                    <div class="col-10 p-2 rounded bg-white text-black">{{ ($project->lot_area)?$project->lot_area:'' }}</div>
                    <!-- <div class="col-10 d-flex" style="padding-left: 0px;">
                                <input type="text" name="lot_area" id="lot_area" class="form-control w-25" value="{{ ($project->lot_area)?(explode(' ', $project->lot_area))[0]:'' }}">
                                <p class="p-2 my-auto">sqr.m.</p>
                            </div> -->
                </div>
                <div class="row m-2 pt-2">
                    <p class="col-2 h-100 my-auto">Registered Land Owner</p>
                    <div class="col-10 p-2 rounded bg-white text-black">{{ ($project->land_owner)?$project->land_owner:'' }}</div>
                    <!-- <input type="text" name="land_owner" id="land_owner" class="form-control col-10 w-75" value="{{ ($project->land_owner)?$project->land_owner:'' }}"> -->
                </div>
            </div>
        </div>
        <hr>
        
            <div class="d-flex justify-content-around pb-2">
                <button class="btn btn-success" onclick="showInfo()" id="collapseBtn" data-bs-toggle="collapse" data-bs-target="#showInfo" style="width: 10rem;">Show More Info</button>
                <button data-bs-toggle="modal" data-bs-target="#submitDocument" class="btn bg-3 text-white" id="addFileBtn" style="width: 10rem;">Submit a document</button>
                <button data-bs-toggle="modal" data-bs-target="#updateFile" hidden id="updateBtn"></button>
            </div>
        

        <div class="rounded border border-2 overflow-auto mt-2" style="height: 56vh;">
            <div class="row">
                @foreach($project->files as $file)
                @if($file->status != 'Request')
                <div class="col-2">
                    <div class="m-2 card bg-secondary overflow-auto" onclick="showFile('{{$file->title}}', '{{$file->description}}', '{{$file->image_path}}')" style="cursor: pointer;">
                        
                        <button data-bs-toggle="modal" data-bs-target="#showFile" id="showFileBtn" hidden></button>
                        
                        <div class="card-header">
                            <h3 class="card-title">{{ $file->title }}</h3>
                        </div>
                        <div class="card-body">
                            <img class="w-100" src="{{ asset('documents/'.$file->image_path) }}" alt="{{ $file->image_path }}">
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
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
            <div class="modal-body">
                <p>Enter the name of the document, a short description of it, and a scanned/photograph copy of the document</p>
                <hr>
                <form action="{{ url('project/'.$client->id.'/'.$project->id.'/submitFile') }}" method="post" enctype="multipart/form-data">
                    @csrf
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
                    <hr>
                    <div class="my-3 d-flex justify-content-around">
                        <a class="btn bg-4 text-white" style="width: 200px;" data-bs-dismiss="modal">Cancel</a>
                        <input type="submit" value="Submit" class="btn btn-primary" style="width: 200px;">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="showFile">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-1 text-white">
                <h2 class="modal-title" id="fileTitle"></h2>
            </div>
            <div class="modal-body">
                <div class="my-2">
                    <img class="w-100" id="fileImage">
                </div>
                <div class="my-2 p-2 bg-white rounded">
                    <p id="fileDescription"></p>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function showInfo() {
        const btn = document.getElementById('collapseBtn');
        btn.textContent = (btn.textContent == 'Show More Info' ? 'Hide Info' : 'Show More Info');
    }

    function showFile(title, description, path)
    {
        document.getElementById('showFileBtn').click();
        document.getElementById('fileTitle').textContent = title;
        document.getElementById('fileDescription').textContent = description;

        console.log(path);
        document.getElementById('fileImage').src = `{{ asset('documents/${path}') }}`;
    }
</script>


@endsection