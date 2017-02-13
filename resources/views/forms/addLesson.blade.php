@extends('layouts.app')
@extends('layouts.layout')

@section('content')


    <div class="col-md-6 col-md-offset-3 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">New Lesson</div>
            <div class="panel-body">

                @if(count($errors))
                    <ul>
                        @foreach($errors->all() as $error)
                            {{$error}}
                        @endforeach
                    </ul>
                @endif

                <form method="post" action="/newTimetable">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label name="title" class="col-md-2 col-md-offset-1 control-label">Module:</label>

                        <div class="col-md-7">
                            <input id="module" class="form-control" name="module" required>
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="name" class="col-md-2 col-md-offset-1 control-label">Tutor:</label>

                        <div class="col-md-7">
                            <input id="name" class="form-control" name="lecturer_name"required>
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="where" class="col-md-2 col-md-offset-1 control-label">Location:</label>

                        <div class="col-md-7">
                            <input id="location" class="form-control" name="location"required>
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-md-offset-1 control-label">Time (HH:MM):</label>
                        <div class="form-group col-md-8">
                            <input name="time" type="text">
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-md-offset-1 control-label">Finish (HH:MM):</label>
                        <div class=" form-group col-md-8">
                            <input name="finish" type="text">
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-md-offset-1 control-label">Date (YYYY-MM-DD):</label>
                        <div class="form-group col-md-8">
                            <input name="date" type="text">
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