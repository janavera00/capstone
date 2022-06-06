@extends('layouts.app')

@section('content')
    
    <div class="container-fluid overflow-auto" style="height: calc(100vh - 75px);">
        
        <div class="row justify-content-between mt-3">
            <div class="col">
                <div class="card mx-3">
                    <div class="card-header bg-dark">
                        <h1 class="text-center mb-0 text-white">Clients</h1>
                    </div>
                    
                    <div class="card-body row overflow-auto" style="height: 400px;">
                        
                        @foreach($clients as $client)
                        
                        <div class="col-4">
                            <a href="{{ url('projects/'.$client->id) }}" class="text-decoration-none text-black">
                                <div class="card text-center mx-2 my-2" style="height: 180px;">
                                    <div class="card-body">
                                        <img src="{{ asset('images/users/'.$client->image) }}" height="80px" class="rounded-pill border">
                                    </div>
                                    <div class="card-header">{{ $client->name }}</div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
            
            
            <div class="col">
                <div class="card mx-3">
                    <div class="card-header bg-dark">
                        <h1 class="text-center mb-0 text-white">Projects</h1>
                    </div>
                    <div class="card-body overflow-auto" style="height: 400px;">
    
                        @foreach($projects as $project)
                        <a href="{{ url('projectContent/'.$project->id) }}" class="text-decoration-none text-black">
                            <div class="card border-primary text-center mx-auto my-3" style="width: 400px;">
                                <div class="card-header p-1 bg-3 text-white">{{ ($project->survey_number)?$project->survey_number:'' }}</div>
                                <div class="card-body py-1 text-start">
                                    <strong class="mb-0">{{ $project->client->name }}</strong>
                                    <p class="mb-0">{{ $project->location }}</p>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>


            <div class="col">
                <div class="card mx-3">
                    <div class="card-header bg-dark">
                        <h1 class="text-center mb-0 text-white">Tasks</h1>
                    </div>
                    <div class="card-body d-flex flex-column overflow-auto" style="height: 400px;">
                        
                        @foreach($tasks as $task)
                        <a href="{{ url('task/'.$task->id.'/project') }}" class="mx-auto btn btn-{{($task->status == 'Overdue')?'danger':'primary'}} text-start mt-3" style="width: 300px;">
                            @php
                            $time = explode(':', $task->time);
                            $date = explode('-', $task->date);
                            @endphp
                            <strong class="mb-0">{{ date("l, F j | g:i a", mktime($time[0],$time[1], 0, $date[1], $date[2], $date[0])) }}</strong>
                            <p class="mb-0">{{ $task->task }}</p>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection