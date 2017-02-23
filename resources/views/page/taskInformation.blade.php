@extends('layouts.app')
@extends('layouts.layout')

@section('content')

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

    <form method="post" action="/events-tasks/search" role="search">
        {{csrf_field()}}
        Search: <br><input class="typeahead" style="margin:0px auto;width:300px;" type="text" name="task_name">
        <button type="submit" class="btn btn-primary">Search</button>
        <br>
    </form>

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

    <p>Upcomming:</p>
    @if(isset($tasks))
    @foreach($tasks as $events)
        Name: <a method="post" href="/events-tasks/{{$events->id}}/edit">{{$events->task_name}}</a><br>
        Date: {{$events->due_date}}
        <br></br>
    @endforeach
    @endif


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
