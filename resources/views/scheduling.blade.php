@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="container-fluid my-3">

        <div class="text-white row bg-2 rounded">
        <div class="row">
            <div class="col d-flex">
                <div class="m-auto">
                    <a data-bs-toggle="modal" href="#addSched" class="btn bg-3">
                        <p class="text-white h4 pt-2 px-2">Add Schedule</p>
                    </a>
                </div>
            </div>
                <div class="col-1 d-flex justify-content-end">
                    <a href="" class="align-self-center">
                        <i class="fa fas fa-chevron-left align-self-center" style="font-size: 3rem;"></i>
                    </a>
                </div>
                <div class="col-6 d-flex justify-content-center">
                    <p class="display-3 pt-3">Weekly Schedule</p>
                </div>
                <div class="col-1 d-flex">
                    <a href="" class="align-self-center">
                        <i class="fa fas fa-chevron-right" style="font-size: 3rem;"></i>
                    </a>
                </div>
                <div class="col"></div>
            </div>
        </div>

        <!-- Modal for adding schedule -->
        <div class="modal" id="addSched">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header text-white bg-1">
                        <h2 class="modal-title">Add New Schedule</h2>
                    </div>

                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="mt-2">
                                <label for="title" class="form-label">Title:</label>
                                <input type="text" name="title" id="title" class="form-control">
                            </div>
                            <div>
                                <label for="date" class="form-label">Date:</label>
                                <input type="date" name="date" id="date" class="form-control">
                            </div>
                            <div>
                                <label for="time" class="form-label">Time:</label>
                                <input type="time" name="time" id="time" class="form-control">
                            </div>
                            <div class="mb-2">
                                <label for="assigned" class="form-label">Assigned To:</label>
                                <input type="text" name="assigned" id="assigned" class="form-control">
                            </div>
                            <div class="my-2 d-flex justify-content-around">
                                <a class="btn bg-4 text-white" style="width: 45%;" data-bs-dismiss="modal">Cancel</a>
                                <input type="submit" value="Add" class="btn btn-primary" style="width: 45%;">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3 p-3 text-white bg-2 rounded">
            <div class="col p-3">
                <h2 class="text-center">Sun</h2>
                <div class="overflow-auto rounded bg-white" style="height: 40rem;">
                    <ul class="list-group list-group-vertical h5">
                        <li class="list-group-item"><a href="{{ url('scheduling/1') }}" class="nav-link text-black">asdasdasdas</a></li>
                        <li class="list-group-item"><a href="{{ url('scheduling/1') }}" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="{{ url('scheduling/1') }}" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="{{ url('scheduling/1') }}" class="nav-link text-black">asdasda item</a></li>
                        <li class="list-group-item"><a href="{{ url('scheduling/1') }}" class="nav-link text-black">asdasda items</a></li>
                        <li class="list-group-item"><a href="{{ url('scheduling/1') }}" class="nav-link text-black">asdasdasdas</a></li>
                        <li class="list-group-item"><a href="{{ url('scheduling/1') }}" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="{{ url('scheduling/1') }}" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="{{ url('scheduling/1') }}" class="nav-link text-black">asdasda item</a></li>
                        <li class="list-group-item"><a href="{{ url('scheduling/1') }}" class="nav-link text-black">asdasda items</a></li>
                        <li class="list-group-item"><a href="{{ url('scheduling/1') }}" class="nav-link text-black">asdasdasdas</a></li>
                        <li class="list-group-item"><a href="{{ url('scheduling/1') }}" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="{{ url('scheduling/1') }}" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="{{ url('scheduling/1') }}" class="nav-link text-black">asdasda item</a></li>
                        <li class="list-group-item"><a href="{{ url('scheduling/1') }}" class="nav-link text-black">asdasda items</a></li>
                    </ul>
                </div>
            </div>
            <div class="col p-3">
                <h2 class="text-center">Mon</h2>
                <div class="overflow-auto rounded bg-white" style="height: 40rem;">
                    <ul class="list-group list-group-vertical h5">
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasdasdas</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda item</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda items</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasdasdas</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda item</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda items</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasdasdas</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda item</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda items</a></li>
                    </ul>
                </div>
            </div>
            <div class="col p-3">
                <h2 class="text-center">Tue</h2>
                <div class="overflow-auto rounded bg-white" style="height: 40rem;">
                    <ul class="list-group list-group-vertical h5">
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasdasdas</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda item</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda items</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasdasdas</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda item</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda items</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasdasdas</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda item</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda items</a></li>
                    </ul>
                </div>
            </div>
            <div class="col p-3">
                <h2 class="text-center">Wed</h2>
                <div class="overflow-auto rounded bg-white" style="height: 40rem;">
                    <ul class="list-group list-group-vertical h5">
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasdasdas</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda item</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda items</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasdasdas</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda item</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda items</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasdasdas</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda item</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda items</a></li>
                    </ul>
                </div>
            </div>
            <div class="col p-3">
                <h2 class="text-center">Thu</h2>
                <div class="overflow-auto rounded bg-white" style="height: 40rem;">
                    <ul class="list-group list-group-vertical h5">
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasdasdas</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda item</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda items</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasdasdas</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda item</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda items</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasdasdas</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda item</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda items</a></li>
                    </ul>
                </div>
            </div>
            <div class="col p-3">
                <h2 class="text-center">Fri</h2>
                <div class="overflow-auto rounded bg-white" style="height: 40rem;">
                    <ul class="list-group list-group-vertical h5">
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasdasdas</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda item</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda items</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasdasdas</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda item</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda items</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasdasdas</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda item</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda items</a></li>
                    </ul>
                </div>
            </div>
            <div class="col p-3">
                <h2 class="text-center">Sat</h2>
                <div class="overflow-auto rounded bg-white" style="height: 40rem;">
                    <ul class="list-group list-group-vertical h5">
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasdasdas</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda item</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda items</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasdasdas</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda item</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda items</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasdasdas</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda item</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-black">asdasda items</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection