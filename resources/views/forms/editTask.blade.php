@if (Auth::guest()) {{--if user is guest, it will change the login, register and logo direct link--}}
@else

@extends('layouts.app')
@extends('layouts.layout')

@section('content')

    <div class="navigation">
        <ul>
            <li><a href="{{ url('/home') }}">See Dashboard</a></li>

            <li><a href="{{ url('/addEvents-tasks') }}">Add Event</a></li>

            <li><a href="{{ url('/events-tasks') }}">Upcoming Events</a></li>

            <li><a href="{{ url('/addTimetable') }}">Add Timetable</a></li>

            <li><a href="{{ url('/information') }}">Information</a>
        </ul>
    </div>

    <div class="col-md-6 col-md-offset-3 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">Update Tasks</div>
            <div class="panel-body">

                <form method="post" action="/updateEvents-tasks/{{$events->id}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label name="title" class="col-md-2 col-md-offset-1 control-label">Name:</label>

                        <div class="col-md-7">
                            <textarea id="name" class="form-control" name="task_name" required>{{$events->task_name}}</textarea>
                            @if ($errors->has('task_name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('task_name') }}</strong>
                                </span>
                            @endif
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="info" class="col-md-2 col-md-offset-1 control-label">Description:</label>

                        <div class="col-md-7">
                            <textarea id="description" class="form-control" name="description"required>{{$events->description}}</textarea>
                            @if ($errors->has('description'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 col-md-offset-1 control-label">Date (YYYY-MM-DD):</label>
                        <div class="form-group col-md-5">
                            <textarea name="due_date" type="text" required>{{$events->due_date}}</textarea>
                            @if ($errors->has('due_date'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('due_date') }}</strong>
                                </span>
                            @endif
                            <br>
                        </div>
                    </div>

                    <div class="col-md-4 col-md-offset-5">
                        <button type="Add" class="btn btn-primary">Update</button>
                        <br>
                    </div>
                </form>

                <form method="post" action="/deleteEvents-tasks/{{$events->id}}">
                    {{csrf_field()}}
                    <div class="col-md-4 col-md-offset-5">
                    <br>
                     <button type="Add" onclick="return confirm('Are you sure?')" class="btn btn-primary">Delete</button>
                    <br>
                    </div>
                </form>

            </div>
        </div>
    </div>
    </div>

@endsection
@endif