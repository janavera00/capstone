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

        .btn{
            width: 200px;
        }

        .profilePic{
            max-width: 100px;
            max-height: 100px;
            overflow: hidden;
        }
    </style>
</head>

<body>
    <!-- this page contains the nav bar and side bar if there are any
    this page will serve as the layout, this page will make sure
    that the page looks the same way in every tab -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <a href="/" class="navbar-brand text-white fw-bolder ps-4">SProMAp</a>
        </div>
    </nav>

    <div class="container-fluid">

        @php
        $url = explode("/", url()->current());
        $url = $url[count($url)-1];
        @endphp


        <div class="row" style="height: calc(100vh - 55px);">
            <div class="d-flex justify-content-between flex-column bg-2 p-0" style="width: 4.5rem;">
                <ul class="nav nav-pills nav-flush flex-column">
                    <li class="nav-item text-center border-bottom 
                        @if($url == 'home')
                            bg-3
                        @endif
                    ">
                        <a href="{{ url('home') }}" class="nav-link py-4">
                            <img src="{{ asset('images/assets/gauge-high-solid-white.svg') }}" width="25rem">
                        </a>
                    </li>
                    <li class="nav-item text-center border-bottom
                        @if($url == 'clients')
                        bg-3
                        @elseif(Auth()->user()->role == 'Surveyor')
                        bg-secondary
                        @endif
                    ">
                        @if(Auth()->user()->role == "Surveyor")
                        <div class="py-4">
                            <img src="{{ asset('images/assets/folder-open-solid-white.svg') }}" width="25rem">
                        </div>
                        @else
                            @if(Auth()->user()->role == "Admin" || Auth()->user()->role == "Secretary")
                                <a href="{{ url('clients') }}" class="nav-link py-4">
                            @else
                                <a href="{{ url('projects') }}" class="nav-link py-4">
                            @endif
                            <img src="{{ asset('images/assets/folder-open-solid-white.svg') }}" width="25rem">
                        </a>
                        @endif
                    </li>
                    <li class="nav-item text-center border-bottom
                        @if($url == 'scheduling')
                        bg-3
                        @endif
                    ">
                        <a href="{{ url('scheduling') }}" class="nav-link py-4">
                            <img src="{{ asset('images/assets/calendar-days-solid-white.svg') }}" width="22rem">
                        </a>
                    </li>
                </ul>

                <!-- Offcanvas -->
                <div>
                    <a href="#sidebar" class="d-flex align-items-center justify-content-center ms-3 ps-3 mb-5 pb-5 link-dark text-decoration-none" data-bs-toggle="offcanvas">
                        <i class="fa fa-solid fa-caret-right fa-2xl"></i>
                    </a>
                </div>

                <div class="offcanvas offcanvas-start" style="width: 15vmax;" id="sidebar">
                    <div class="offcanvas-header bg-1 py-2 ps-5 p-0">
                        <a href="/" class="navbar-brand text-white fw-bolder ps-4">SProMAp</a>
                    </div>
                    <div class="offcanvas-body d-flex justify-content-between flex-column bg-2 p-0">
                        <ul class="nav nav-pills nav-flush flex-column">
                            <li class="nav-item text-start border-bottom">
                                <a href="" class="nav-link py-3 d-flex align-items-center">
                                    <i class="fa fa-solid fa-gauge-high fa-xl"></i>
                                    <h3 class="text-white m-1 ms-3">Dashboard</h3>
                                </a>
                            </li>
                            <li class="nav-item text-start border-bottom">
                            @if(Auth()->user()->role == 'Surveyor')   
                                <div class=" bg-secondary nav-link py-3 d-flex align-items-center">
                                    <i class="fa fa-solid fa-folder-open fa-xl"></i>
                                    <h3 class="text-white m-1 ms-3">Filing</h3>
                                </div>
                            @else                     
                                <a href="" class="nav-link py-3 d-flex align-items-center">
                                    <i class="fa fa-solid fa-folder-open fa-xl"></i>
                                    <h3 class="text-white m-1 ms-3">Filing</h3>
                                </a>
                            @endif
                            </li>
                            <li class="nav-item text-start border-bottom">
                                <a href="" class="nav-link py-3 d-flex align-items-center">
                                    <i class="fa fa-solid fa-calendar fa-xl"></i>
                                    <h3 class="text-white m-1 ms-3">Scheduling</h3>
                                </a>
                            </li>
                        </ul>

                        <div>
                            <a href="#sidebar" class="d-flex justify-content-end mb-3 me-2 link-dark text-decoration-none" data-bs-dismiss="offcanvas">
                                <i class="fa fa-solid fa-caret-left fa-2xl"></i>
                            </a>
                        </div>

                        <div class="border-top py-3">
                            <a href="{{ url('users') }}" class="nav-link pt-3 mx-3 d-flex justify-content-center align-items-center">
                            <img src="{{ asset('images/users/'.Auth()->user()->image) }}" class="rounded-circle border profilePic">
                                <h3 class="text-white text-center m-1 ms-3 text-break" style="width: 20rem;">{{ Auth()->user()->name }}</h3>
                            </a>
                            <div class="w-100 mb-3 d-flex justify-content-center">
                                <a href="{{ url('logout') }}" class="btn btn-danger">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="border-top">
                    <a href="{{ url('users') }}" class="d-flex align-items-center justify-content-center m-3 p-2 link-dark text-decoration-none">
                        <img src="{{ asset('images/users/'.Auth()->user()->image) }}" class="rounded-circle border profilePic">
                    </a>
                </div>

            </div>


            <div class="col">
                @yield("content")
            </div>
        </div>
    </div>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        
    </script>

</body>

</html>