@extends('layouts.app')
@extends('layouts.layout')

@section('content')

    <div class="col-md-6 col-md-offset-3 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">Update Tasks</div>
            <div class="panel-body">

                @if(count($errors))
                    <ul>
                        @foreach($errors->all() as $error)
                            {{$error}}
                        @endforeach
                    </ul>
                @endif

                <form method="post" action="/updateEvents-tasks/{{$events->id}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label name="title" class="col-md-2 col-md-offset-1 control-label">Name:</label>

                        <div class="col-md- 7">
                            <textarea id="name" class="form-control" name="task_name" required>{{$events->task_name}}</textarea>
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="info" class="col-md-2 col-md-offset-1 control-label">Description:</label>

                        <div class="col-md-7">
                            <textarea id="description" class="form-control" name="description"required>{{$events->description}}</textarea>
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 col-md-offset-1 control-label">Date (YYYY-MM-DD):</label>
                        <div class="form-group col-md-5">
                            <textarea name="due_date" type="text">{{$events->due_date}}</textarea>
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
                     <button type="Add" class="btn btn-primary">Delete</button>
                    <br>
                    </div>
                </form>

            </div>
        </div>
    </div>
    </div>

@endsection