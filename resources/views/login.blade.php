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
        .color-3{color: #1199EE;}
        .color-4{color: #C84B31;}

        .bg-1{background-color: #191919;}
        .bg-2{background-color: #2D4263;}
        .bg-3{background-color: #1199EE;}
        .bg-4{background-color: #C84B31;}
    </style>    
</head>
<body>
    <nav class="navbar bg-1">
        <div class="container-fluid">
            <a href="/" class="navbar-brand text-white fw-bolder ps-4">SProMAp</a>
        </div>
    </nav>
    <div class="card w-50 mt-5 mx-auto border text-white">
        <div class="card-header bg-1 w-100">
            <p class="display-5">Login</p>
        </div>
        <div class="card-body bg-2 px-5">
            <form action="{{ route('login') }}" method="post">
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
</body>
</html>
