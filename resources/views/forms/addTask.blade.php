@extends('layouts.app')
@extends('layouts.layout')

@section('content')


    <div class="col-md-6 col-md-offset-3 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">New Tasks</div>
            <div class="panel-body">

                <form method="post" action="/addEvents-tasks/newEvents-tasks">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label name="title" class="col-md-2 col-md-offset-1 control-label">Name:</label>

                        <div class="col-md-7">
                            <input id="name" class="form-control" name="task_name" value="{{ old('task_name') }}" required>
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
                            <input id="description" class="form-control" name="description" value="{{ old('description') }}" required>
                            @if ($errors->has('description'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 col-md-offset-1 control-label">Due Date (YYYY-MM-DD):</label>
                        <div class="form-group col-md-5">
                            <input name="due_date" type="text" value="{{ old('due_date') }}" required>
                            @if ($errors->has('due_date'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('due_date') }}</strong>
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