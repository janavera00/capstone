@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ url('filing') }}" class="btn bg-4 px-4 py-3 my-4">
        <i class="fas fa-arrow-left fa fa-2xl"></i>
    </a>
    <div class="container text-white bg-2 overflow-auto" style="height: 80vh;">
        <div class="row text-black mt-3 p-2 bg-white rounded">
            <div class="col-2 d-flex" style="border-right: 1px solid gray;">
                <div class="m-auto">
                    <h1 style="font-size: 3rem;"><?php printf('%05s', $project->id); ?></h1>
                </div>
            </div>
            <div class="col-10 h2">
                <div class="row m-2 pt-2" style="border-bottom: 1px #b3b3b3 solid;">
                    <p class="col-2 h-100 my-auto">Client</p>
                    <p class="col-10 h-100 my-auto">{{ $project->client->name }}</p>
                </div>
                <div class="row m-2 py-2" style="border-bottom: 1px #b3b3b3 solid;">
                    <p class="col-2 h-100 my-auto">Location</p>
                    <p class="col-10 h-100 my-auto">{{ $project->location }}</p>
                </div>
                <div class="collapse" id="showInfo">
                    @if($project->survey_number)
                    <div class="row m-2 py-2" style="border-bottom: 1px #b3b3b3 solid;">
                        <p class="col-2 h-100 my-auto">Lot/Survey Number</p>
                        <p class="col-10 h-100 my-auto">{{ $project->survey_number }}</p>
                    </div>
                    @endif
                    @if($project->lot_area)
                    <div class="row m-2 py-2" style="border-bottom: 1px #b3b3b3 solid;">
                        <p class="col-2 h-100 my-auto">Lot Area</p>
                        <p class="col-10 h-100 my-auto">{{ $project->lot_area }}</p>
                    </div>
                    @endif
                    @if($project->land_owner && $project->land_owner != $project->client->name)
                    <div class="row m-2 py-2" style="border-bottom: 1px #b3b3b3 solid;">
                        <p class="col-2 h-100 my-auto">Registered Land Owner</p>
                        <p class="col-10 h-100 my-auto">{{ $project->land_owner }}</p>
                    </div>
                    @endif
                </div>
                <button class="btn btn-primary" onclick="showInfo()" id="collapseBtn" data-bs-toggle="collapse" data-bs-target="#showInfo">Show More Info</button>
                </h2>
            </div>
        </div>

        <div class="d-flex justify-content-between p-3">
            <div class="my-auto">
                <button data-bs-toggle="modal" data-bs-target="#addSched" class="btn bg-3 text-white">Add File</button>
            </div>

            <form action="" method="post" class="my-auto w-75">
                <div class="my-auto w-100 d-flex ms-auto">
                    <input type="text" name="search" id="search" class="form-control mx-2">
                    <input type="submit" value="Search" class="btn bg-3 text-white">
                </div>
            </form>
        </div>

        <div>
            <table class="table table-light table-bordered mt-3" style="margin-bottom: 0px;">
                <tr class="text-center">
                    <th style="width: 30%;">Title</th>
                    <th style="width: 70%;">Description</th>
                </tr>
            </table>
            <div class="overflow-auto" style="height: 55vh;">
                <table class="table table-light table-striped table-bordered table-hover">
                    @foreach($project->files as $file)
                    <tr>
                        <td style="width: 30%;">{{ $file->title }}</td>
                        <td style="width: 70%;">{{ $file->description }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function showInfo()
    {
        const btn = document.getElementById('collapseBtn');
        btn.textContent = (btn.textContent == 'Show More Info' ? 'Hide Info' : 'Show More Info');
    }
</script>

@endsection