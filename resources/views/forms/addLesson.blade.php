@extends('layouts.app')
@extends('layouts.layout')

@section('content')

    <div class="navigation">
        <ul>
            <li><a href="{{ url('/home') }}">See Dashboard</a></li>

            <li><a href="{{ url('/addEvents-tasks') }}">Add Events</a></li>

            <li><a href="{{ url('/events-tasks') }}">Upcoming Events</a></li>

            <li><a href="{{ url('/addTimetable') }}">Add Timetables</a></li>

            <li><a href="{{ url('/Help') }}">Information</a>
        </ul>
    </div>


    <div class="col-md-6 col-md-offset-3 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">New Lesson</div>
            <div class="panel-body">

                <form method="post" action="/newTimetable">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label name="title" class="col-md-2 col-md-offset-1 control-label">Module:</label>

                        <div class="col-md-7">
                            <input id="module" class="form-control" name="module" value="{{ old('module') }}" required>
                            @if ($errors->has('module'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('module') }}</strong>
                                </span>
                            @endif
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="name" class="col-md-2 col-md-offset-1 control-label">Tutor:</label>

                        <div class="col-md-7">
                            <input id="name" class="form-control" name="lecturer_name" value="{{ old('lecturer_name') }}"  required>
                            @if ($errors->has('lecturer_name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('lecturer_name') }}</strong>
                                </span>
                            @endif
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="where" class="col-md-2 col-md-offset-1 control-label">Location:</label>

                        <div class="col-md-7">
                            <input id="location" class="form-control" name="location" value="{{ old('location') }}"  required>
                            @if ($errors->has('location'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                </span>
                            @endif
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-md-offset-1 control-label">Time (HH:MM):</label>
                        <div class="form-group col-md-8">
                            <input name="time" type="text" value="{{ old('time') }}" required>
                            @if ($errors->has('time'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('time') }}</strong>
                                </span>
                            @endif
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-md-offset-1 control-label">Finish (HH:MM):</label>
                        <div class=" form-group col-md-8">
                            <input name="finish" type="text" value="{{ old('finish') }}" required>
                            @if ($errors->has('finish'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('finish') }}</strong>
                                </span>
                            @endif
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-md-offset-1 control-label">Date (YYYY-MM-DD):</label>
                        <div class="form-group col-md-8">
                            <input name="date" type="text" value="{{ old('date') }}" required>
                            @if ($errors->has('date'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
                                </span>
                            @endif
                            <br>
                        </div>
                    </div>

                    <div class="col-md-4 col-md-offset-5">
                        <button type="Add" class="btn btn-primary">Add</button>
                        <br>
                    </div>

                </form>
            </div>
        </div>
    </div>
    </div>


@endsection