@extends('layouts.app')

@php
    $error = true;
@endphp

@section('content')
    
    <div class="container text-white bg-2 mt-5 overflow-auto" style="height: 80vh;">
        <div class="d-flex justify-content-between p-3">
            <div class="my-auto">
                <button data-bs-toggle="modal" data-bs-target="#addProject" class="btn bg-3 text-white">Add Project</button>
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
                    <th style="width: 10%;">Control No.</th>
                    <th style="width: 35%;">Client</th>
                    <th style="width: 55%;">Location</th>
                </tr>
            </table>
            <div class="overflow-auto" style="height: 65vh;">
                <table class="table table-light table-striped table-bordered table-hover">
                    @foreach($projects as $project)
                        <tr onclick="location.href = 'filing/{{ $project->id }}'"> 
                            <td style="width: 10%; text-align:center;"><?php printf('%05s', $project->id); ?></td>
                            <td style="width: 35%;">{{ $project->client->name }}</td>
                            <td style="width: 55%;">{{ $project->location }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    
    <input type="hidden" id="showError" value="{{ $error }}">

    <!-- Modal for adding project -->
    <div class="modal" id="addProject">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header text-white bg-1">
                    <h2 class="modal-title">Add Project</h2>
                </div>

                <div class="modal-body">
                    <form action="" method="post">
                        <div class="mt-2">
                            <label for="client" class="form-label">Client:</label>
                            <input type="text" name="client" id="client" class="form-control">
                        </div>
                        <div>
                            <label for="location" class="form-label">Location:</label>
                            <input type="text" name="location" id="location" class="form-control">
                        </div>
        
                        <div class="my-2 d-flex justify-content-around">
                            <a class="btn bg-4 text-white" style="width: 45%;" data-bs-dismiss="modal">Cancel</a>
                            <input type="submit" value="Add" class="btn btn-primary" style="width: 45%;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        if(document.querySelector('#showError').value){
            $('#register').modal('show');
            // console.log(document.querySelector('#showError').value);
            // let node = document.querySelector('#addProject');
            // node.classList.add('show');
            // node.aria-modal("true");
        }
    </script>
    @endsection