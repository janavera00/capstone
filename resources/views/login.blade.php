@extends('layouts.app')

@section('content')
    <div class="card w-50 mt-5 mx-auto border text-white">
        <div class="card-header bg-1 w-100">
            <p class="display-5">Login</p>
        </div>
        <div class="card-body bg-2 px-5">
            <form action="" method="post">
                @csrf
                
                <div class="py-2">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" name="username" id="username" class="form-control">
                </div>
                <div class="pb-2">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="py-2 d-flex justify-content-center">
                    <input type="submit" value="Login" class="btn bg-3 text-white w-25">
                </div>
            </form>
        </div>
    </div>
@endsection