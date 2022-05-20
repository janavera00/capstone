@extends('layouts.app')

@section('content')
    <div class="container bg-2 mt-3 px-5">
        <div class="row"  style="height: 90vh;">
            <div class="col-4 bg-white my-3 rounded">
                <div class="container overflow-auto" style="height: 85vh; width: fit-content;">
                    
                    <div class="row mt-2">
                        <div class="col d-flex">
                            <a href="" class="m-auto text-black">
                                <i class="fas fa-angle-left fa-2xl"></i>
                            </a>
                        </div>
                        <div class="col d-flex">
                            <h1 class="m-auto" id="year"></h1>
                        </div>
                        <div class="col d-flex">
                        <a href="" class="m-auto text-black">
                                <i class="fas fa-angle-right fa-2xl"></i>
                            </a>
                        </div>
                    </div>
                    
                    @for($i = 0;$i < 12;$i++)
                    <hr class="text-black">
                    <div class="calendar mt-2" id="{{$i}}">
                        <div class="month">
                            <div class="date">
                                <h1></h1>
                            </div>
                        </div>
                        <div class="weekdays"></div>
                        <div class="days"></div>
                    </div>
                    @endfor
                </div>
            </div>

            <div class="col mt-3">
                <div class="container">
                    <div class="row text-white mx-auto mt-2 p-2">
                        <div class="col d-flex">
                            <button class="btn btn-primary m-auto" style="height: 2.5rem;">Schedule new task</button>
                        </div>
                        <div class="col d-flex">
                            <div class="m-auto text-center" id="date"></div>
                        </div>
                        <div class="col"></div>
                    </div>
            
                    <div class="bg-white p-3 rounded overflow-auto" style="height: 70vh;">
                        <button class="btn btn-primary bg-3" style="width: fit-content;">
                            <h2>10am - Lorem</h2>
                            <p>John Doe<br>Anywhere st.</p>
                        </button>
                        <hr>
                        
                        <button class="btn btn-primary bg-3" style="width: fit-content;">
                            <h2>10am - Lorem</h2>
                            <p>John Doe<br>Anywhere st.</p>
                        </button>
                        <hr>
                        
                        <button class="btn btn-primary bg-3" style="width: fit-content;">
                            <h2>10am - Lorem</h2>
                            <p>John Doe<br>Anywhere st.</p>
                        </button>
                        <hr>
                        
                        <button class="btn btn-primary bg-3" style="width: fit-content;">
                            <h2>10am - Lorem</h2>
                            <p>John Doe<br>Anywhere st.</p>
                        </button>
                        <hr>
                        
                        <button class="btn btn-primary bg-3" style="width: fit-content;">
                            <h2>10am - Lorem</h2>
                            <p>John Doe<br>Anywhere st.</p>
                        </button>
                        <hr>
                        
                        <button class="btn btn-primary bg-3" style="width: fit-content;">
                            <h2>10am - Lorem</h2>
                            <p>John Doe<br>Anywhere st.</p>
                        </button>
                        <hr>
                        
                        <button class="btn btn-primary bg-3" style="width: fit-content;">
                            <h2>10am - Lorem</h2>
                            <p>John Doe<br>Anywhere st.</p>
                        </button>
                        <hr>
                        
                        <button class="btn btn-primary bg-3" style="width: fit-content;">
                            <h2>10am - Lorem</h2>
                            <p>John Doe<br>Anywhere st.</p>
                        </button>
                        <hr>
                        
                        <button class="btn btn-primary bg-3" style="width: fit-content;">
                            <h2>10am - Lorem</h2>
                            <p>John Doe<br>Anywhere st.</p>
                        </button>
                        <hr>
                        
                        <button class="btn btn-primary bg-3" style="width: fit-content;">
                            <h2>10am - Lorem</h2>
                            <p>John Doe<br>Anywhere st.</p>
                        </button>
                        <hr>
                        
                        <button class="btn btn-primary bg-3" style="width: fit-content;">
                            <h2>10am - Lorem</h2>
                            <p>John Doe<br>Anywhere st.</p>
                        </button>
                        <hr>
                        
                        <button class="btn btn-primary bg-3" style="width: fit-content;">
                            <h2>10am - Lorem</h2>
                            <p>John Doe<br>Anywhere st.</p>
                        </button>
                        <hr>
                        
                        <button class="btn btn-primary bg-3" style="width: fit-content;">
                            <h2>10am - Lorem</h2>
                            <p>John Doe<br>Anywhere st.</p>
                        </button>
                        <hr>
                        
                        <button class="btn btn-primary bg-3" style="width: fit-content;">
                            <h2>10am - Lorem</h2>
                            <p>John Doe<br>Anywhere st.</p>
                        </button>
                        <hr>
                        
                        <button class="btn btn-primary bg-3" style="width: fit-content;">
                            <h2>10am - Lorem</h2>
                            <p>John Doe<br>Anywhere st.</p>
                        </button>
                        <hr>
                        
                        <button class="btn btn-primary bg-3" style="width: fit-content;">
                            <h2>10am - Lorem</h2>
                            <p>John Doe<br>Anywhere st.</p>
                        </button>
                        <hr>
                        
                        <button class="btn btn-primary bg-3" style="width: fit-content;">
                            <h2>10am - Lorem</h2>
                            <p>John Doe<br>Anywhere st.</p>
                        </button>
                        <hr>
                        
                    </div>
                </div>
            </div>
        </div>
        <script src="/js/calendar.js"></script>
    </div>

@endsection