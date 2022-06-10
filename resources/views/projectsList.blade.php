@extends('layouts.app')

@section('content')

@if(Auth()->user()->role == "Head of Office" || Auth()->user()->role == "Secretary")
<div class="container px-0">
    <a href="/clients" class="btn btn-danger mt-4"><img src="{{asset('images/assets/arrow-left-solid-white.svg')}}" width="30rem"></a>
</div>
@endif

@php
    if(Auth()->user()->role == "Head of Office" || Auth()->user()->role == "Secretary"){
        $projects = $client->clientProjects;
    } else {
        $projects = Auth()->user()->engrProjects;
    }

@endphp
<div class="container text-white bg-2 mt-2 overflow-auto rounded" style="height: 80vh;">
    @if(Auth()->user()->role == "Head of Office" || Auth()->user()->role == "Secretary")
    <div class="row p-3">
        <!-- buttons -->
        <div class="col-2 border-end">
            <button class="btn btn-success w-100" onclick="showInfo()" id="collapseBtn" data-bs-toggle="collapse" data-bs-target="#clientInfo">Show More Info</button>
        </div>

        <!-- client's information -->
        <div class="col">
            <div class="d-flex justify-content-center">
                <div style="width: fit-content;" class="my-auto">
                    <img src="{{asset('images/users/'.$client->image)}}" class="rounded me-3" height="100rem">
                </div>
                <h1 class="text-center my-auto" style="width: fit-content;">{{$client->name}}</h1>
            </div>
            
                <div class="collapse" id="clientInfo">
                    <hr>
                    @if($client->address)
                    <div class="row m-2 pt-2">
                        <p class="col-2 h-100 my-auto">Address</p>
                        <div class="col p-2 bg-white text-black rounded">{{ $client->address }}</div>
                    </div>
                    @endif
                    @if($client->contact)
                    <div class="row m-2 pt-2">
                        <p class="col-2 h-100 my-auto">Contact number</p>
                        <div class="col p-2 bg-white text-black rounded">{{ $client->contact }}</div>
                    </div>
                    @endif
                    @if($client->email)
                    <div class="row m-2 pt-2">
                        <p class="col-2 h-100 my-auto">Email address</p>
                        <div class="col p-2 bg-white text-black rounded">{{ $client->email }}</div>
                    </div>
                    @endif
                    <div class="row m-2 pt-2">
                        <p class="col-2 h-100 my-auto">Username</p>
                        <div class="col p-2 bg-white text-black rounded">{{ $client->username }}</div>
                    </div>
                    <hr>
                    <div class="mt-3 d-flex">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editClient" style="width: 200px;" id="editClientBtn">Edit information</button>
                    </div>
                </div>
            
        </div>
    </div>
    
    
    
    <hr>
    @endif




    <!-- projects List -->
    <div class="container rounded border border-2 my-2">
        <!-- header -->
        <div class="mx-2 row py-2 border-bottom">
            <div class="col d-flex">
            @if(Auth()->user()->role == "Head of Office" || Auth()->user()->role == "Secretary")
                <button data-bs-toggle="modal" data-bs-target="#addProject" id="addProjectBtn" class="btn btn-primary my-auto ms-auto" >Add a project</button>
            @endif
            </div>
            <h1 class="col text-center">Projects</h1>
            <div class="col">
                <button data-bs-toggle="collapse" data-bs-target="#archivedProjects" id="archivedProjectsBtn" class="btn btn-success my-auto ms-auto">Show all projects</button>
            </div>
        </div>

        @if(Auth()->user()->role != 'Head of Office' && Auth()->user()->role != 'Secretary')
            <div class="overflow-auto" style="height: 70vh;">
        @else
            <div class="overflow-auto" style="height: 53vh;">
        @endif

            <div class="d-flex">
                <h1 class="mx-auto border-bottom px-5 pt-4" style="width: fit-content;">Active</h1>
            </div>
            <div class="row">
                
            
                @foreach($projects as $project)
                @if($project->status != "Archived")
                <div class="col-3 my-2">
                    <a href="{{ url('projectContent/'.$project->id) }}" class="text-decoration-none text-black">
                        <div class="card">
                            <div class="card-header">
                                <h1 class="text-black text-center"><?php printf('%05d', $project->id); ?></h1>
                            </div>
                            <div class="card-body">
                                <h5 class="text-black text-center">{{ ($project->lot_number)?$project->lot_number:'' }}</h5>
                                <h5 class="text-black text-center">{{ ($project->survey_number)?$project->survey_number:'' }}</h5>
                            </div> 
                            <div class="card-footer">
                                <p class="text-black text-center">{{ $project->location }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                @endforeach
            </div>

            <div class="collapse" id="archivedProjects">
                <div class="d-flex">
                    <h1 class="mx-auto border-bottom px-5 pt-4" style="width: fit-content;">Archived</h1>
                </div>
                <div class="row">
                    @foreach($projects as $project)
                    @if($project->status == "Archived")
                    <div class="col-3 my-2">
                        <a href="{{ url('projectContent/'.$project->id) }}" class="text-decoration-none text-black">
                            <div class="card">
                                <div class="card-header">
                                    <h1 class="text-black text-center"><?php printf('%05d', $project->id); ?></h1>
                                </div>
                                <div class="card-body">
                                    <h5 class="text-black text-center">{{ ($project->lot_number)?$project->lot_number:'' }}</h5>
                                    <h5 class="text-black text-center">{{ ($project->survey_number)?$project->survey_number:'' }}</h5>
                                </div> 
                                <div class="card-footer">
                                    <p class="text-black text-center">{{ $project->location }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@if(Auth()->user()->role == "Head of Office" || Auth()->user()->role == "Secretary")
<!-- -------------------------------------------------------- -->
<!-- modal for editing client information -->
<div>
    <div class="modal fade" id="editClient">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-1 text-white">
                    <h1 class="modal-title">Edit client's information</h1>
                </div>
                <form action="{{ url('client/'.$client->id.'/update') }}" id="formClientEdit" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="m-2 rounded border p-2">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" class="form-control" autocomplete="off" value="{{ ($client->address)?$client->address:'' }}">
                            
                        </div>
                        <div class="m-2 rounded border p-2">
                            <label for="contact">Contact number</label>
                            <input type="text" name="contact" id="contact" class="form-control" autocomplete="off" onfocusout="validate('contact', 'submitClientEdit', 'formClientEdit')" value="{{ ($client->contact)?$client->contact:'' }}" maxlength="11">
                            <p class="text-danger error" id="errorcontact"></p>
                        </div>
                        @if(!($client->email))
                        <div class="m-2 rounded border p-2">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" autocomplete="off" onfocusout="validate('email', 'submitClientEdit', 'formClientEdit')" value="{{ ($client->email)?$client->email:'' }}">
                            <p class="text-danger error" id="erroremail"></p>
                        </div>
                        @else
                            <input type="hidden" name="email" value="{{ ($client->email)?$client->email:'' }}">
                        @endif
                    </div>
                    <div class="modal-footer bg-secondary">
                        <a href="" class="btn btn-danger" data-bs-dismiss="modal" style="width: 200px;">Cancel</a>
                        <input type="submit" value="Update" class="btn btn-primary" id="submitClientEdit" style="width: 200px;">
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if($errors->has('address') || $errors->has('contact') || $errors->has('email'))
    <script>
        document.getElementById('editClientBtn').click();
    </script>
    @endif
</div>



<!-- -------------------------------------------------------- -->
<!-- Modal for adding project -->
<div>
    <div class="modal fade" id="addProject">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header text-white bg-1">
                    <h2 class="modal-title">Add project</h2>
                </div>
    
                <form action="{{ url('filing/create/'.$client->id) }}" method="post" id="formProjectAdd">
                    @csrf
                    <div class="modal-body overflow-auto" style="height: 60vh;">
                        <div class="p-2 my-2 border rounded">
                            <label for="type">*Type of service:</label>
                            <select name="type" id="type" class="form-control required" onfocusout="validate('type', 'submitProjectAdd', 'formProjectAdd')">
                                <option selected hidden></option>
                                @foreach($services as $service)
                                <option value="{{$service->id}}" {{($service->id == old('type'))?'selected':''}}>{{$service->name}}</option>
                                @endforeach
                            </select>
                            <p class="text-danger error" id="errortype"></p>
                        </div>
    
                        <div class="p-2 my-2 border rounded">
                            <label for="loc">Engineer in-charge:</label>
                            <select name="engr" id="engr" class="form-control">
                                <option selected></option>
                                @foreach($users as $user)
                                @if($user->role == "Engineer")
                                <option value="{{$user->id}}" {{($user->id == old('engr'))?'selected':''}}>{{$user->role}} - {{$user->name}}</option>
                                @endif
                                @endforeach
                            </select>
                            
                            @error('engr')
                            <p class="text-danger">*{{$message}}</p>
                            @enderror
                        </div>
    
                        <div class="p-2 my-2 border rounded">
                            <label for="loc">*Location:</label>
                            <input type="text" name="loc" id="loc" class="form-control required" value="{{ old('loc') }}" autocomplete="off" onfocusout="validate('loc', 'submitProjectAdd', 'formProjectAdd')">
                            <p class="text-danger error" id="errorloc"></p>
                        </div>
    
                        <div class="p-2 my-2 border rounded">
                            <div class="row">
                                <div class="col-4 border-end">
                                    <label for="lotNum">Lot number:</label>
                                    <div class="d-flex">
                                        <p class="py-1 me-2  mb-0">Lot</p>
                                        <input type="text" name="lotNum" id="lotNum" class="form-control" value="{{ old('lotNum') }}" autocomplete="off" style="height: 2.3rem;" onfocusout="validate('lotNum', 'submitProjectAdd', 'formProjectAdd')">
                                    </div>
                                    <p class="text-danger error" id="errorlotNum"></p>
                                </div>
                                <div class="col-8">
                                    <label for="surNum">Survey number:</label>
                                    <div class="d-flex">
                                        <p class="py-1 me-2 mb-0">Psd-</p>
                                        <input type="text" name="surNum" id="surNum" class="form-control" value="{{ old('surNum') }}" autocomplete="off" maxlength="9" placeholder="xx-xxxxxx" style="height: 2.3rem;" onfocusout="validate('surNum', 'submitProjectAdd', 'formProjectAdd')">
                                    </div>
                                    <p class="text-danger error" id="errorsurNum"></p>
                                </div>
                            </div>
                        </div>
    
                        <div class="p-2 my-2 border rounded">
                            <label for="lotArea">Lot area:</label>
                            <input type="text" name="lotArea" id="lotArea" class="form-control" value="{{ old('lotArea') }}" autocomplete="off" onfocusout="validate('lotArea', 'submitProjectAdd', 'formProjectAdd')">
                            <p class="text-danger error" id="errorlotArea"></p>
                        </div>
    
                        <div class="p-2 my-2 border rounded">
                            <label for="landOwn">Registered land owner:</label>
                            <input type="text" name="landOwn" id="landOwn" class="form-control" value="{{ old('landOwn') }}" autocomplete="off">
                            @error('landOwn')
                            <p class="text-danger">*{{$message}}</p>
                            @enderror
                        </div>
    
                    </div>
                    <div class="modal-footer bg-secondary">
                        <a class="btn btn-danger" style="width: 200px;" data-bs-dismiss="modal">Cancel</a>
                        <button class="btn btn-primary" style="width: 200px;" id="submitProjectAdd" onclick="checkSubmit('submitProjectAdd', 'formProjectAdd')">Add</button>
                        <input type="submit" id="submitProjectAddBtn" hidden>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if($errors->has('type') || $errors->has('engr') || $errors->has('loc') || $errors->has('lotNum') || $errors->has('surNum') || $errors->has('surveyNumber') || $errors->has('lotArea') || $errors->has('landOwn'))
    <script>
        document.getElementById('addProjectBtn').click();
    </script>
    @endif
</div>


@if(session()->has('failed'))
    <div class="modal" id="success">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger"><h1 class="modal-title text-white">Failed</h1></div>
                <div class="modal-body d-flex flex-column">
                    <p class="m-auto">{{ session()->get('failed') }}</p>
                    <button class="btn btn-primary mx-auto" data-bs-dismiss="modal">Continue</button>
                </div>
            </div>
        </div>
    </div>
    <button data-bs-toggle="modal" data-bs-target="#success" id="successBtn" hidden></button>
    <script>
        document.getElementById('successBtn').click();
    </script>
@endif
@if(session()->has('success'))
    <div class="modal" id="success">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success"><h1 class="modal-title text-white">Success</h1></div>
                <div class="modal-body d-flex flex-column">
                    <p class="m-auto">{{ session()->get('success') }}</p>
                    <button class="btn btn-primary mx-auto" data-bs-dismiss="modal">Continue</button>
                </div>
            </div>
        </div>
    </div>
    <button data-bs-toggle="modal" data-bs-target="#success" id="successBtn" hidden></button>
    <script>
        document.getElementById('successBtn').click();
    </script>
@endif



<script>
    function showInfo() {
        const btn = document.getElementById('collapseBtn');
        btn.textContent = (btn.textContent == 'Show More Info' ? 'Hide Info' : 'Show More Info');
    }
    let emails = [];
</script>

@foreach($clients as $client)
<script>
    emails.push('{{$client->email}}');
</script>
@endforeach
<script>
    function validate(element, submit, form) {
        const error = document.getElementById(`error${element}`);
        const input = document.getElementById(element);
        const submitBtn = document.getElementById(submit);
        const errors = document.querySelectorAll(`#${form} .error`);

        if (element == 'contact') {
            if(input.value.length > 0){
                const pattern = /(09)([0-9]{9})/;
    
                if (!pattern.test(input.value)) {
                    error.textContent = 'Invalid format';
                } else {
                    error.textContent = '';
                }
            }else{
                error.textContent = '';
            }
        }else if(element == 'lotNum' || element == 'lotArea'){
            if(input.value.length > 0){
                let pattern = /^\d+$/;
    
                if(!pattern.test(input.value)){
                    error.textContent = "Invalid format";
                }else{
                    error.textContent = "";
                }
            }else{
                error.textContent = "";
            }
        }else if(element == 'email'){
        }else if(element == 'surNum'){
            if(input.value.length > 0){
                let pattern = /^[0-9]{2}(-)[0-9]{6}$/;
    
                if(!pattern.test(input.value)){
                    error.textContent = "Invalid format";
                }else{
                    error.textContent = "";
                }
            }else{
                error.textContent = "";
            }
        }else{
            if (input.value === '' || input.value == null) {
                error.textContent = 'This field is required';
            } else {
                error.textContent = '';
            }
        }

        let exist = false;
        for(let i = 0;i < errors.length;i++){   
            if(errors[i].textContent !== '')
                exist = true;
        }

        if(exist){
            submitBtn.disabled = true;
        }else{
            submitBtn.disabled = false;
        }
    }



    function checkSubmit(submit, form){
        const btn = document.getElementById(submit);
        const reqInputs = document.querySelectorAll(`#${form} .required`);
        console.log(reqInputs);
        
        let blank = false;
        for(let i = 0;i < reqInputs.length;i++){
            if(reqInputs[i].value === '' || reqInputs[i].value == null){
                blank = true;
                document.getElementById(`error${reqInputs[i].id}`).textContent = 'This field is required';
            }
        }

        if(blank){
            btn.disabled = true;
        }else{
            btn.disabled = false;
            document.getElementById(`${submit}Btn`).click();
        }
        
    }
</script>

@endif
@endsection