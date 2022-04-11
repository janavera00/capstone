<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SProMAp</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>

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
    <!-- this page contains the nav bar and side bar if there are any
    this page will serve as the layout, this page will make sure
    that the page looks the same way in every tab -->

    @yield('content')
</body>
</html>