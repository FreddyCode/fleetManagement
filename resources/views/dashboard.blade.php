@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i>Fleet Management Portal</h3>
            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="/dashboard">Home</a></li>
                <li><i class="fa fa-laptop"></i>Dashboard</li>
            </ol>
        </div>
    </div>
    <div class="panel panel">
        <header class="panel-heading">
            Car Owners Summary
        </header>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="info-box blue-bg">
                    <i class="fa fa-clipboard"></i>
                    <div class="count">{{$total_owners}}</div>
                    <div class="title">Total Car Owners</div>
                </div>

            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="info-box brown-bg">
                    <i class="fa fa-clipboard"></i>
                    <div class="count">{{$total_cars}}</div>
                    <div class="title">Total Cars</div>
                </div>

            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="info-box green-bg">
                    <i class="fa fa-cubes"></i>
                    <div class="count">{{$total_models}}</div>
                    <div class="title">Total Models</div>
                </div>

            </div>

        </div>
    </div>
    <div class="panel panel-success" id="">
        <header class="panel-heading">
            Today's Activity
        </header>
        <div class="panel-body">
            <div class="form-group">
                <table class="table table-striped table-advance table-hover" id="table-carowners">
                    <thead>
                    <tr>
                        <th>USER</th>
                        <th>ACTIVITY</th>
                        <th>DATE</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($audit as $key => $a)
                        <tr>
                            <td>{{$a->user}}</td>
                            <td>{{$a->activity}} </td>
                            <td>{{$a->act_date}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection