@extends('layouts.app')



@section('script')

    .panel-table .panel-body{
    padding:0;
    }

    .panel-table .panel-body .table-bordered{
    border-style: none;
    margin:0;
    }

    .panel-table .panel-body .table-bordered > thead > tr > th:first-of-type {
    text-align:center;
    width: 100px;
    }

    .panel-table .panel-body .table-bordered > thead > tr > th:last-of-type,
    .panel-table .panel-body .table-bordered > tbody > tr > td:last-of-type {
    border-right: 0px;
    }

    .panel-table .panel-body .table-bordered > thead > tr > th:first-of-type,
    .panel-table .panel-body .table-bordered > tbody > tr > td:first-of-type {
    border-left: 0px;
    }

    .panel-table .panel-body .table-bordered > tbody > tr:first-of-type > td{
    border-bottom: 0px;
    }

    .panel-table .panel-body .table-bordered > thead > tr:first-of-type > th{
    border-top: 0px;
    }

    .panel-table .panel-footer .pagination{
    margin:0;
    }

    /*
    used to vertically center elements, may need modification if you're not using default sizes.
    */
    .panel-table .panel-footer .col{
    line-height: 34px;
    height: 34px;
    }

    .panel-table .panel-heading .col h3{
    line-height: 30px;
    height: 30px;
    }

    .panel-table .panel-body .table-bordered > tbody > tr > td{
    line-height: 34px;
    }





    a.button {
    -webkit-appearance: button;
    -moz-appearance: button;
    appearance: button;

    text-decoration: none;
    color: initial;
    }
@endsection




@section('content')
    <h1><center><b></b></h1>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>

    <div class="container">
        <div class="row">


            <div class="col-md-10 col-md-offset-1">

                <div class="panel panel-default panel-table">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col col-xs-6">
                                <h3 class="panel-title"><b>Manage Points</b></h3>
                            </div>
                            <div class="col col-xs-6 text-right">


                                {{-- <button type="button" class="btn btn-sm btn-primary btn-create" >Create New</button>--}}
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">


                        <table class="table table-striped table-bordered table-list">
                            <thead>
                            <tr>
                                <th><em class="fa fa-cog"></em></th>
                                <th class="hidden-xs">ID</th>
                                <th>Category</th>
                                <th>Value</th>


                            </tr>
                            </thead>



                            <tbody>

                            <?php foreach($read as $data){ ?>

                            <tr>
                                <td align="center">
                                    <a href="{{URL::to('managePoints/update'.$data->id)}}" class="btn btn-default" ><em class="fa fa-pencil"></em></a>

                                </td>
                                {{--<td class="hidden-xs">1</td>--}}


                                <td>{{  $data->id }}</td>
                                <td>{{  $data->category}}</td>
                                <td>{{  $data->value }}</td>


                            </tr>

                            <?php } ?>

                            </tbody>
                        </table>




                    </div>
                    <div class="panel-footer">
                        <div class="row">

                            <div class="col col-xs-8">
                                <ul class="pagination hidden-xs pull-right">


                                </ul>
                                <ul class="pagination visible-xs pull-right">
                                    <li><a href="#">«</a></li>
                                    <li><a href="#">»</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div></div></div>


@endsection
