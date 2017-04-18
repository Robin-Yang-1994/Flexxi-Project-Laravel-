@extends('layouts.app')
@extends('layouts.layout')

@section('content')

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

    <div class="navigation">
        <ul>
            <li><a href="{{ url('/addEvents-tasks') }}">Add Event</a></li>

            <li><a href="{{ url('/events-tasks') }}">Upcoming Event</a></li>

            <li><a href="{{ url('#') }}">Change Event</a></li>

            <li><a href="{{ url('/addTimetable') }}">Add Timetable</a></li>
        </ul>
    </div>

    <div class="col-md-8 col-md-offset-2 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">Search:</div>
            <div class="panel-body">
                <form method="post" action="/events-tasks/search" role="search">
                {{csrf_field()}}
                <div class="col-md-12 col-xs-10" align="center">
                    <input class="typeahead" type="text" name="task_name">
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

                    @if(count($errors))
                     <p>
                        @foreach($errors->all() as $error)
                            {{$error}}
                        @endforeach
                     </p>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-8 col-md-offset-2 col-xs-12">
        <div class="panel panel-default">
        <div class="panel-heading">Upcomming:</div>
            <div class="panel-body">
                    @foreach($tasks as $events)
                        <div class="tasksBox container col-md-5 col-md-offset-2 col-xs-8">
                             Name: <a method="post" href="/events-tasks/{{$events->id}}/edit">{{$events->task_name}}</a><br>
                             Description: {{$events->description}}<br>
                             Date: {{$events->due_date}}
                        </div>
                    @endforeach
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
