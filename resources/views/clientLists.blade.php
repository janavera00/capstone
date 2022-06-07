@extends('layouts.app')

@section('content')

<div class="container text-white bg-2 mt-5 rounded" style="height: 80vh;">
    <div class="d-flex justify-content-between p-3">
        <!-- buttons -->
        <div class="my-auto">
            <button data-bs-toggle="modal" data-bs-target="#addClient" id="addProjectBtn" class="btn bg-3 text-white">Add Client</button>
        </div>

        <!-- search box -->
        <form action="{{ url('search') }}" method="post">
            @csrf
            <div class="my-auto w-100 d-flex ms-auto">
                <!-- <input type="submit" value="Search" class="btn bg-3 text-white"> -->
                <button class="btn btn-primary" style="width: fit-content;">
                <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <input type="text" name="search" id="search" class="form-control mx-2" autocomplete="off">
                <a href="{{ url('clients') }}" class="btn btn-danger" style="width: fit-content;">
                <i class="fa-solid fa-arrows-rotate"></i>
                </a>
            </div>
        </form>
    </div>

    <div class="container border rounded mt-2 overflow-auto" style="height: 70vh;">

        @if(isset($clients))
        <h1 class="text-center mt-2">Clients List</h1>
        <hr class="w-75 mx-auto">
        <!-- Clients List -->
        <div class="row">
            @foreach($clients as $client)
            <div class="col-2">
                <div class="card" onclick="location.href='projects/{{$client->id}}'" style="cursor: pointer;">
                    <div class="card-body">
                        <div class="w-50 m-auto">
                            <img src="{{asset('images/users/'.$client->image)}}" alt="" class="w-100 rounded-circle border">
                        </div>
                    </div> 
                    <div class="card-footer">
                        <h4 class="text-black text-center">{{ $client->name }}</h4>
                        
                        <p class=" border-top pt-2 mb-0 text-black text-center">{{ $client->address }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        
        @if(isset($projects))
        <h1 class="text-center mt-2">Projects List</h1>
        <hr class="w-75 mx-auto">
        <!-- Projects List -->
        <div class="row">
            @foreach($projects as $project)
            <div class="col-3 my-2">
                <a href="{{ url('projectContent/'.$project->id) }}" class="text-decoration-none text-black">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="text-black text-center"><?php printf('%05d', $project->id); ?></h1>
                        </div>
                        <div class="card-body">
                            <h5 class="text-black text-center">{{ ($project->lot_number)?$project->lot_number:'' }}</h5>
                            <h5 class="text-black text-center">{{ ($project->survey_number)?$project->survey_number:'' }}</h5>
                        </div> 
                        <div class="card-footer">
                            <p class="text-black text-center">{{ $project->location }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @endif
    </div>

</div>



<!-- Modal for adding client -->
<form action="{{ url('client/create') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="addClient">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header text-white bg-1">
                    <h2 class="modal-title">Add new Client</h2>
                </div>

                <div class="modal-body overflow-auto" style="height: 60vh;">
                    <div class="mt-2">
                        <label for="name">*Name:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" autocomplete="off">
                        @error('name')
                        <p class="text-danger">*{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label for="address">Home Address:</label>
                        <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}" autocomplete="off">
                        @error('address')
                        <p class="text-danger">*{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label for="contact">Contact Number:</label>
                        <div class="d-flex">
                            <p class="p-2">+63</p>
                            <input type="text" name="contact" id="contact" class="form-control" maxlength="10" value="{{ old('contact') }}" style="height: 2.5rem; width: 90vw;" autocomplete="off">
                        </div>
                        @error('contact')
                        <p class="text-danger">*{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" autocomplete="off">
                        @error('email')
                        <p class="text-danger">*{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label for="username">*Username:</label>
                        <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" autocomplete="off">
                        @error('username')
                        <p class="text-danger">*{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label for="img">Profile image:</label>
                        <input type="file" name="img" id="img" class="form-control" accept="image/*" value="{{ old('img') }}">
                        @error('img')
                        <p class="text-danger">*{{$message}}</p>
                        @enderror
                    </div>
                    
                </div>
                <div class="modal-footer bg-secondary">
                    <a class="btn btn-danger" style="width: 200px;" data-bs-dismiss="modal">Cancel</a>
                    <input type="submit" value="Add" class="btn btn-primary" style="width: 200px;">
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="duplicate">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header text-danger bg-1">
                    <h2 class="modal-title">Name already exist in the records</h2>
                </div>

                <div class="modal-body overflow-auto" style="height: 60vh;">
                    <div class="mt-2">
                        <label for="duplicate">please enter your password to confirm:</label>
                        <input type="password" name="duplicate" class="form-control" autocomplete="off">
                        @error('name')
                        <p class="text-danger">*{{ $message }}</p>
                        @enderror
                    </div>
                    
                </div>
                <div class="modal-footer bg-secondary">
                    <a class="btn btn-success" style="width: 200px;" data-bs-toggle="modal" href="#addClient">Change</a>
                    <input type="submit" value="Confirm" class="btn btn-primary" style="width: 200px;">
                </div>

            </div>
        </div>
    </div>
    
</form>
<button data-bs-toggle="modal" data-bs-target="#duplicate" id="duplicateBtn" hidden></button>


@if($errors->any())
<script>
    document.getElementById('addProjectBtn').click();
</script>
@endif
@error('duplicate')
<script>
    document.getElementById('duplicateBtn').click();
</script>
@enderror

@endsection