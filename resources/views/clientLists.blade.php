@extends('layouts.app')

@section('content')

<div class="container text-white bg-2 mt-5 rounded" style="height: 80vh;">
    <div class="d-flex justify-content-between p-3">
        <!-- buttons -->
        <div class="my-auto">
            <button data-bs-toggle="modal" data-bs-target="#addClient" id="addProjectBtn" class="btn bg-3 text-white">Add Client</button>
        </div>

        <!-- search box -->
        <form action="{{ url('search') }}" method="post">
            @csrf
            <div class="my-auto w-100 d-flex ms-auto">
                <!-- <input type="submit" value="Search" class="btn bg-3 text-white"> -->
                <button class="btn btn-primary" style="width: fit-content;">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <input type="text" name="search" id="search" class="form-control mx-2" autocomplete="off">
                <a href="{{ url('clients') }}" class="btn btn-danger" style="width: fit-content;">
                    <i class="fa-solid fa-arrows-rotate"></i>
                </a>
            </div>
        </form>
    </div>

    <div class="container border rounded mt-2 overflow-auto" style="height: 70vh;">

        @if(isset($clients))
        <h1 class="text-center mt-2">Clients List</h1>
        <hr class="w-75 mx-auto">
        <!-- Clients List -->
        <div class="row">
            @foreach($clients as $client)
            <div class="col-2">
                <div class="card" onclick="location.href='projects/{{$client->id}}'" style="cursor: pointer;">
                    <div class="card-body">
                        <div class="w-50 m-auto">
                            <img src="{{asset('images/users/'.$client->image)}}" alt="" class="w-100 rounded-circle border">
                        </div>
                    </div>
                    <div class="card-footer">
                        <h4 class="text-black text-center">{{ $client->name }}</h4>

                        <p class=" border-top pt-2 mb-0 text-black text-center">{{ $client->address }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @if(isset($projects))
        <h1 class="text-center mt-2">Projects List</h1>
        <hr class="w-75 mx-auto">
        <!-- Projects List -->
        <div class="row">
            @foreach($projects as $project)
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
            @endforeach
        </div>
        @endif
    </div>

</div>



<!-- Modal for adding client -->
<form action="{{ url('client/create') }}" method="post" id="addClientForm" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="addClient">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header text-white bg-1">
                    <h2 class="modal-title">Add new client</h2>
                </div>

                <div class="modal-body overflow-auto" style="height: 60vh;">
                    <div class="mt-2">
                        <label for="name">*Name:</label>
                        <input type="text" name="name" id="name" class="form-control required" onfocusout="validate('name', 'Add')" value="{{ old('name') }}" autocomplete="off">
                        <p class="text-danger error" id="errorname"></p>
                    </div>
                    <div class="mt-2">
                        <label for="address">Home address:</label>
                        <input type="text" name="address" id="address" class="form-control" autocomplete="off" value="{{ old('address') }}">
                    </div>
                    <div class="mt-2">
                        <label for="contact">Contact number:</label>
                        <div class="d-flex">
                            <p class="p-2">+63</p>
                            <input type="text" name="contact" id="contact" class="form-control" onfocusout="validate('contact', 'Add')" maxlength="10" style="height: 2.5rem; width: 90vw;" autocomplete="off" value="{{ old('contact') }}">
                        </div>
                        <p class="text-danger error" id="errorcontact"></p>
                    </div>
                    <div class="mt-2">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" onfocusout="validate('email', 'Add')" autocomplete="off" value="{{ old('email') }}">
                        <p class="text-danger error" id="erroremail"></p>
                    </div>
                    <div class="mt-2">
                        <label for="username">*Username:</label>
                        <input type="text" name="username" id="username" class="form-control required" onfocusout="validate('username', 'Add')" autocomplete="off" value="{{ old('username') }}">
                        <p class="text-danger error" id="errorusername"></p>
                    </div>
                    <div class="mt-2">
                        <label for="img">Profile image:</label>
                        <input type="file" name="img" id="img" class="form-control" accept="image/*" value="{{ old('img') }}">
                        @error('img')
                        <p class="text-danger">*{{$message}}</p>
                        @enderror
                    </div>

                </div>
                <div class="modal-footer bg-secondary">
                    <a class="btn btn-danger" style="width: 200px;" data-bs-dismiss="modal">Cancel</a>
                    <button class="btn btn-primary" style="width: 200px;" onclick="checkSubmit('submitAdd')" id="submitAdd">Submit</button>
                    <input type="submit" id="submitAddBtn" hidden>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="duplicateModal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header text-danger bg-1">
                    <h2 class="modal-title">Name already exist in the records</h2>
                </div>

                <div class="modal-body overflow-auto" style="height: 60vh;">
                    <div class="mt-2">
                        <label for="duplicate">please enter your password to confirm:</label>
                        <input type="password" name="duplicate" id="duplicate" class="form-control" onfocusout="validate('duplicate', 'Confirm')" autocomplete="off">
                        <p class="text-danger error" id="errorduplicate"></p>
                    </div>

                </div>
                <div class="modal-footer bg-secondary">
                    <a class="btn btn-success" style="width: 200px;" data-bs-toggle="modal" href="#addClient">Change</a>
                    <button class="btn btn-primary" style="width: 200px;" onclick="checkSubmit('submitConfirm')" id="submitConfirm">Confirm</button>
                    <input type="submit" id="submitConfirmBtn" hidden>
                </div>

            </div>
        </div>
    </div>

</form>
<button data-bs-toggle="modal" data-bs-target="#duplicateModal" id="duplicateBtn" hidden></button>


<script>
    let emails = [];
    let usernames = [];
</script>

@foreach($clients as $client)
<script>
    emails.push('{{$client->email}}');
    usernames.push('{{$client->username}}');
</script>
@endforeach
<script>
    function validate(element, submit) {
        const error = document.getElementById(`error${element}`);
        const input = document.getElementById(element);
        const submitBtn = document.getElementById(`submit${submit}`);
        const errors = document.getElementsByClassName('error');

        if (element == 'contact') {
            if(input.value.length > 0){
                const pattern = /(9)([0-9]{9})/;
    
                if (!pattern.test(input.value)) {
                    error.textContent = 'Invalid format';
                } else {
                    error.textContent = '';
                }
            }else{
                error.textContent = '';
            }
        }else if(element == 'email'){
            
            if(input.value.length > 0){
                let exist = false;
                let pattern = /^([a-z\d\.-_]+)@([a-z\d-_]+)\.([a-z]{2,8})(\.[a-z]{2,8})?$/;
                
                for(let i = 0;i < emails.length;i++){
                    
                    if(emails[i] === input.value){
                        exist = true;
                    }
                }

                if(!pattern.test(input.value)){
                    error.textContent = "Invalid format";
                }else if(exist){
                    error.textContent = "This email is already registered";
                }else{
                    error.textContent = "";
                }
            }else{
                error.textContent = "";
            }
        }else if(element == 'username'){
            if(input.value.length > 0){
                let exist = false;
               
                for(let i = 0;i < usernames.length;i++){
                    
                    if(usernames[i] === input.value){
                        exist = true;
                    }
                }

                if(exist){
                    error.textContent = "This username is already taken";
                }else{
                    error.textContent = "";
                }
            }else{
                error.textContent = "";
            }
            
        }else if(element == 'duplicate'){
            console.log(input);
            if (input.value === '' || input.value == null) {
                error.textContent = 'This field is required';
            } else {
                error.textContent = '';
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





    function checkSubmit(submit){
        const btn = document.getElementById(submit);
        if(submit == 'submitAdd'){
            const reqInputs = document.querySelectorAll('#addClientForm .required');

            let blank = false;
            for(let i = 0;i < reqInputs.length;i++){
                if(reqInputs[i].value === '' || reqInputs[i].value == null){
                    blank = true;
                }
            }

            if(blank){
                btn.disabled = true;
            }else{
                btn.disabled = false;
                document.getElementById('submitAddBtn').click();
            }
        }else{
            const reqInputs = document.querySelector('#duplicate');

            if(reqInputs.value === '' || reqInputs.value == null){
                btn.disabled = true;
            }else{
                btn.disabled = false;
                document.getElementById('submitConfirmBtn').click();
            }
        }
    }
</script>


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


@if($errors->any())
<script>
    document.getElementById('addProjectBtn').click();
</script>
@endif
@error('duplicate')
<script>
    document.getElementById('duplicateBtn').click();
</script>
@enderror

@endsection