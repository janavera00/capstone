@extends('layouts.app')

@section('content')
    <div class="container bg-2 mt-3 px-5 rounded">
        <div class="row"  style="height: 90vh;">
            <div class="col-4 bg-white my-3 rounded">
                <div class="container overflow-auto pt-3" style="height: 85vh; width: fit-content;">
                    @for($i = 0;$i < 10;$i++)
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
                            <button class="btn btn-primary m-auto" style="width: 8rem;" data-bs-toggle="modal" data-bs-target="#newSched">Schedule new task</button>
                        </div>
                        <div class="col d-flex">
                            <div class="m-auto text-center" id="date"></div>
                        </div>
                        <div class="col"></div>
                    </div>
            
                    <div class="bg-white p-3 rounded overflow-auto mx-auto" style="height: 70vh;">
                        <div class="mx-auto" style="width: fit-content;">
                            <a href="{{ url('scheduling/1') }}" class="btn btn-primary bg-3" style="width: fit-content;">
                                <h2>10am - Lorem</h2>
                                <p>John Doe<br>Anywhere st.</p>
                            </a>
                        </div>
                        <hr>
                        
                        <div class="mx-auto" style="width: fit-content;">
                            <a href="" class="btn btn-primary bg-3" style="width: fit-content;">
                                <h2>10am - Ipsum</h2>
                                <p>John Doe<br>Anywhere st.</p>
                            </a>
                        </div>
                        <hr>
                        
                        <div class="mx-auto" style="width: fit-content;">
                            <a href="" class="btn btn-primary bg-3" style="width: fit-content;">
                                <h2>10am - Dolor</h2>
                                <p>John Doe<br>Anywhere st.</p>
                            </a>
                        </div>
                        <hr>
                        
                        <div class="mx-auto" style="width: fit-content;">
                            <a href="" class="btn btn-primary bg-3" style="width: fit-content;">
                                <h2>10am - sit</h2>
                                <p>John Doe<br>Anywhere st.</p>
                            </a>
                        </div>
                        <hr>
                        
                        <div class="mx-auto" style="width: fit-content;">
                            <a href="" class="btn btn-primary bg-3" style="width: fit-content;">
                                <h2>10am - amet</h2>
                                <p>John Doe<br>Anywhere st.</p>
                            </a>
                        </div>
                        <hr>
                        
                        <div class="mx-auto" style="width: fit-content;">
                            <a href="" class="btn btn-primary bg-3" style="width: fit-content;">
                                <h2>10am - consectetur</h2>
                                <p>John Doe<br>Anywhere st.</p>
                            </a>
                        </div>
                        <hr>
                        
                        <div class="mx-auto" style="width: fit-content;">
                            <a href="" class="btn btn-primary bg-3" style="width: fit-content;">
                                <h2>10am - Lorem</h2>
                                <p>John Doe<br>Anywhere st.</p>
                            </a>
                        </div>
                        <hr>
                        
                        <div class="mx-auto" style="width: fit-content;">
                            <a href="" class="btn btn-primary bg-3" style="width: fit-content;">
                                <h2>10am - Lorem</h2>
                                <p>John Doe<br>Anywhere st.</p>
                            </a>
                        </div>
                        <hr>
                        
                        <div class="mx-auto" style="width: fit-content;">
                            <a href="" class="btn btn-primary bg-3" style="width: fit-content;">
                                <h2>10am - Lorem</h2>
                                <p>John Doe<br>Anywhere st.</p>
                            </a>
                        </div>
                        <hr>
                        
                        <div class="mx-auto" style="width: fit-content;">
                            <a href="" class="btn btn-primary bg-3" style="width: fit-content;">
                                <h2>10am - Lorem</h2>
                                <p>John Doe<br>Anywhere st.</p>
                            </a>
                        </div>
                        <hr>
                        
                        <div class="mx-auto" style="width: fit-content;">
                            <a href="" class="btn btn-primary bg-3" style="width: fit-content;">
                                <h2>10am - Lorem</h2>
                                <p>John Doe<br>Anywhere st.</p>
                            </a>
                        </div>
                        <hr>
                        
                        <div class="mx-auto" style="width: fit-content;">
                            <a href="" class="btn btn-primary bg-3" style="width: fit-content;">
                                <h2>10am - Lorem</h2>
                                <p>John Doe<br>Anywhere st.</p>
                            </a>
                        </div>
                        <hr>
                        
                        <div class="mx-auto" style="width: fit-content;">
                            <a href="" class="btn btn-primary bg-3" style="width: fit-content;">
                                <h2>10am - Lorem</h2>
                                <p>John Doe<br>Anywhere st.</p>
                            </a>
                        </div>
                        <hr>
                        
                        <div class="mx-auto" style="width: fit-content;">
                            <a href="" class="btn btn-primary bg-3" style="width: fit-content;">
                                <h2>10am - Lorem</h2>
                                <p>John Doe<br>Anywhere st.</p>
                            </a>
                        </div>
                        <hr>
                        
                        <div class="mx-auto" style="width: fit-content;">
                            <a href="" class="btn btn-primary bg-3" style="width: fit-content;">
                                <h2>10am - Lorem</h2>
                                <p>John Doe<br>Anywhere st.</p>
                            </a>
                        </div>
                        <hr>
                        
                        <div class="mx-auto" style="width: fit-content;">
                            <a href="" class="btn btn-primary bg-3" style="width: fit-content;">
                                <h2>10am - Lorem</h2>
                                <p>John Doe<br>Anywhere st.</p>
                            </a>
                        </div>
                        <hr>
                        
                        <div class="mx-auto" style="width: fit-content;">
                            <a href="" class="btn btn-primary bg-3" style="width: fit-content;">
                                <h2>10am - Lorem</h2>
                                <p>John Doe<br>Anywhere st.</p>
                            </a>
                        </div>
                        <hr>
                        
                        <div class="mx-auto" style="width: fit-content;">
                            <a href="" class="btn btn-primary bg-3" style="width: fit-content;">
                                <h2>10am - Lorem</h2>
                                <p>John Doe<br>Anywhere st.</p>
                            </a>
                        </div>
                        <hr>
                        
                        <div class="mx-auto" style="width: fit-content;">
                            <a href="" class="btn btn-primary bg-3" style="width: fit-content;">
                                <h2>10am - Lorem</h2>
                                <p>John Doe<br>Anywhere st.</p>
                            </a>
                        </div>
                        <hr>
                        
                        
                    </div>
                </div>
            </div>
        </div>
        <script src="/js/calendar.js"></script>
    </div>

    
    <!-- Modal for adding schedule -->
    <div class="modal" id="newSched">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header text-white bg-1">
                    <h2 class="modal-title">Schedule new task</h2>
                </div>

                <div class="modal-body">
                    <form action="" method="get">
                        <div class="mt-2">
                            <label for="task" class="form-label">Task:</label>
                            <input type="text" name="task" id="task" class="form-control">
                        </div>
                        <div class="mt-2">
                            <label for="date" class="form-label">Date and Time:</label>
                            <div class="d-flex justify-content-between">
                                <input type="date" name="date" id="date" class="form-control" style="width: 49%;">
                                <input type="time" name="time" id="time" class="form-control" style="width: 49%;">
                            </div>
                        </div>
                        <div class="mt-2">
                            <label for="project" class="form-label">Project(client and location):</label>
                            <select name="project" id="project" class="form-control">
                                <option disabled selected hidden></option>
                                <option value="">John Doe - Anywhere St., Naga City</option>
                                <option value="">Jane Doe - Anywhere St., Pili, Camarines Sur</option>
                                <option value="">John Dame - Anywhere St., Canaman, Camarines Sur</option>
                            </select>
                        </div>
                        <div class="mt-2">
                            <label for="employee" class="fomr-label">Employee/s Assigned:</label>
                            <div>
                                <table id="dynamicField" class="w-100">
                                    <tr>
                                        <td>
                                            <!-- <input type="text" name="employee[]" id="employee" class="form-control"> -->
                                            <select name="employee[]" id="employee" class="form-control">
                                                <option selected hidden></option>
                                                <option value="">John Doe</option>
                                                <option value="">John Dane</option>
                                                <option value="">John Smith</option>
                                                <option value="">Jane Doe</option>
                                                <option value="">Johnathan Doe</option>
                                            </select>
                                        </td>
                                        <td style="width: 1rem;"><a class="btn btn-success" onclick="addEmployee()">+</a></td>
                                        <td style="width: 1rem;"><a class="btn btn-danger" onclick="removeEmployee()">-</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="my-2 d-flex justify-content-around">
                            <a class="btn bg-4 text-white" style="width: 200px;" data-bs-dismiss="modal">Cancel</a>
                            <input type="submit" value="Add" class="btn btn-primary" style="width: 200px;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let field = document.getElementById('dynamicField');
        const elmt = document.getElementsByTagName('td')[0];
        function addEmployee(){
            const row = document.createElement('tr');
            row.appendChild(elmt.cloneNode(true));
            field.appendChild(row);
        }
        function removeEmployee(){
            if(field.childElementCount > 1)
                field.removeChild(field.lastElementChild);
        }
    </script>
@endsection