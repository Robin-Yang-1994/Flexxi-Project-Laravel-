@extends('layouts.app')
@extends('layouts.layout')

@section('content')


    <p>Tasks</p>
    @foreach($tasks as $events)
        <a method="post" href="/events-tasks/{{$events->id}}/edit">Name: {{$events->task_name}}</a><br>
    @endforeach


@endsection
