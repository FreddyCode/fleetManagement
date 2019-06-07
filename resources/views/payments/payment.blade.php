@extends('layouts.master')
@section('content')
    <style type="text/css">
        .owner-photo{
            height:150px;
            padding-left:1px;
            padding-right:1px;
            border:1px solid #ccc;
            background: #eee;
            width: 150px;
            margin: 0 auto;
        }
        .photo > input[type = 'file']{
            display: none;
        }
        .photo{
            width:50px;
            height:50px;
            border-radius: 100%;
        }

        .btn-browse{
            border-color: #CCCCCC;
            padding: 5px;
            text-align: center;
            background: #eee;
            border:none;
            border-top:1px solid #ccc;
        }

    </style>
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header"><i class="fa fa-file-text-g"></i>Fleet Management Portal</h2>
            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="/dashboard">Home</a></li>
                <li><i class="icon_document_alt"></i>Payments</li>
                <li><i class="fa fa-file-text-o"></i>Make Payment</li>
            </ol>
        </div>
    </div>
    <section class="panel panel-success">
        <header class="panel-heading">
            Search Car Owner
        </header>
        <div class="panel-body">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif
            <form class="form-horizontal " action="{{route('search')}}" method="get" >
                <div class="form-group has-success">
                    <div class="col-lg-1"></div>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="owner_id" required>
                                <option value="">Select Code</option>
                                @foreach($owners as $key=>$o)
                                    <option value="{{$o->owner_id}}">{{$o->code." ".$o->first_name." ".$o->last_name}}</option>
                                @endforeach
                            </select>
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default">
                                    <span class="fa fa-search"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <header class="panel-heading">
            Car Owner Information
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fullname">
                                <legend>Full Name</legend>
                            </label>
                            <input type="text" name="fullname" id="fullname" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="last-name">
                                <legend>Email</legend>
                            </label>
                            <input type="text" name="email" id="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group ">
                            <table style="margin: 0 auto;">
                                <tbody>
                                <thead>
                                <tr class="info">
                                    <th>Profile Image</th>
                                </tr>
                                </thead>
                                <tr>
                                    <td class="photo">
                                        <img src="assets/img/placeholder.png" class="owner-photo" id="showPhoto">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <table class="table table-striped table-advance table-hover" border="1">
                                <thead>
                                <tr>
                                    <th>CAR TYPE</th>
                                    <th>MODEL</th>
                                    <th>COLOR</th>
                                    <th>IMAGE</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td> </td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <header class="panel-heading">
            Make Payment
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="amount">
                                <legend>Month</legend>
                            </label>
                            <select class="form-control" name="month" id="month" required>
                                <option value="">-------------------<option>
                                <option value="January">January<option>
                                <option value="February">February<option>
                                <option value="March">March<option>
                                <option value="April">April<option>
                                <option value="May">May<option>
                                <option value="June">June<option>
                                <option value="July">July<option>
                                <option value="August">August<option>
                                <option value="September">September<option>
                                <option value="October">October<option>
                                <option value="November">November<option>
                                <option value="December">December<option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Year">
                                <legend>Year</legend>
                            </label>
                            <select class="form-control" name="year" id="year" required>
                                <option value="">---------------</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                                <option value="2031">2031</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="amount">
                                <legend>Total Amount</legend>
                            </label>
                            <input type="text" name="amount" id="amount" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="reg">
                                <legend>Registration</legend>
                            </label>
                            <input type="text" name="reg_amount" id="reg_amount" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="reg">
                                <legend>Fuel</legend>
                            </label>
                            <input type="text" name="fuel_amount" id="fuel_amount" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="reg">
                                <legend>Repairs</legend>
                            </label>
                            <input type="text" name="repairs_amount" id="repairs_amount" class="form-control" required>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>

@endsection
@section('script')

@endsection