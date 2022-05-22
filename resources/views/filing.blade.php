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

<!-- Modal for adding project -->
<div class="modal" id="addProject">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header text-white bg-1">
                <h2 class="modal-title">Add Project</h2>
            </div>

            <div class="modal-body">
                <form action="{{ url('filing/create') }}" method="post">
                    @csrf
                    <div class="mt-2">
                        <label for="client">Client:</label>
                        <input type="text" name="client" id="client" class="form-control" list="clientList" value="{{ old('client') }}">
                        @error('client')
                        <p class="text-danger">*{{$message}}</p>
                        @enderror
                        <datalist id="clientList">
                            @foreach($clients as $client)
                            <option value="{{ $client->name }}"></option>
                            @endforeach
                        </datalist>
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
                            <label for="contact">Contact Number:</label>
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

                    <hr>
                    <div class="my-3 d-flex justify-content-around">
                        <a class="btn bg-4 text-white" style="width: 200px;" data-bs-dismiss="modal">Cancel</a>
                        <input type="submit" value="Add" class="btn btn-primary" style="width: 200px;">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if($errors->any())
<script>
    document.getElementById('addProjectBtn').click();
</script>
@endif

@endsection



<!-- <hr>
<div class="mt-2">
    <div class="d-flex justify-content-around py-2">
        <div>
            <label for="lot_number">Lot Number:</label>
            <div class="d-flex">
                <p class="m-2">Lot</p> <input type="text" name="lot_number" id="lot_number" class="form-control w-25" value="{{ old('lot_number') }}">
            </div>
        </div>
        <div>
            <label for="sur_number">Survey Number:</label>
            <div class="d-flex justify-content-end">
                <p class="m-2">Psd-</p>
                <input type="text" name="sur_number1" id="sur_number1" class="form-control w-25" maxlength="2" value="{{ old('sur_number1') }}">
                <p class="m-2">-</p>
                <input type="text" name="sur_number2" id="sur_number2" class="form-control w-50" maxlength="6" value="{{ old('sur_number2') }}">
            </div>
        </div>
    </div>
</div>
<hr>
<div class="mt-2">
    <label for="area">Lot Area:</label>
    <div class="d-flex">
        <input type="text" name="area" id="area" class="form-control w-25" value="{{ old('area') }}">
        <p class="m-2">Sqr.M.</p>
    </div>
</div>
<hr>
<div class="mt-2">
    <label for="owner">Registered Land Owner:</label>
    <input type="text" name="owner" id="owner" class="form-control" value="{{ old('owner') }}">
</div> -->