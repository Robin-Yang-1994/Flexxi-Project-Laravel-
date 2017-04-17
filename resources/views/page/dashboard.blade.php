@extends('layouts.app')
@extends('layouts.layout')

@section('content')
    <div class="navigation">
        <ul>
            <li><a href="{{ url('/addEvents-tasks') }}">Add Event</a></li>

            <li><a href="{{ url('/events-tasks') }}">Upcoming Event</a></li>

            <li><a href="{{ url('#') }}">Change Event</a></li>

            <li><a href="{{ url('/addTimetable') }}">Add Timetable</a></li>
        </ul>
    </div>

    @if(Session('success'))
        <div class="alert alert-success">
            {{Session('success')}}
        </div>
    @endif

    <div class="col-md-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">Diary</div>
            <div class="panel-body">
                    <div class="col-md-12">
                        @foreach($diary as $diaries)
                            <form method="post" action="/saveNotes/{{$diaries->id}}">
                                <textarea id="notes" class="form-control" name="notes"
                                          placeholder="Enter your notes here">{{$diaries->notes}}</textarea>
                        @endforeach
                    {{csrf_field()}}
                            <button type="Add" class="form-control btn btn-primary">Save</button><br><br>
                            <button type="reset"class="form-control btn btn-primary"
                                    onclick="myFunction().reset()">Reset Diary To Previous Notes</button>
                            </form>
                    </div>
            </div>
        </div>
    </div>
    </div>

    <p>Lessons</p>
    @foreach($timetable as $lesson)
        Module: <a method="post" href="/timetable/{{$lesson->id}}/edit">{{$lesson->module}}</a><br>
        Tutor: {{$lesson->lecturer_name}}<br>
        Location: {{$lesson->location}}<br>
        Start time: {{$lesson->time}}<br>
        End time: {{$lesson->finish}}<br>
        Date {{$lesson->date}}<br>
    @endforeach


    <script>
        function myFunction() {
            document.getElementById("notes").reset();
        }
    </script>


@endsection
