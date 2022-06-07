@extends('layouts.app')

@section('content')

    <div class="container mt-3 border border-2 p-3">
        <div class="container">
            <button data-bs-toggle="modal" data-bs-target="#addUser" id="addUserBtn" class="btn btn-primary">Add User</button>
        </div>
        <div class="container mt-3">
            <table class="table table-striped table-bordered table-hover">
                <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Role</th>
                <th>Username</th>
            </tr>
            <tbody>
                @foreach($users as $user)
                    <tr id="{{ 'user-'.$user->id}}" onclick="showInfo('{{ $user->id}}')">
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->contact }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->username }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
                                <option value="Secretary">Secretary</option>
                                <option value="Engineer">Engineer</option>
                                <option value="Surveyor">Surveyor</option>
                            </select>
                            @error('role')
                                <p class="text-danger">*{{$message}}</p>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="modal-footer bg-secondary">
                        <button class="btn btn-danger" data-bs-dismiss="modal" style="width: 10rem;">Cancel</button>
                        <input type="submit" value="Add" class="btn btn-primary" style="width: 10rem;">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal" id="showUser">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-1"><h1 class="modal-title text-white">User</h1></div>
                <form action="" method="post">
                    @csrf
                    <div class="modal-body overflow-auto" style="height: 60vh;">
                        <div class="my-2">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" name="name" id="Uname" class="form-control">
                        </div>
                        <div class="my-2">
                            <label for="address" class="form-label">Address:</label>
                            <input type="text" name="address" id="Uaddress" class="form-control">
                        </div>
                        <div class="my-2">
                            <label for="contact" class="form-label">Contact:</label>
                            <input type="text" name="contact" id="Ucontact" class="form-control">
                        </div>
                        <div class="my-2">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" name="email" id="Uemail" class="form-control">
                        </div>
                        <div class="my-2">
                            <label for="user" class="form-label">Username:</label>
                            <input type="text" name="user" id="Uuser" class="form-control">
                        </div>
                        <div class="my-2">
                            <label for="role" class="form-label">Position:</label>
                            <select name="role" id="Urole" class="form-control">
                                <option value="Secretary">Secretary</option>
                                <option value="Engineer">Engineer</option>
                                <option value="Surveyor">Surveyor</option>
                            </select>
                        </div>
                        
                    </div>
                    <div class="modal-footer d-flex justify-content-around bg-secondary">
                        <button class="btn btn-danger" data-bs-dismiss="modal" style="width: 10rem;">Cancel</button>
                        <input type="submit" value="Add" class="btn btn-primary" style="width: 10rem;">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showInfo(id)
        {
            document.getElementById('showUserBtn').click();

            const nodes = document.getElementById(`user-${id}`).childNodes;
            document.getElementById('Uname').value = nodes[1].textContent;
            document.getElementById('Uaddress').value = nodes[3].textContent;
            document.getElementById('Ucontact').value = nodes[5].textContent;
            document.getElementById('Uemail').value = nodes[7].textContent;
            document.getElementById('Uuser').value = nodes[11].textContent;
            
            const selc = document.getElementById('Urole').childNodes;
            console.log(selc);
            for(let i = 0;i < selc.length;i++)
            {
                if(selc[i].textContent == nodes[9].textContent)
                    selc[i].selected = true;
            }
        }
    </script>

    @if($errors->any())
    <script>
        document.getElementById('addUserBtn').click();
    </script>
    @endif
@endsection