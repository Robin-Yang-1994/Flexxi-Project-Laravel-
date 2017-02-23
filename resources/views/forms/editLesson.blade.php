@extends('layouts.app')
@extends('layouts.layout')

@section('content')

    <div class="col-md-6 col-md-offset-3 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">Update Timetable</div>
            <div class="panel-body">

                @if(count($errors))
                    <ul>
                        @foreach($errors->all() as $error)
                            {{$error}}
                        @endforeach
                    </ul>
                @endif

                <form method="post" action="/update-Timetable/{{$lesson->id}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label name="title" class="col-md-2 col-md-offset-1 control-label">Module:</label>

                        <div class="col-md-7">
                        <textarea id="module" class="form-control" name="module" required>{{$lesson->module}}</textarea>
                        <br>
                    </div>

                    <div class="form-group">
                        <label name="name" class="col-md-2 col-md-offset-1 control-label">Tutor:</label>

                        <div class="col-md-7">
                        <textarea id="name" class="form-control" name="lecturer_name" required>{{$lesson->lecturer_name}}</textarea>
                        <br>
                    </div>
                    </div>

                    <div class="form-group">
                        <label name="where" class="col-md-2 col-md-offset-1 control-label">Location:</label>

                        <div class="col-md-7">
                        <textarea id="location" class="form-control" name="location" required>{{$lesson->location}}</textarea>
                        <br>
                    </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-md-offset-1 control-label">Time (HH:MM):</label>
                        <div class="form-group col-md-8">
                            <textarea name="time" type="text">{{$lesson->time}}</textarea>
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-md-offset-1 control-label">Finish (HH:MM):</label>
                        <div class=" form-group col-md-8">
                            <textarea name="finish" type="text">{{$lesson->finish}}</textarea>
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-md-offset-1 control-label">Date (YYYY-MM-DD):</label>
                        <div class="form-group col-md-8">
                            <textarea name="date" type="text">{{$lesson->date}}</textarea>
                            <br>
                        </div>
                    </div>

                    <div class="col-md-4 col-md-offset-5">
                        <button type="Add" class="btn btn-primary">Update</button>
                        <br>
                    </div>
                </form>

                <form method="post" action="/delete-Timetable/{{$lesson->id}}">
                    {{csrf_field()}}
                    <div class="col-md-4 col-md-offset-5">
                        <br>
                        <button type="Add" class="btn btn-primary">Delete</button>
                        <br>
                    </div>
                </form>

            </div>
        </div>
    </div>
    </div>

@endsection