@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ url('filing') }}" class="btn bg-4 px-4 py-3 my-4">
        <i class="fas fa-arrow-left fa fa-2xl"></i>
    </a>
    <div class="container text-white bg-2 overflow-auto" style="height: 80vh;">
        <div class="row text-black bg-white mt-3 p-2 rounded">
            <div class="col-2 d-flex" style="border-right: 1px solid gray;">
                <div class="m-auto">
                    <h1>00001</h1>
                </div>
            </div>
            <div class="col-10">
                <h3>John Doe <br>Anywhere St.</h3>
            </div>
        </div>

        <div class="d-flex justify-content-between p-3">
            <div class="my-auto">
                <button data-bs-toggle="modal" data-bs-target="#addSched" class="btn bg-3 text-white">Add File</button>
            </div>

            <form action="" method="post" class="my-auto w-75">
                <div class="my-auto w-100 d-flex ms-auto">
                    <input type="text" name="search" id="search" class="form-control mx-2">
                    <input type="submit" value="Search" class="btn bg-3 text-white">
                </div>
            </form>
        </div>

        <div>
            <table class="table table-light table-bordered mt-3" style="margin-bottom: 0px;">
                <tr class="text-center">
                    <th style="width: 20%;">File No.</th>
                    <th style="width: 40%;">Title</th>
                    <th style="width: 40%;">Description</th>
                </tr>
            </table>
            <div class="overflow-auto" style="height: 55vh;">
                <table class="table table-light table-striped table-bordered table-hover">
                    @php
                    $link = "location.href = '123'";
                    @endphp
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">Land Title</td>
                        <td style="width: 40%;">proof that this lot is registered</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection