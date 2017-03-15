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

    <div class="col-md-6 col-md-offset-3 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">Update My Details</div>
            <div class="panel-body">

              @if(count($errors))
                  <ul>
                      @foreach($errors->all() as $error)
                      {{$error}}
                          @endforeach
                  </ul>
              @endif

                    <form action="/profile/upload/{{$user->id}}" method="POST" enctype="multipart/form-data">
                      {{csrf_field()}}
                    <div class="form-group">
                        <label name="profile_picture" class="col-md-2 col-md-offset-1 control-label">Image</label>

                        <div class="col-md-7">
                            <img id="profile_picture" class="form-control" name="image"
                             style="width:150px;height:150px;" src="/img/{{$user->profile_picture}}">
                            <input type="file" name="profile_picture">
                            <input type="submit" value="Upload Image" name="submit">
                            <br></br>
                        </div>
                    </div>
                  </form>


                <form method="post" action="/profile/update/{{$user->id}}">
                      {{csrf_field()}}
                    <div class="form-group">
                        <label name="first_name" class="col-md-2 col-md-offset-1 control-label">First name</label>

                        <div class="col-md-7">
                            <textarea id="first_name" class="form-control" name="first_name"required>{{$user->first_name}}</textarea>
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="last_name" class="col-md-2 col-md-offset-1 control-label">Last name</label>

                        <div class="col-md-7">
                            <textarea id="last_name" class="form-control" name="last_name"required>{{$user->last_name}}</textarea>
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="email" class="col-md-2 col-md-offset-1 control-label">Email</label>

                        <div class="col-md-7">
                            <textarea id="email" class="form-control" name="email"required>{{$user->email}}</textarea>
                            <br>
                        </div>
                    </div>


                    <!-- <div class="form-group">
                        <label name="password" class="col-md-2 col-md-offset-1 control-label">Password</label>

                        <div class="col-md-7">
                            <input id="password" type="password" class="form-control" name="password"required>
                            <br>
                        </div>
                    </div> -->


                     <div class="form-group">
                        <label name="university" class="col-md-2 col-md-offset-1 control-label">University</label>

                        <div class="col-md-7">
                            <textarea id="university" class="form-control" name="university"required>{{$user->university}}</textarea>
                            <br>
                        </div>
                    </div>

                        <div class="col-md-4 col-md-offset-5">
                            <button type="Add" class="btn btn-primary">Update</button>
                            <br>
                        </div>
                </form>

                  <form method="post" action="/profile/delete/{{$user->id}}">
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
