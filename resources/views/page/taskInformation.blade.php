@if (Auth::guest()) {{--if user is guest, it will change the login, register and logo direct link--}}
@else
@extends('layouts.app')
@extends('layouts.layout')

@section('content')

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

    <div class="navigation">
        <ul>
            <li><a href="{{ url('/home') }}">See Dashboard</a></li>

            <li><a href="{{ url('/addEvents-tasks') }}">Add Event</a></li>

            <li><a href="{{ url('/events-tasks') }}">Upcoming Events</a></li>

            <li><a href="{{ url('/addTimetable') }}">Add Timetable</a></li>

            <li><a href="{{ url('/information') }}">Information</a>
        </ul>
    </div>

    @if(Session('addSuccess'))
        <div class="alert alert-success">
            {{Session('addSuccess')}}
        </div>
    @endif

    @if(Session('updateSuccess'))
        <div class="alert alert-success">
            {{Session('updateSuccess')}}
        </div>
    @endif

    @if(Session('deleteSuccess'))
        <div class="alert alert-danger">
            {{Session('deleteSuccess')}}
        </div>
    @endif

<div class="container">
    <div class="col-md-8 col-md-offset-2 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">Search:</div>
            <div class="panel-body">
                <form method="post" action="/events-tasks/search" role="search">
                {{csrf_field()}}
                <div class="col-md-6 col-md-offset-3 col-xs-10" align="center">
                    <input class="typeahead" type="text" name="task_name" placeholder="Enter Keywords" required>
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
                </form>

                <br>

                <div class="col-md-12 col-xs-10" align="center">
                    @if(isset($result))
                        @if(count ($result)== 0)
                             <p>No results found</p>
                        @elseif (count ($result) >= 1)

                        @foreach ($result as $events)
                            <a href="/events-tasks/{{$events->id}}/edit">{{$events->task_name}}</a><br>
                        @endforeach
                    <p>Total Results:{{count($result)}}</p>
                        @endif
                     @endif

                    {{--@if(count($errors))--}}
                     {{--<p>--}}
                        {{--@foreach($errors->all() as $error)--}}
                            {{--{{$error}}--}}
                        {{--@endforeach--}}
                     {{--</p>--}}
                    {{--@endif--}}
                </div>
            </div>
        </div>
    </div>
    </div>

<div class="container">
    <div class="col-md-8 col-md-offset-2 col-xs-12">
        <div class="panel panel-default">
        <div class="panel-heading">Upcomming Events:</div>
            <div class="panel-body">
                <div class="row col-md-offset-1 col-xs-offset-1 col-sm-offset-1">
                    @foreach($tasks as $events)
                        <div class="tasksBox col-md-5 col-xs-10 col-sm-10">
                             Name: <a method="post" href="/events-tasks/{{$events->id}}/edit">{{$events->task_name}}</a><br>
                             Description: {{$events->description}}<br>
                             Date: {{$events->due_date}}
                        </div>
                    @endforeach
                </div>
                </div>
            </div>
        </div>
      </div>

    <div class="container">
        <div class="col-md-8 col-md-offset-2 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">Lessons:</div>
                <div class="panel-body">
                    <div class="row col-md-offset-1 col-xs-offset-1 col-sm-offset-1">
                        @foreach($timetable as $lesson)
                            <div class="timetableBox col-md-5 col-xs-10 col-sm-10">
                                Module: <a method="post" href="/timetable/{{$lesson->id}}/edit">{{$lesson->module}}</a><br>
                                Tutor: {{$lesson->lecturer_name}}<br>
                                Location: {{$lesson->location}}<br>
                                Start time: {{$lesson->time}}<br>
                                End time: {{$lesson->finish}}<br>
                            </div>
                         @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--<script type="text/javascript">--}}
        {{--var path = "{{ route('autocomplete') }}";--}}
        {{--$('input.typeahead').typeahead({--}}
            {{--source:  function (query, process) {--}}
                {{--return $.get(path, { query: query }, function (data) {--}}
                    {{--return process(data);--}}
                {{--});--}}
            {{--}--}}
        {{--});--}}
    {{--</script>--}}


@endsection
@endif