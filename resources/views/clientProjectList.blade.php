@extends('layouts.navbarOnly')

@section('content')

@php
    $projects = Auth()->user()->clientProjects; 
@endphp

<div class="container text-white bg-2 mt-5 overflow-auto d-flex flex-column justify-content-around" style="height: 80vh;">
    <div class="border border-2 rounded d-flex py-2">
        <h1 class="mx-auto">Project List</h1>
    </div>
    <div class="border border-2 rounded overflow-auto" style="height: 68vh;">
        <div class="row m-2">
            @foreach($projects as $project)
            <div class="col-2 my-2">
                <a href="{{ url('project/'.$project->id) }}" class="text-decoration-none text-black">
                    <div class="card text-black text-center">
                        <div class="card-body">
                            <h1>{{ ($project->land_owner)?$project->land_owner:'' }}</h1>
                            <hr>
                            <p>{{ $project->location }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection