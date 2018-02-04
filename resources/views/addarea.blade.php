@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><b>Add an Area</b></div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="/add_area">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Area</label>

                                <div class="col-md-6">
                                    <input id="areaName" type="text" class="form-control" name="areaName" value="{{ old('areaName') }}" required autofocus>

                                    @if ($errors->has('areaName'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('areaName') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>




                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Collector Id</label>

                                <div class="col-md-6">
                                    <input id="collectorId" type="text" class="form-control" name="collectorId" value="{{ old('collectorId') }}" required autofocus>

                                    @if ($errors->has('collectorId'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('collectorId') }}</strong>
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
