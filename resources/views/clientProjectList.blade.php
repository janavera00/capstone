@extends('layouts.app')

@section('content')

<div class="container text-white bg-2 mt-5 overflow-auto" style="height: 80vh;">
    <div class="d-flex justify-content-between p-3">
        <div class="my-auto">
            <button data-bs-toggle="modal" data-bs-target="#addProject" id="addProjectBtn" class="btn bg-3 text-white">Add Project</button>
        </div>

        <form action="" method="post" class="my-auto w-75">
            <div class="my-auto w-100 d-flex ms-auto">
                <input type="text" name="search" id="search" class="form-control mx-2">
                <input type="submit" value="Search" class="btn bg-3 text-white">
            </div>
        </form>
    </div>

    <div class="border border-2 rounded overflow-auto" style="height: 70vh;">
        <div class="row m-2">
            @foreach($client->projects as $project)
            <div class="col-2 my-2">
                <div class="card text-black text-center" onclick="location.href = '{{ $client->id }}/{{ $project->id }}'" style="cursor: pointer;">
                    <div class="card-body">
                        <h1>{{ ($project->land_owner)?$project->land_owner:'' }}</h1>
                        <hr>
                        <p>{{ $project->location }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
    </div>
</div>

@endsection