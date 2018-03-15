@extends('layouts.app')


@section('script')


    .texto_grande {
    font-size: 2.5rem;
    color: white;
    }


@endsection



@section('content')


    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="container">


        <div class="col-md-3">
            <a class="btn btn-block btn-lg btn-primary" data-toggle="modal" href="/requestcrud">
                {{-- <a  class="btn btn-block btn-lg btn-success" data-toggle="modal" href="/go">--}}
                <i class="fa fa-users" id="icone_grande"></i> <br><br>
                {{--<span class="texto_grande"><i class="fa fa-plus-circle"></i> View Requests</span></a>--}}
                <span class="texto_grande"><i class="fa fa-edit"></i>View Requests</span></a>
        </div>


        <div class="col-md-3">
            {{-- <a class="btn btn-block btn-lg btn-success" data-toggle="modal" href="/viewcomp">--}}
            <a class="btn btn-block btn-lg btn-primary" data-toggle="modal" href="/viewcomp">
                <i class="fa fa-user" id="icone_grande"></i> <br><br>
                <span class="texto_grande"><i class="fa fa-plus-circle"></i> View Complains</span></a>
        </div>


        <div class="col-md-3">
            <a class="btn btn-block btn-lg btn-primary" data-toggle="modal" href="/empcrud">
                {{-- <i class="fa fa-cog fa-spin" id="icone_grande"></i> <br><br>--}}
                <i class="fa fa-user" id="icone_grande"></i> <br><br>
                <span class="texto_grande"><i class="fa fa-edit"></i>Employees</span></a>
        </div>


        <div class="col-md-3">
            <a class="btn btn-block btn-lg btn-primary" data-toggle="modal" href="/searchpoints">
                {{-- <i class="fa fa-cog fa-spin" id="icone_grande"></i> <br><br>--}}
                <i class="fa fa-user" id="icone_grande"></i> <br><br>
                <span class="texto_grande"><i class="fa fa-edit"></i>Points</span></a>
        </div>



    </div>
    <br>
    <br>
    <br>
    <div class="container">

        <div class="col-md-3">
            <a class="btn btn-block btn-lg btn-primary" data-toggle="modal" href="/areacrud">
                <i class="fa fa-user" id="icone_grande"></i> <br><br>
                <span class="texto_grande"><i class="fa fa-times-circle-o"></i> Areas</span></a>

        </div>

        <div class="col-md-3">
            <a class="btn btn-block btn-lg btn-primary" data-toggle="modal" href="/stat">
                <i class="fa fa-cog fa-spin" id="icone_grande"></i> <br><br>
                <span class="texto_grande"><i class="fa fa-edit"></i>Statistics</span></a>
        </div>


            <div class="col-md-3">
                <a class="btn btn-block btn-lg btn-primary" data-toggle="modal" href="/managePoints">
                    {{-- <i class="fa fa-cog fa-spin" id="icone_grande"></i> <br><br>--}}
                    <i class="fa fa-user" id="icone_grande"></i> <br><br>
                    <span class="texto_grande"><i class="fa fa-edit"></i>Manage Points</span></a>
            </div>


    </div>







@endsection
