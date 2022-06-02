@extends('layouts.app')

@section('content')

<div class="container text-white bg-2 mt-5 overflow-auto rounded" style="height: 80vh;">
    <div class="d-flex justify-content-between p-3">
        <!-- buttons -->
        <div class="my-auto">
            <button data-bs-toggle="modal" data-bs-target="#addClient" id="addProjectBtn" class="btn bg-3 text-white">Add Client</button>
        </div>

        <!-- search box -->
        <form action="" method="post" class="my-auto w-75">
            <div class="my-auto w-100 d-flex ms-auto">
                <input type="text" name="search" id="search" class="form-control mx-2" autocomplete="off">
                <input type="submit" value="Search" class="btn bg-3 text-white">
            </div>
        </form>
    </div>

    <hr>
    <!-- Clients List -->
    <div class="row">
        @foreach($clients as $client)
        <div class="col-2">
            <div class="card" onclick="location.href='projects/{{$client->id}}'" style="cursor: pointer;">
                <div class="card-body">
                    <img src="{{asset('images/users/'.$client->image)}}" alt="" class="w-100">
                </div> 
                <div class="card-footer">
                    <h5 class="text-black text-center">{{ $client->name }}</h5>
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
                <h2 class="modal-title">Add new Client</h2>
            </div>

            <form action="{{ url('client/create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body overflow-auto" style="height: 60vh;">
                    <div class="mt-2">
                        <label for="name">Name:</label>
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
                            <input type="text" name="contact" id="contact" class="form-control" value="{{ old('contact') }}" style="height: 2.5rem; width: 90vw;" autocomplete="off">
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
                        <label for="image">Profile image:</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @error('image')
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