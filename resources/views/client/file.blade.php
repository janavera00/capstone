@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ url('project/') }}" class="btn bg-4 py-3 my-2" style="width: 5rem;">
        <i class="fas fa-arrow-left fa fa-2xl"></i>
    </a>
    <div class="container text-white bg-2 overflow-auto" style="height: 80vh;">

        <div class="row m-2 pt-2">
            <p class="col-2 h-100 my-auto">Client</p>
            <div class="col-10 p-2 bg-white text-black rounded">{{ $project->client->name }}</div>
        </div>
        <div class="row m-2 pt-2">
            <p class="col-2 h-100 my-auto">Subject Property Location</p>
            <div class="col-10 p-2 bg-white text-black rounded">{{ $project->location }}</div>
        </div>
        <div class="collapse" id="showInfo">
            <div class="row m-2 pt-2">
                <p class="col-2 h-100 my-auto">Engineer In-charge</p>
                <div class="col-10 p-2 bg-white text-black rounded">{{ $project->user->name }}</div>
            </div>
            <div class="row m-2 pt-2">
                <p class="col-2 h-100 my-auto"></p>
                <div class="col-10 row w-75 ">

                    <div class="col">
                        <label for="sur_num">Lot Number:</label>
                        <div class="col-10 p-2 bg-white text-black rounded">Lot {{ explode(" ", $project->survey_number)[1] }}</div>

                    </div>
                    <div class="col">
                        <label for="sur_num">Survey Number:</label>
                        <div class="col-10 p-2 bg-white text-black rounded">{{ explode(" ", $project->survey_number)[2] }}</div>

                    </div>
                </div>

            </div>
            <div class="row m-2 pt-2">
                <p class="col-2 h-100 my-auto">Lot Area</p>
                <div class="col-10 p-2 bg-white text-black rounded">{{ ($project->lot_area)?(explode(' ', $project->lot_area))[0]:'' }} sqr.m.</div>
            </div>
            <div class="row m-2 pt-2">
                <p class="col-2 h-100 my-auto">Registered Land Owner</p>
                <div class="col-10 p-2 bg-white text-black rounded">{{ ($project->land_owner)?$project->land_owner:'' }}</div>
            </div>
        </div>
        <hr>


        <div class="d-flex justify-content-around mb-3">
            <button class="btn btn-success" onclick="showInfo()" id="collapseBtn" data-bs-toggle="collapse" data-bs-target="#showInfo" style="width: 10rem;">Show More Info</button>
            <button data-bs-toggle="modal" data-bs-target="#addFile" class="btn bg-3 text-white" style="width: 10rem;">Add File</button>
        </div>


        <div class="bg-white text-black p-3 rounded overflow-auto" style="height: 35rem;">
            <div class="row m-2">
                @foreach($project->files as $file)
                    <div class="col-2 card m-2">
                        <div class="card-body">
                            <h1>{{ $file->title }}</h1>
                            <p>{{ $file->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @endsection