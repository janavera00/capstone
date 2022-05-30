<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SProMAp</title>

    <link rel="stylesheet" href="/css/calendar.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://kit.fontawesome.com/a7e674e45f.js" crossorigin="anonymous"></script>

    <style>
        .color-1 {color: #191919;}
        .color-2 {color: #2D4263;}
        .color-3 {color: #0076bf;}
        .color-4 {color: #C84B31;}

        .bg-1 {background-color: #191919;}
        .bg-2 {background-color: #2D4263;}
        .bg-3 {background-color: #0076bf;}
        .bg-4 {background-color: #C84B31;}

        .fa {
            color: #fff;
        }

        .p-0 {
            padding: 0;
        }

        a:hover {
            opacity: .5;
        }

        /* for scrollbar */
        ::-webkit-scrollbar {
            width: 1px;
        }
        
        .modal-content{
            font-size: 1.2rem;
        }
        .modal-content label{
            font-size: 1.4rem;
            padding-bottom: 0px;
        }
    </style>
</head>

<body>
    <!-- this page contains the nav bar and side bar if there are any
    this page will serve as the layout, this page will make sure
    that the page looks the same way in every tab -->
    <nav class="navbar bg-1">
        <div class="container-fluid">
            <a href="/" class="navbar-brand text-white fw-bolder ps-4">SProMAp</a>
        </div>
    </nav>

    @yield("content")

</body>

</html>