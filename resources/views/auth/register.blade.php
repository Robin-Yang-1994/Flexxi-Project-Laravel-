@extends('layouts.app')
@extends('layouts.layout')
@section('content')
    <br>

    @if(Session('deleteSuccess'))
        <div class="alert alert-danger">
            {{Session('deleteSuccess')}}
        </div>
    @endif

    <br>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <img class="reglogo" src="{{asset('images/Clock.jpg')}}" height="500px" width="500px"/>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal regform" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="university" class="col-md-4 control-label">University</label>

                            <div class="col-md-6">
                                <input id="university" type="text" class="form-control" name="university" value="{{ old('university') }}" required>

                             @if ($errors->has('university'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('university') }}</strong>
                                    </span>
                            @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-4 control-label">DOB (YYYY-MM-DD)</label>
                               <div class="col-md-6">
                                    <input id="dob" name="dob" type="text" class="form-control" value="{{ old('dob') }}"  required>
                               @if ($errors->has('dob'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                               @endif
                        </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 control-label">
                                <div class="col-md-8">
                                Male: <input name="gender"  type="radio" value="male">
                                Female: <input name="gender" type="radio" value="female">
                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                            </div></div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-5">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
