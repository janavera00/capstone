@extends('layouts.app')

@section('content')
<div class="container-fluid w-75">

    <a href="{{ url('scheduling') }}" class="btn bg-4 px-4 py-3 my-4">
        <i class="fas fa-arrow-left fa fa-2xl"></i>
    </a>

    <div class="container bg-2 text-white rounded p-5" style="height: 42rem;">
        <div class="d-flex flex-column justify-content-between px-5 h-100">
            <div class="d-flex justify-content-between mx-5">
                <h3 class="p-3">Task:</h3>
                <div class="w-75 rounded p-3 ps-4 h3 bg-white text-black">Lorem</div>
            </div>
            <div class="d-flex justify-content-between mx-5">
                <h3 class="p-3">Schedule:</h3>
                <div class="w-75 h3 text-black d-flex justify-content-between">
                    <div class="bg-white p-3 ps-4 rounded" style="width: 24%;">Monday</div>
                    <div class="bg-white p-3 ps-4 rounded" style="width: 49%;">January 3, 2022</div>
                    <div class="bg-white p-3 ps-4 rounded" style="width: 24%;">1pm</div>
                </div>
            </div>
            <div class="d-flex justify-content-between mx-5">
                <h3 class="p-3">Client:</h3>
                <div class="w-75 rounded p-3 ps-4 h3 bg-white text-black">John Doe</div>
            </div>
            <div class="d-flex justify-content-between mx-5">
                <h3 class="p-3">Location:</h3>
                <div class="w-75 rounded p-3 ps-4 h3 bg-white text-black">Somewhere st.</div>
            </div>

            <div class="mx-5">
                <div class="d-flex justify-content-between">
                    <h3 class="p-3">Employee Assigned:</h3>
                </div>

                <div class="d-flex justify-content-around">
                    <div class="overflow-auto rounded bg-white w-50 ms-5" style="height: 10rem;">
                        <ul class="list-group list-group-vertical h4">
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between m-1">
                                    <div>John Smith</div>
                                    -
                                    <div class="px-5">Engineer</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between m-1">
                                    <div>John Brown</div>
                                    -
                                    <div class="px-5">Surveyor</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between m-1">
                                    <div>Richard Roe</div>
                                    -
                                    <div class="px-5">Surveyor</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between m-1">
                                    <div>John Roe</div>
                                    -
                                    <div class="px-5">Surveyor</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between m-1">
                                    <div>Richard Smith</div>
                                    -
                                    <div class="px-5">Surveyor</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="my-auto">
                        <a href="" class="mb-3 btn bg-3 px-5">
                            <p class="text-white h4 pt-2">Edit Schedule</p>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection