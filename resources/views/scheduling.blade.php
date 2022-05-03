@extends('layouts.app')
<head>
    <style>
        h2{
            text-align: center;
        }
    </style>
</head>
@section('content')

<div class="container-fluid">
    <div class="container-fluid my-3">

        <div class="text-white row bg-2 rounded w-75 mx-auto">
            <div class="col-3 d-flex justify-content-end">
                <a href="" class="align-self-center">
                    <i class="fa fas fa-chevron-left align-self-center" style="font-size: 3rem;"></i>
                </a>
            </div>
            <div class="col-6 d-flex justify-content-center">
                <p class="display-3 pt-3">Weekly Schedule</p>
            </div>
            <div class="col-3 d-flex">
                <a href="" class="align-self-center">
                    <i class="fa fas fa-chevron-right" style="font-size: 3rem;"></i>
                </a>
            </div>
        </div>

        <div class="row mt-3 p-3 text-white bg-2 rounded">
            <div class="col p-3">
                <h2>Sun</h2>
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
                <h2>Mon</h2>
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
                <h2>Tue</h2>
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
                <h2>Wed</h2>
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
                <h2>Thu</h2>
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
                <h2>Fri</h2>
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
                <h2>Sat</h2>
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