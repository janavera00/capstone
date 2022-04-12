@extends('layouts.app')

@section('content')

<div class="container-lg bg-2">
    <div class="container mt-3 text-center display-3 text-white">
        Weekly Schedule
    </div>

    <form action="" method="post">
        @csrf
        <div class="d-flex p-3 justify-content-center">
            <input type="submit" value="Add new Schedule" class="btn bg-3 text-white">
            <div class="input-group input-group-lg w-75 px-3">
                <input type="text" class="form-control  " placeholder="Search">
                <input type="submit" value="Search" class="btn bg-3 mx-3 text-white">
            </div>
        </div>

        <div class="row mt-3 text-center">
            <div class="col p-3 bg-2 text-white h2">Sun
                <ul class="list-group list-group-vertical h6">
                    <li class="list-group-item">asdasdasdas</li>
                    <li class="list-group-item">asdasda</li>
                    <li class="list-group-item">asdasda</li>
                    <li class="list-group-item">asdasda item</li>
                    <li class="list-group-item">asdasda item</li>
                    <li class="list-group-item">asdasda item</li>
                    <li class="list-group-item">asdasda </li>
                    <li class="list-group-item">asdasda </li>
                    <li class="list-group-item">asdasda </li>
                </ul>
            </div>

            <div class="col p-3 bg-2 text-white h2">Mon
                <ul class="list-group list-group-vertical h6">
                    <li class="list-group-item">asdasdasdas</li>
                    <li class="list-group-item">asdasda</li>
                    <li class="list-group-item">asdasda</li>
                    <li class="list-group-item">asdasda item</li>
                    <li class="list-group-item">asdasda item</li>
                    <li class="list-group-item">asdasda item</li>
                    <li class="list-group-item">asdasda </li>
                    <li class="list-group-item">asdasda </li>
                    <li class="list-group-item">asdasda </li>
                </ul>
            </div>

            <div class="col p-3 bg-2 text-white h2">Tue
                <ul class="list-group list-group-vertical h6">
                    <li class="list-group-item">asdasdasdas</li>
                    <li class="list-group-item">asdasda</li>
                    <li class="list-group-item">asdasda</li>
                    <li class="list-group-item">asdasda item</li>
                    <li class="list-group-item">asdasda item</li>
                    <li class="list-group-item">asdasda item</li>
                    <li class="list-group-item">asdasda </li>
                    <li class="list-group-item">asdasda </li>
                    <li class="list-group-item">asdasda </li>
                </ul>
            </div>

            <div class="col p-3 bg-2 text-white h2">Wed
                <ul class="list-group list-group-vertical h6">
                    <li class="list-group-item">asdasdasdas</li>
                    <li class="list-group-item">asdasda</li>
                    <li class="list-group-item">asdasda</li>
                    <li class="list-group-item">asdasda item</li>
                    <li class="list-group-item">asdasda item</li>
                    <li class="list-group-item">asdasda item</li>
                    <li class="list-group-item">asdasda </li>
                    <li class="list-group-item">asdasda </li>
                    <li class="list-group-item">asdasda </li>
                </ul>
            </div>

            <div class="col p-3 bg-2 text-white h2">Thu
                <ul class="list-group list-group-vertical h6">
                    <li class="list-group-item">asdasdasdas</li>
                    <li class="list-group-item">asdasda</li>
                    <li class="list-group-item">asdasda</li>
                    <li class="list-group-item">asdasda item</li>
                    <li class="list-group-item">asdasda item</li>
                    <li class="list-group-item">asdasda item</li>
                    <li class="list-group-item">asdasda </li>
                    <li class="list-group-item">asdasda </li>
                    <li class="list-group-item">asdasda </li>
                </ul>
            </div>

            <div class="col p-3 bg-2 text-white h2">Friday
                <ul class="list-group list-group-vertical h6">
                    <li class="list-group-item">asdasdasdas</li>
                    <li class="list-group-item">asdasda</li>
                    <li class="list-group-item">asdasda</li>
                    <li class="list-group-item">asdasda item</li>
                    <li class="list-group-item">asdasda item</li>
                    <li class="list-group-item">asdasda item</li>
                    <li class="list-group-item">asdasda </li>
                    <li class="list-group-item">asdasda </li>
                    <li class="list-group-item">asdasda </li>
                </ul>
            </div>

            <div class="col p-3 bg-2 text-white h2">Sat
                <ul class="list-group list-group-vertical h6">
                    <li class="list-group-item">asdasdasdas</li>
                    <li class="list-group-item">asdasda</li>
                    <li class="list-group-item">asdasda</li>
                    <li class="list-group-item">asdasda item</li>
                    <li class="list-group-item">asdasda item</li>
                    <li class="list-group-item">asdasda item</li>
                    <li class="list-group-item">asdasda </li>
                    <li class="list-group-item">asdasda </li>
                    <li class="list-group-item">asdasda </li>
                </ul>
            </div>

        </div>
</div>
</form>
</div>
@endsection