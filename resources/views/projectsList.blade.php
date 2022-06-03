@extends('layouts.app')

@section('content')

<div class="container px-0">
    <a href="/clients" class="btn btn-danger mt-4"><img src="{{asset('images/assets/arrow-left-solid-white.svg')}}" width="30rem"></a>
</div>
<div class="container text-white bg-2 mt-2 overflow-auto rounded" style="height: 80vh;">
    <div class="row p-3">
        <!-- buttons -->
        <div class="col-2 border-end">
            <button class="btn btn-success w-100" onclick="showInfo()" id="collapseBtn" data-bs-toggle="collapse" data-bs-target="#clientInfo">Show More Info</button>
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


    <button hidden data-bs-toggle="modal" data-bs-target="#message" id="messageBtn"></button>
    <!-- toast TESTING MIGHT REMOVE -->
    <div class="modal text-black" id="message">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body alert-success">
                    You have successfully updated the client information
                </div>

            </div>
        </div>
    </div>
    @if(session()->has('success'))
    <script>
        document.querySelector('#messageBtn').click();
    </script>
    @endif

    


    <hr>

    <!-- projects List -->
    <div class="container rounded border border-2 mb-2">
        <!-- header -->
        <div class="mx-2 row py-2 border-bottom">
            <div class="col d-flex">
                <button data-bs-toggle="modal" data-bs-target="#addProject" id="addProjectBtn" class="btn btn-primary my-auto ms-auto" style="width: 15rem;">Add a Project</button>
            </div>
            <h1 class="col text-center">Projects</h1>
            <div class="col"></div>
        </div>

        <div class="overflow-auto" style="height: 53vh;">
            <div class="row">
                @foreach($client->projects as $project)
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
        </div>
    </div>
</div>



<!-- Modal for adding project -->
<div class="modal" id="addProject">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header text-white bg-1">
                <h2 class="modal-title">Add Project</h2>
            </div>

            <form action="{{ url('filing/create/'.$client->id) }}" method="post">
                @csrf
                <div class="modal-body overflow-auto" style="height: 60vh;">
                    <div class="p-2 my-2 border rounded">
                        <label for="loc">Engineer In Charge:</label>
                        <select name="engr" id="engr" class="form-control">
                            <option selected hidden></option>
                            @foreach($users as $user)
                            <option value="{{$user->id}}" {{($user->id == old('engr'))?'selected':''}}>{{$user->role}} - {{$user->name}}</option>
                            @endforeach
                        </select>
                        
                        @error('loc')
                        <p class="text-danger">*{{$message}}</p>
                        @enderror
                    </div>

                    <div class="p-2 my-2 border rounded">
                        <label for="loc">*Location:</label>
                        <input type="text" name="loc" id="loc" class="form-control" value="{{ old('loc') }}" autocomplete="off">
                        @error('loc')
                        <p class="text-danger">*{{$message}}</p>
                        @enderror
                    </div>

                    <div class="p-2 my-2 border rounded">
                        <div class="row">
                            <div class="col-4 border-end">
                                <label for="lotNum">Lot Number:</label>
                                <div class="d-flex">
                                    <p class="py-1 me-2  mb-0">Lot</p>
                                    <input type="text" name="lotNum" id="lotNum" class="form-control" value="{{ old('lotNum') }}" autocomplete="off" style="height: 2.3rem;">
                                </div>
                                @error('lotNum')
                                <p class="text-danger">*{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-8">
                                <label for="surNum">Survey Number:</label>
                                <div class="d-flex">
                                    <p class="py-1 me-2 mb-0">Psd-</p>
                                    <input type="text" name="surNum" id="surNum" class="form-control" value="{{ old('surNum') }}" autocomplete="off" maxlength="9" placeholder="xx-xxxxxx" style="height: 2.3rem;">
                                </div>
                                @error('surveyNo')
                                <p class="text-danger">*{{$message}}</p>
                                @enderror
                                @error('surNum')
                                <p class="text-danger">*{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="p-2 my-2 border rounded">
                        <label for="lotArea">Lot Area:</label>
                        <input type="text" name="lotArea" id="lotArea" class="form-control" value="{{ old('lotArea') }}" autocomplete="off">
                        @error('lotArea')
                        <p class="text-danger">*{{$message}}</p>
                        @enderror
                    </div>

                    <div class="p-2 my-2 border rounded">
                        <label for="landOwn">Registered Land Owner:</label>
                        <input type="text" name="landOwn" id="landOwn" class="form-control" value="{{ old('landOwn') }}" autocomplete="off">
                        @error('landOwn')
                        <p class="text-danger">*{{$message}}</p>
                        @enderror
                    </div>

                </div>
                <div class="modal-footer bg-secondary">
                    <a class="btn bg-4 text-white" style="width: 200px;" data-bs-dismiss="modal">Cancel</a>
                    <input type="submit" value="Add" class="btn btn-primary" style="width: 200px;">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function showInfo() {
        const btn = document.getElementById('collapseBtn');
        btn.textContent = (btn.textContent == 'Show More Info' ? 'Hide Info' : 'Show More Info');
    }
</script>


@if($errors->any())
<script>
    document.getElementById('addProjectBtn').click();
</script>
@endif




@endsection