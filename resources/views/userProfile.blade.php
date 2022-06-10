@extends('layouts.app')

@section('content')

    <div class="container mt-5 border rounded p-3">
        <div class="row">
            <div class="col-2">
                <button class="w-100 mb-2 btn btn-success" onclick="showInfo('{{ Auth()->user()->id}}')">Edit Profile</button>
                <!-- <button class="w-100 my-2 btn btn-success" id="changePassBtn" data-bs-toggle="modal" data-bs-target="#changePass">Change Password</button> -->
                @if(Auth()->user()->role == 'Head of Office' || Auth()->user()->role == 'Secretary')
                    <button class="w-100 my-2 btn btn-primary" data-bs-toggle="modal" data-bs-target="#logs">View logs</button>
                    <button class="w-100 my-2 btn btn-primary" data-bs-toggle="modal" data-bs-target="#usersList">View Users</button>
                @endif
            </div>
            <div class="col-8 d-flex flex-column p-2">
                <img src="{{ asset('images/users/'.Auth()->user()->image) }}" style="width: 150px; height: 150px; overflow: hidden;" class="mx-auto rounded-circle border">
                <h1 class="mx-auto m-0">{{ Auth()->user()->name }}</h1>
                <h3 class="mx-auto mt-2 text-secondary">{{ Auth()->user()->username }}</h3>
                <h3 class="mx-auto">{{ Auth()->user()->role }}</h3>
                @if(Auth()->user()->email)
                <p class="mx-auto my-0">{{ Auth()->user()->email }}</p>
                @endif
                @if(Auth()->user()->contact)
                <p class="mx-auto my-0">{{ Auth()->user()->contact }}</p>
                @endif
                @if(Auth()->user()->address)
                <p class="mx-auto my-0">{{ Auth()->user()->address }}</p>
                @endif
                
            </div>
            <div class="col-2"></div>
        </div>
    </div>


<!-- -------------------------------------------------------------------------- -->


    <div class="modal" id="usersList">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-1"><h1 class="modal-title text-white">Users</h1></div>
                <div class="modal-body overflow-auto" style="height: 400px;">
                
                    
                    <table class="table table-striped table-bordered table-hover">
                        <tr class="text-center">
                            <th>Name</th>
                            <th>Address</th>
                            <th>Contact Number</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Username</th>
                        </tr>
                        <tbody>
                            @foreach($users as $user)
                            @if($user->role != 'Client' && $user->role != 'Head of Office')
                                <tr id="{{ 'user-'.$user->id}}" onclick="showInfo('{{ $user->id}}')" style="font-size: 0.8rem; cursor: pointer;">
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $user->contact }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>{{ $user->username }}</td>
                                </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                   

                </div>

                <div class="modal-footer bg-secondary">
                    <button data-bs-toggle="modal" data-bs-target="#addUser" id="addUserBtn" class="btn btn-primary">Add User</button>
                </div>
            </div>
        </div>
    </div>

    
   

    <!-- hidden Buttons -->
    <button data-bs-toggle="modal" data-bs-target="#showUser" id="showUserBtn" hidden></button>

    <div class="modal" id="addUser">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-1"><h1 class="modal-title text-white">Add new User</h1></div>
                <form action="../user/create" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body overflow-auto" style="height: 60vh;">
                        <div class="my-2">
                            <label for="name" class="form-label">*Name:</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                            @error('name')
                                <p class="text-danger">*{{$message}}</p>
                            @enderror
                        </div>
                        <div class="my-2">
                            <label for="address" class="form-label">Address:</label>
                            <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}">
                            @error('address')
                                <p class="text-danger">*{{$message}}</p>
                            @enderror
                        </div>
                        <div class="my-2">
                            <label for="contact" class="form-label">Contact:</label>
                            <input type="text" name="contact" id="contact" class="form-control" maxlength="11" value="{{ old('contact') }}">
                            @error('contact')
                                <p class="text-danger">*{{$message}}</p>
                            @enderror
                        </div>
                        <div class="my-2">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                            @error('email')
                                <p class="text-danger">*{{$message}}</p>
                            @enderror
                        </div>
                        <div class="my-2">
                            <label for="user" class="form-label">*Username:</label>
                            <input type="text" name="user" id="user" class="form-control" value="{{ old('user') }}">
                            @error('user')
                                <p class="text-danger">*{{$message}}</p>
                            @enderror
                        </div>
                        <div class="my-2">
                            <label for="pass" class="form-label">*Password:</label>
                            <input type="password" name="pass" id="pass" class="form-control">
                            @error('pass')
                                <p class="text-danger">*{{$message}}</p>
                            @enderror
                        </div>
                        <div class="my-2">
                            <label for="img" class="form-label">Photo:</label>
                            <input type="file" name="img" id="img" accept="image/*" class="form-control">
                            @error('img')
                                <p class="text-danger">*{{$message}}</p>
                            @enderror
                        </div>
                        <div class="my-2">
                            <label for="role" class="form-label">*Position:</label>
                            <select name="role" id="role" class="form-control">
                                <option selected hidden></option>
                                <option value="Secretary" {{(old('role') == 'Secretary')?'selected':''}}>Secretary</option>
                                <option value="Engineer" {{(old('role') == 'Engineer')?'selected':''}}>Engineer</option>
                                <option value="Surveyor" {{(old('role') == 'Surveyor')?'selected':''}}>Surveyor</option>
                            </select>
                            @error('role')
                                <p class="text-danger">*{{$message}}</p>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="modal-footer bg-secondary">
                        <button class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <input type="submit" value="Add" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if($errors->has('name') || $errors->has('address') || $errors->has('contact') || $errors->has('email') || $errors->has('user') || $errors->has('pass') || $errors->has('img') || $errors->has('role'))
    <script>
        document.getElementById('addUserBtn').click();
    </script>
    @endif



    @foreach($users as $user)
    <button data-bs-toggle="modal" data-bs-target="#showUser-{{$user->id}}" id="showUser-{{$user->id}}Btn" hidden></button>
    <div class="modal" id="showUser-{{$user->id}}">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-1"><h1 class="modal-title text-white">User</h1></div>
                <form action="{{ url('user/update/'.$user->id) }}" method="post">
                    @csrf
                    <div class="modal-body overflow-auto" style="height: 60vh;">
                        <div class="my-2">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" name="inputName" id="Uname" value="{{ $user->name }}" class="form-control">
                            @error('inputName')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="my-2">
                            <label for="address" class="form-label">Address:</label>
                            <input type="text" name="inputAddress" id="Uaddress" value="{{ $user->address }}" class="form-control">
                            @error('inputAddress')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="my-2">
                            <label for="contact" class="form-label">Contact:</label>
                            <input type="text" name="inputContact" id="Ucontact" value="{{ $user->contact }}" maxlength="11" class="form-control">
                            @error('inputContact')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="my-2">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" name="inputEmail" id="Uemail" value="{{ $user->email }}" class="form-control">
                            @error('inputEmail')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="my-2">
                            <label for="user" class="form-label">Username:</label>
                            <input type="text" name="inputUser" id="Uuser" value="{{ $user->username }}" class="form-control" disabled>
                            @error('inputUser')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="my-2">
                            <label for="role" class="form-label">Position:</label>
                            @if($user->role == "Head of Office")
                            <input type="text" class="form-control" value="{{ $user->role }}" disabled>
                            <input type="hidden" name="inputRole" value="{{ $user->role }}">
                            @else
                            @if(Auth()->user()->role == 'Head of Office')
                                <select name="inputRole" id="Urole" class="form-control">
                                    <option value="Secretary" {{ ($user->role == 'Secretary')?'selected':'' }}>Secretary</option>
                                    <option value="Engineer" {{ ($user->role == 'Engineer')?'selected':'' }}>Engineer</option>
                                    <option value="Surveyor" {{ ($user->role == 'Surveyor')?'selected':'' }}>Surveyor</option>
                                </select>
                                @else
                                <input type="text" class="form-control" value="{{ $user->role }}" disabled>
                                <input type="hidden" name="inputRole" value="{{ $user->role }}">
                                @endif
                            @endif
                            @error('inputRole')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer bg-secondary">
                        <input type="hidden" name="inputId" value="{{ $user->id }}">
                        <button class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <input type="submit" value="Add" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    @if($errors->has('inputName') || $errors->has('inputAddress') || $errors->has('inputContact') || $errors->has('inputEmail') || $errors->has('inputRole'))
    <script>
        var id = "showUser-{{old('inputId')}}Btn";
        document.getElementById(id).click();
    </script>
    @endif
    

    <div class="modal" id="changePass">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-1"><h1 class="modal-title text-white">Change Password</h1></div>
                <form action="{{ url('changePass') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="m-2 p-2 border rounded">
                            <label for="oldPassword">Current Password</label>
                            <input type="password" name="oldPassword" id="oldPassword" class="form-control">
                            @error('passFail')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            @error('oldPassword')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="m-2 p-2 border rounded">
                            <label for="newPassword">New Password</label>
                            <input type="password" name="newPassword" id="newPassword" class="form-control">
                            @error('newPassword')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer bg-secondary">
                        <a href="" data-bs-dismiss="modal" class="btn btn-danger">Cancel</a>
                        <input type="submit" value="Change" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if($errors->has('passFail') || $errors->has('oldPassword') || $errors->has('newPassword'))
        <script>
            document.getElementById('changePassBtn').click();
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


    <div class="modal" id="logs">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-1"><h1 class="modal-title text-white">User Log</h1></div>
                <div class="modal-body overflow-auto" style="height: 400px;">
                    <table class="table table-striped table-bordered">
                        <tr class="text-center">
                            <th>Actor</th>
                            <th>Target</th>
                            <th>Remarks</th>
                        </tr>
                        @foreach($logs->sortByDesc('created_at') as $log)
                            <tr style="font-size: .8rem;">
                                <td>{{ $log->userActor->role }}: {{ $log->userActor->name }}</td>
                                @if($log->user_id)
                                    <td>{{ $log->user->role }}: {{ $log->user->name }}</td>
                                @elseif($log->project_id)
                                    <td>Project: {{ ($log->project->survey_number)?$log->project->survey_number:sprintf('%05d', $log->project->id) }}</td>
                                @elseif($log->file_id)
                                    <td>File: {{ $log->file->title }}</td>
                                @elseif($log->task_id)
                                    <td>Task: {{ $log->task->task }}</td>
                                @endif

                                <td>{{ $log->remarks }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
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
        function showInfo(id){
            document.getElementById(`showUser-${id}Btn`).click();
        }
    </script>
    
    @if(count($users->where('role', '!=', 'Client')->where('role', '!=', 'Head of Office')) == 0)
        <script>
            document.getElementById('addUserBtn').click();
        </script>
    @endif
@endsection