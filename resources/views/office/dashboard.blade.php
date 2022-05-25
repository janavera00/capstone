@extends('layouts.app')

@section('content')
    
    <div class="container">
        <div class="display-1">Hello World</div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSomething">Do Someting</button>

        <div class="modal" id="addSomething">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-1 text-white">
                        <h1>Add Something</h1>
                    </div>

                    <div class="modal-body">
                        <form action="" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="address" class="form-label">Address</label>
                                <textarea name="address" id="address" cols="30" rows="1" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAnother">Add Something</button>
                                <!-- <input type="submit" value="Add Something" class="btn btn-primary"> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="addAnother">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-1 text-white">
                        <h1>Add Another</h1>
                    </div>

                    <div class="modal-body">
                        <form action="" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="nickname" class="form-label">Nickname:</label>
                                <input type="text" name="nickname" id="nickname" class="form-control">
                            </div>
                            <div class="form-group mt-2">
                                <input type="submit" value="Add" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection