@extends('layouts.app')
@section('content')
  
    <div class = "container mt-3 text-center display-3"> 
        Weekly Schedule
    </div>

    <form action = "" method = "post">

        <div class = "d-flex p-3 " >
            <input type="submit" value="Add new Schedule" class="btn bg-3 text-white w-20">
                <div class = "input-group input-group-lg w-50 px-3">
                    <input type="text" class="form-control  " placeholder="Search">
                </div>

                <div class = "px-2">
                     <input type="submit" value="Search" class="btn bg-3 text-white w-20">
                </div>       
        </div>

    
    </form>
    
    


@endsection