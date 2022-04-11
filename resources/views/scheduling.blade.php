@extends('layouts.app')
@section('content')
  
    <div class = "container mt-3 text-center display-3"> 
        Weekly Schedule
    </div>

    <form action = "" method = "post">

        <div class = "d-flex p-3 justify-content-center" >
            <input type="submit" value="Add new Schedule" class="btn bg-3 text-white w-20">
                <div class = "input-group input-group-lg w-50 px-3">
                    <input type="text" class="form-control  " placeholder="Search">
                    <input type="submit" value="Search" class="btn bg-3 mx-3 text-white w-20">   
                </div>
                      
        </div>

        <table class = "table table-bordered">
            <thead>
                <tr>
                    <th class = "text-center">Sunday</th>
                    <th class = "text-center">Monday</th>
                    <th class = "text-center">Tuesday</th>
                    <th class = "text-center">Wednesday</th>
                    <th class = "text-center">Thursday</th>
                    <th class = "text-center">Friday</th>
                    <th class = "text-center">Saturday</th>
                </tr>
            </thead>
            
        </table>


    
    </form>
    
    


@endsection