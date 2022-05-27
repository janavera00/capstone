@extends('layouts.app')

@section('content')

<div class="container bg-2 mt-5 overflow-auto" style="height: 80vh;">
    <div class="p-2 overflow-auto" style="height: 48rem;">

        <div class="row m-2 justify-content-around">
            @foreach($client->projects as $project)
            <div class="col-2 card border border-3 m-2">
                <div class="card-body" onclick="location.href = 'content/{{ $project->id }}'">
                    <h2>{{ ($project->land_owner)?$project->land_owner:'' }}</h2>
                    <hr>
                    <p>{{ $project->location }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>



@endsection

