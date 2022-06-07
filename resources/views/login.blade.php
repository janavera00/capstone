<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SProMAp</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://kit.fontawesome.com/a7e674e45f.js" crossorigin="anonymous"></script>

    <style>
        .color-1{color: #191919;}
        .color-2{color: #2D4263;}
        .color-3{color: #0076bf;}
        .color-4{color: #C84B31;}

        .bg-1{background-color: #191919;}
        .bg-2{background-color: #2D4263;}
        .bg-3{background-color: #0076bf;}
        .bg-4{background-color: #C84B31;}
    </style>    
</head>
<body>
    <nav class="navbar bg-1">
        <div class="container-fluid">
            <a href="/" class="navbar-brand text-white fw-bolder ps-4">SProMAp</a>
        </div>
    </nav>

        <div class="card w-50 mt-5 m-auto border text-white">
            <div class="card-header bg-1 w-100">
                <p class="display-5">Login</p>
            </div>
            <div class="card-body bg-2 px-5">
                <form action="{{ url('home') }}" method="post">
                    @csrf
                    
                    <div class="py-2">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" name="username" id="username" class="form-control">
                        @error('username')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="pb-2">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" name="password" id="password" class="form-control">
                        @error('password')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    @error('invalid')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <div class="py-2 d-flex justify-content-center">
                        <input type="submit" value="Login" class="btn bg-3 text-white w-25">
                    </div>
                </form>
            </div>
        </div>

    <button data-bs-toggle="modal" data-bs-target="#addUser" id="addUserBtn" hidden></button>
    <div class="modal" id="addUser">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-1"><h1 class="modal-title text-white">Add user</h1></div>
                <form action="{{ url('createAdmin') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <p>Please enter your user information</p>
                        <div class="m-2 p-2 border rounded">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" autocomplete="off" value="{{ old('name') }}">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="m-2 p-2 border rounded">
                            <label for="username">Username</label>
                            <input type="text" name="inputUsername" id="inputUsername" class="form-control" autocomplete="off" value="{{ old('inputUsername') }}">
                            @error('inputUsername')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="m-2 p-2 border rounded">
                            <label for="inputPassword">Password</label>
                            <input type="password" name="inputPassword" id="inputPassword" class="form-control">
                            @error('inputPassword')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer bg-secondary">
                        <input type="submit" value="Submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(count($user) == 0 || $errors->has('name') || $errors->has('inputUsername') || $errors->has('inputPassword'))
    <script>
        document.getElementById('addUserBtn').click();
    </script>
    @endif
</body>
</html>
