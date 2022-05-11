@extends('layouts.app')

@section('content')
    
    <div class="container text-white bg-2 mt-5 overflow-auto" style="height: 80vh;">
        <div class="d-flex justify-content-between p-3">
            <div class="my-auto">
                <button data-bs-toggle="modal" data-bs-target="#addSched" class="btn bg-3 text-white">Add Project</button>
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
                    <th style="width: 20%;">Control No.</th>
                    <th style="width: 40%;">Client</th>
                    <th style="width: 40%;">Location</th>
                </tr>
            </table>
            <div class="overflow-auto" style="height: 65vh;">
                <table class="table table-light table-striped table-bordered table-hover">
                    @php
                        $link = "location.href = '123'";
                    @endphp
                    <tr onclick="{{ $link }}"> 
                        <td style="width: 20%;">00001</td>
                        <td style="width: 40%;">John Doe</td>
                        <td style="width: 40%;">Anywhere St.</td>
                    </tr>
                    
                    <tr>
                        <td>00001</td>
                        <td>John Doe</td>
                        <td>Anywhere St.</td>
                    </tr>
                    <tr>
                        <td>00001</td>
                        <td>John Doe</td>
                        <td>Anywhere St.</td>
                    </tr>
                    <tr>
                        <td>00001</td>
                        <td>John Doe</td>
                        <td>Anywhere St.</td>
                    </tr>
                    <tr>
                        <td>00001</td>
                        <td>John Doe</td>
                        <td>Anywhere St.</td>
                    </tr>
                    <tr>
                        <td>00001</td>
                        <td>John Doe</td>
                        <td>Anywhere St.</td>
                    </tr>
                    <tr>
                        <td>00001</td>
                        <td>John Doe</td>
                        <td>Anywhere St.</td>
                    </tr>
                    <tr>
                        <td>00001</td>
                        <td>John Doe</td>
                        <td>Anywhere St.</td>
                    </tr>
                    <tr>
                        <td>00001</td>
                        <td>John Doe</td>
                        <td>Anywhere St.</td>
                    </tr>
                    <tr>
                        <td>00001</td>
                        <td>John Doe</td>
                        <td>Anywhere St.</td>
                    </tr>
                    <tr>
                        <td>00001</td>
                        <td>John Doe</td>
                        <td>Anywhere St.</td>
                    </tr>
                    <tr>
                        <td>00001</td>
                        <td>John Doe</td>
                        <td>Anywhere St.</td>
                    </tr>
                    <tr>
                        <td>00001</td>
                        <td>John Doe</td>
                        <td>Anywhere St.</td>
                    </tr>
                    <tr>
                        <td>00001</td>
                        <td>John Doe</td>
                        <td>Anywhere St.</td>
                    </tr>
                    <tr>
                        <td>00001</td>
                        <td>John Doe</td>
                        <td>Anywhere St.</td>
                    </tr>
                    <tr>
                        <td>00001</td>
                        <td>John Doe</td>
                        <td>Anywhere St.</td>
                    </tr>
                    <tr>
                        <td>00001</td>
                        <td>John Doe</td>
                        <td>Anywhere St.</td>
                    </tr>
                    <tr>
                        <td>00001</td>
                        <td>John Doe</td>
                        <td>Anywhere St.</td>
                    </tr>
                    <tr>
                        <td>00001</td>
                        <td>John Doe</td>
                        <td>Anywhere St.</td>
                    </tr>
                    <tr>
                        <td>00001</td>
                        <td>John Doe</td>
                        <td>Anywhere St.</td>
                    </tr>
                    <tr>
                        <td>00001</td>
                        <td>John Doe</td>
                        <td>Anywhere St.</td>
                    </tr>
                    <tr>
                        <td>00001</td>
                        <td>John Doe</td>
                        <td>Anywhere St.</td>
                    </tr>
                    <tr>
                        <td>00001</td>
                        <td>John Doe</td>
                        <td>Anywhere St.</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    @endsection