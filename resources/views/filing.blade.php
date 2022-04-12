@extends('layouts.app')

@section('content')
    
    <div class="container mt-5">
        <form action="">
            @csrf

            <div class="row">
                <div class="col">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#target">Add project</button>
                </div>

                <div class="col">
                    <input type="text" name="searchBox" id="searchBox" class="form-control">
                </div>

                <div class="col">
                    <input type="submit" value="Search" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>

@endsection