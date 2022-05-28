@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ url('filing') }}" class="btn bg-4 py-3 my-2" style="width: 5rem;">
        <i class="fas fa-arrow-left fa fa-2xl"></i>
    </a>
    <div class="container text-white bg-2 overflow-auto" style="height: 80vh;">
        <div class="row mt-3 p-2">
            <div class="col-2 d-flex bg-white rounded text-black" style="border-right: 1px solid gray;">
                <div class="m-auto">
                    <h1 style="font-size: 3rem;"><?php printf('%05s', $project->id); ?></h1>
                </div>
            </div>
            <div class="col-10">
                <form action="{{ url('project/update/'.$project->id) }}" method="post">
                    @csrf
                    <div class="row m-2 pt-2">
                        <p class="col-2 h-100 my-auto">Client</p>
                        <input type="text" name="client" id="client" class="form-control col-10 w-75" value="{{ $project->client->name }}" style="background-color: #b3b3b3; border: 1px #b3b3b3 solid" readonly>
                    </div>
                    <div class="row m-2 pt-2">
                        <p class="col-2 h-100 my-auto">Subject Property Location</p>
                        <input type="text" name="location" id="location" class="form-control col-10 w-75" value="{{ $project->location }}">
                    </div>
                    <div class="collapse" id="showInfo">
                        <div class="row m-2 pt-2">
                            <p class="col-2 h-100 my-auto">Engineer In-charge</p>
                            <select name="user" id="user" class="form-control col-10 w-75">
                                @if(!$project->user_id)
                                <option selected hidden></option>
                                @endif
                                @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ ($project->user_id == $user->id)?'selected':''}}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row m-2 pt-2">
                            <p class="col-2 h-100 my-auto"></p>
                            <div class="col-10 row w-75 ">
                                @php
                                if($project->survey_number)
                                {
                                $lot_num = explode(" ", $project->survey_number);
                                $sur_num = explode("-", $lot_num[2]);
                                }
                                @endphp
                                <div class="col">
                                    <label for="sur_num">Lot Number:</label>
                                    <div class="d-flex">
                                        <p class="m-2">Lot</p>
                                        <input type="text" name="lot_num" id="lot_num" class="form-control w-25" value="{{ ($project->survey_number)?$lot_num[1]:'' }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="sur_num">Survey Number:</label>
                                    <div class="d-flex">
                                        <p class="m-2">Psd-</p>
                                        <input type="text" name="sur_num1" id="sur_num1" class="form-control w-25" maxlength="2" value="{{ ($project->survey_number)?$sur_num[1]:'' }}">
                                        <p class="m-2">-</p>
                                        <input type="text" name="sur_num2" id="sur_num2" class="form-control w-50" maxlength="6" value="{{ ($project->survey_number)?$sur_num[2]:'' }}">
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
                            <input type="text" name="land_owner" id="land_owner" class="form-control col-10 w-75" value="{{ ($project->land_owner)?$project->land_owner:'' }}">
                        </div>

                        <div class="d-flex">
                            <!-- <a class="btn btn-primary mx-auto" data-bs-toggle="modal" href="#confirm" style="width: 10rem;">Update Info</a> -->
                            <input type="submit" value="Update Info" class="btn btn-primary mx-auto" style="width: 10rem;">
                            <!-- <input type="submit" id="submitBtn" value="" hidden> -->
                        </div>
                    </div>
                </form>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-10 d-flex justify-content-around">
                <button class="btn btn-success" onclick="showInfo()" id="collapseBtn" data-bs-toggle="collapse" data-bs-target="#showInfo" style="width: 10rem;">Show More Info</button>
                <button data-bs-toggle="modal" data-bs-target="#addFile" class="btn bg-3 text-white" id="addFileBtn" style="width: 10rem;">Add File</button>
                <button data-bs-toggle="modal" data-bs-target="#updateFile" hidden id="updateBtn"></button>
            </div>
        </div>

        <div class="rounded border border-2 overflow-auto mt-2" style="height: 54vh;">
            <div class="row">
                @foreach($project->files as $file)
                <div class="col-2">
                    <div class="m-2 card bg-secondary overflow-auto">
                        <a href="#showFile-{{$file->id}}" data-bs-toggle="modal" class="text-decoration-none text-white">
                            <div class="card-header">
                                <h3 class="card-title">{{ $file->title }}</h3>
                            </div>
                            <div class="card-body">
                                <img class="w-100" src="{{ asset('documents/'.$file->image_path) }}" alt="{{ $file->image_path }}">
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</div>



<div class="modal" id="addFile">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-1 text-white">
                <h1 class="modal-title">Add New File</h1>
            </div>
            <div class="modal-body">
                <form action="{{ url('filing/'.$project->id.'/createFile') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-2">
                        <label for="title">Title:</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
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
                        <label for="img">Document:</label>
                        <input type="file" name="img" id="img" class="form-control" accept="image/*" value="{{ old('img') }}">
                        @error('img')
                        <p class="text-danger">* {{ $message }}</p>
                        @enderror
                    </div>
                    <hr>
                    <div class="my-3 d-flex justify-content-around">
                        <a class="btn bg-4 text-white" style="width: 200px;" data-bs-dismiss="modal">Cancel</a>
                        <input type="submit" value="Add" class="btn btn-primary" style="width: 200px;">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@foreach($project->files as $file)
<div class="modal" id="showFile-{{$file->id}}">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-1 text-white">
                <h2 class="modal-title">{{$file->title}}</h2>
            </div>
            <div class="modal-body">
                <div class="my-2">
                    <img class="w-100" src="{{ asset('documents/'.$file->image_path) }}" alt="">
                </div>
                <hr>
                <form action="{{ url('file/update/'.$file->id) }}" method="post">
                    @csrf
                    <div class="mt-2">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ $file->title }}">
                    </div>
                    <div class="mt-2">
                        <label for="description" class="form-label">Description:</label>
                        <input type="text" name="description" id="description" class="form-control" value="{{ $file->description }}">
                    </div>
                    <hr>
                    <div class="my-2 d-flex justify-content-around">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="width: 10rem;">Close</button>
                        <input type="submit" value="Update" class="btn btn-primary" style="width: 10rem;">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach


<script>
    function showInfo() {
        const btn = document.getElementById('collapseBtn');
        btn.textContent = (btn.textContent == 'Show More Info' ? 'Hide Info' : 'Show More Info');
    }
</script>

@if($errors->any())
<script>
    document.querySelector('#addFileBtn').click();
</script>
@endif

@endsection