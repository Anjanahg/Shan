@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><b>Add an Employee</b></div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="/add_emp">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Full Name</label>

                                <div class="col-md-6">
                                    <input id="fullname" type="text" class="form-control" name="fullname" value="{{ old('fullname') }}" required autofocus>

                                    @if ($errors->has('fullname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('fullname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>




                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Collector Name</label>

                                <div class="col-md-6">
                                    <input id="collectorname" type="text" class="form-control" name="collectorname" value="{{ old('collectorname') }}" required autofocus>

                                    @if ($errors->has('collectorname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('collectorname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                                <label for="telephone" class="col-md-4 control-label">Telephone No</label>

                                <div class="col-md-6">
                                    <input id="telephone" type="text" class="form-control" name="telephone" value="{{ old('telephone') }}" required autofocus>

                                    @if ($errors->has('telephone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('telephone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Area Id</label>

                                <div class="col-md-6">
                                    <input id="areaId" type="text" class="form-control" name="areaId" value="{{ old('areaId') }}" required autofocus>

                                    @if ($errors->has('areaId'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('areaId') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="text" class="form-control" name="password" value="{{ old('password') }}" required autofocus>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Add
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
