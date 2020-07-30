@extends('layouts.main')

@section('title','Tasks Home')

@section('content')
<nav class="navbar navbar-light bg-light">
  <a href="{{ route('task.create') }}" class="btn btn-block btn-success" mt-4>Create Task</a>
 
</nav>

@foreach($tasks as $task)


<div class="card" style="width: 18rem;">
  <img src="034.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">{{ $task->name }}</h5>
    <p class="card-text">{{ $task->description }}</p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><small>{{ $task->created_at }}</small></li>
    <li class="list-group-item">
        <h4>Due Date: <small>{{ $task->due_date }}</small></h4></li>
    
  </ul>
  <div class="card-body">
    {!! Form::open(['route' => [ 'task.destroy' , $task->id] ,'method'=>'DELETE']) !!} 
        <button type="submit" class="btn btn-sm btn-danger">DeLete</button>
        <a href="{{ route('task.edit', $task->id) }}" class="btn btn-sm btn-primary">Edit</a>
        {!! Form::close() !!}
  </div>
</div>
<br>
@endforeach
@if($tasks->count()==0)

<div class="lead alert alert-danger "><h3 class="text-center">There are No tasks list , Why don't Create One!</div></h3>
@endif
@endsection