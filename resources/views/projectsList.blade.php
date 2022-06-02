@extends('layouts.app')

@section('content')

<div class="container px-0">
    <a href="/clients" class="btn btn-danger mt-4"><img src="{{asset('images/assets/arrow-left-solid-white.svg')}}" width="30rem"></a>
</div>
<div class="container text-white bg-2 mt-2 overflow-auto rounded" style="height: 80vh;">
    <div class="row p-3">
        <!-- buttons -->
        <div class="col-2 d-flex justify-content-around flex-column border-end">
            <button class="btn btn-success" data-bs-toggle="collapse" data-bs-target="#clientInfo">Show more Info</button>
            <button data-bs-toggle="modal" data-bs-target="#addProject" id="addProjectBtn" class="btn btn-primary w-100">Add Client</button>
        </div>

        <!-- client's information -->
        <div class="col">
            <div class="d-flex justify-content-center">
                <div style="width: fit-content;" class="my-auto">
                    <img src="{{asset('images/users/'.$client->image)}}" class="rounded me-3" height="100rem">
                </div>
                <h1 class="text-center my-auto" style="width: fit-content;">{{$client->name}}</h1>
            </div>
            <form action="../client/{{$client->id}}/update" method="post">
                @csrf
                <div class="collapse" id="clientInfo">
                    <hr>
                    <div class="row m-2 pt-2">
                        <p class="col-2 h-100 my-auto">Address</p>
                        <input type="text" name="address" id="address" class="col form-control" autocomplete="off" value="{{ $client->address }}">
                    </div>
                    <div class="row m-2 pt-2">
                        <p class="col-2 h-100 my-auto">Contact Number</p>
                        <input type="text" name="contact" id="contact" class="col form-control" autocomplete="off" maxlength="11" value="{{ $client->contact }}">
                    </div>
                    <div class="row m-2 pt-2">
                        <p class="col-2 h-100 my-auto">Email Address</p>
                        <div class="col p-2 border rounded bg-white text-black">{{ $client->email }}</div>
                    </div>
                    <hr>
                    <div class="mt-3 d-flex">
                        <input type="submit" value="Update" class="btn btn-primary mx-auto" style="width: 10rem;">
                    </div>
                </div>
            </form>
        </div>


        
    </div>

    <hr>

    <!-- projects List -->
    <div class="row">
        @foreach($client->projects as $project)
        <div class="col-3 my-2">
            <div class="card" onclick="location.href='../../projectContent/{{$project->id}}'" style="cursor: pointer;">
                <div class="card-header">
                    @php
                        $lotNum = explode(' ', $project->survey_number);
                        $surNum = explode('-', $lotNum[2]);
                    @endphp
                    <h4 class="text-black text-center">{{ 'Lot '.$lotNum[1] }}</h4>
                    <h4 class="text-black text-center">{{ 'Psd-'.$surNum[1].'-'.$surNum[2] }}</h4>
                </div>
                <div class="card-body">
                    <p class="text-black text-center">{{ $project->location }}</p>
                </div> 
            </div>
        </div>
        @endforeach
    </div>
</div>



<!-- Modal for adding client -->
<div class="modal" id="addClient">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header text-white bg-1">
                <h2 class="modal-title">Add Project</h2>
            </div>

            <form action="{{ url('filing/create') }}" method="post">
                @csrf
                <div class="modal-body overflow-auto" style="height: 60vh;">
                    <div class="mt-2">
                        <label for="client">Client:</label>
                        <input type="text" name="client" id="client" class="form-control" list="clientList" value="{{ old('client') }}">
                        @error('client')
                        <p class="text-danger">*{{ $message }}</p>
                        @enderror
                       
                    </div>

                    <div class="collapse @error('address')show @enderror @error('contact')show @enderror @error('email')show @enderror" id="addClient">
                        <hr style="height: 5px;">
                        <p class="text-danger">*You've entered a new client name, please enter the required info for that client</p>
                        <div>
                            <label for="address">Client's Address:</label>
                            <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}">
                            @error('address')
                            <p class="text-danger">*{{$message}}</p>
                            @enderror
                        </div>
                        <hr>
                        <div>
                            <label for="contact">Contact Number: </label>
                            <div class="d-flex">
                                <p class="m-2">+63</p>
                                <input type="text" name="contact" id="contact" maxlength="9" class="form-control" value="{{ old('contact') }}">
                            </div>
                            @error('contact')
                            <p class="text-danger">*{{$message}}</p>
                            @enderror
                        </div>
                        <hr>
                        <div>
                            <label for="email">Email Address:</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                            @error('email')
                            <p class="text-danger">*{{$message}}</p>
                            @enderror
                        </div>
                        <hr style="height: 5px;">
                    </div>
                    <div class="mt-2">
                        <label for="location">Subject Property Location:</label>
                        <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}">
                        @error('location')
                        <p class="text-danger">*{{$message}}</p>
                        @enderror
                    </div>

                </div>
                <div class="modal-footer bg-secondary d-flex justify-content-around">
                    <a class="btn bg-4 text-white" style="width: 200px;" data-bs-dismiss="modal">Cancel</a>
                    <input type="submit" value="Add" class="btn btn-primary" style="width: 200px;">
                </div>
            </form>
        </div>
    </div>
</div>

@if($errors->any())
<script>
    document.getElementById('addProjectBtn').click();
</script>
@endif

@endsection