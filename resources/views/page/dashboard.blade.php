@extends('layouts.app')
@extends('layouts.layout')
@extends('layouts.calenderStyle')

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

    @if(Session('success'))
        <div class="alert alert-success">
            {{Session('success')}}
        </div>
    @endif

    @if(Session('diarySuccess'))
        <div class="alert alert-success">
            {{Session('diarySuccess')}}
        </div>
    @endif

    <div class="col-md-12 col-xs-12">
    @php$calendar = new \App\Http\Controllers\TimetableController();

    echo $calendar->show();
    @endphp
    </div>

    <br>

    <div class="col-md-12 col-xs-12">
        <div class="diaryDiv panel panel-default">
            <div class="panel-heading">Diary</div>
            <div class="panel-body">
                    <div class="col-md-12">
                        @foreach($diary as $diaries)
                            <form method="post" action="/saveNotes/{{$diaries->id}}">
                                <textarea id="notes" class="form-control" name="notes"
                                          placeholder="Enter your notes here">{{$diaries->notes}}</textarea>
                        @endforeach
                    {{csrf_field()}}
                                <hr>
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
