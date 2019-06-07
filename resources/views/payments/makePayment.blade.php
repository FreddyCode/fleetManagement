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
        .car-photo {
            width:80px;
            height: 50px;
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
            Make Payment to {{$owners->first_name." ".$owners->last_name}}
        </header>
        <div class="panel-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif
                @if(count($errors)>0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{session('error')}}
                    </div>
                @endif
            <form class="" action="{{route('payments')}}" method="post" >
                {!!csrf_field()!!}
                <input type="hidden" name="email" id="email" class="form-control"
                       value="{{$owners->email}}" required>
                <input type="hidden" name="owner_id" id="owner_id" class="form-control"
                       value="{{$owners->owner_id}}" required>
                <input type="hidden" name="user_id" id="user_id" class="form-control"
                       value="{{ Auth::user()->id}}" required>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="month">
                                    <legend>Month</legend>
                                </label>
                                <select class="form-control selectpicker"  data-live-search="true" name="month" id="month">
                                    <option value="">---------------</option>
                                    <option value="January" {{ (old("month") == 'January' ? "selected":"")}}>January</option>
                                    <option value="February" {{ (old("month") == 'February' ? "selected":"")}}>February</option>
                                    <option value="March" {{ (old("month") == 'March' ? "selected":"")}}>March</option>
                                    <option value="April" {{ (old("month") == 'April' ? "selected":"")}}>April</option>
                                    <option value="May" {{ (old("month") == 'May' ? "selected":"")}}>May</option>
                                    <option value="June" {{ (old("month") == 'June' ? "selected":"")}}>June</option>
                                    <option value="July" {{ (old("month") == 'July' ? "selected":"")}}>July</option>
                                    <option value="August" {{ (old("month") == 'August' ? "selected":"")}}>August</option>
                                    <option value="September" {{ (old("month") == 'September' ? "selected":"")}}>September</option>
                                    <option value="October" {{ (old("month") == 'October' ? "selected":"")}}>October</option>
                                    <option value="November" {{ (old("month") == 'November' ? "selected":"")}}>November</option>
                                    <option value="December" {{ (old("month") == 'December' ? "selected":"")}}>December</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Year">
                                    <legend>Year</legend>
                                </label>
                                <select class="form-control selectpicker" data-live-search="true" name="year" id="year" >
                                    <option value="">---------------</option>
                                    <option value="2019"  {{ (old("year") == '2019' ? "selected":"")}}>2019</option>
                                    <option value="2020"  {{ (old("year") == '2020' ? "selected":"")}}>2020</option>
                                    <option value="2021"  {{ (old("year") == '2021' ? "selected":"")}}>2021</option>
                                    <option value="2022"  {{ (old("year") == '2022' ? "selected":"")}}>2022</option>
                                    <option value="2023"  {{ (old("year") == '2023' ? "selected":"")}}>2023</option>
                                    <option value="2024"  {{ (old("year") == '2024' ? "selected":"")}}>2024</option>
                                    <option value="2025"  {{ (old("year") == '2025' ? "selected":"")}}>2025</option>
                                    <option value="2026"  {{ (old("year") == '2026' ? "selected":"")}}>2026</option>
                                    <option value="2027"  {{ (old("year") == '2027' ? "selected":"")}}>2027</option>
                                    <option value="2028"  {{ (old("year") == '2028' ? "selected":"")}}>2028</option>
                                    <option value="2029"  {{ (old("year") == '2029' ? "selected":"")}}>2029</option>
                                    <option value="2030" {{ (old("year") == '2030' ? "selected":"")}}>2030</option>
                                    <option value="2031" {{ (old("year") == '2031' ? "selected":"")}}>2031</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="amount">
                                    <legend>Total Amount</legend>
                                </label>
                                <input type="text" name="amount" id="amount" class="form-control" value="{{old('amount')}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="reg">
                                    <legend>Registration</legend>
                                </label>
                                <input type="text" name="reg_amount" id="reg_amount" class="form-control" value="0">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="reg">
                                    <legend>Fuel</legend>
                                </label>
                                <input type="text" name="fuel_amount" id="fuel_amount" class="form-control" value="0">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="reg">
                                    <legend>Repairs</legend>
                                </label>
                                <input type="text" name="repairs_amount" id="repairs_amount" class="form-control" value="0">
                            </div>
                        </div>

                    </div>

                </div>
                <br>
                <div class="panel-footer">
                    <button value="submit" class="btn btn-block">SEND <i class="fa fa-save"></i> </button>
                </div>
            </form>
        </div>
        <header class="panel-heading">
            Search Car Owner
        </header>
        <div class="panel-body">
            <form class="form-horizontal " action="{{route('search')}}" method="get" >
                <div class="form-group has-success">
                    <div class="col-lg-1"></div>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="owner_id" required>
                                <option value="">Select Code</option>
                                @foreach($carowners as $key=>$o)
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
                            <input type="text" name="fullname" id="fullname" class="form-control"
                                   value="{{$owners->first_name." ".$owners->last_name}}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">
                                <legend>Email</legend>
                            </label>
                            <input type="text" name="email" id="email" class="form-control"
                                   value="{{$owners->email}}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="last-tel">
                                <legend>Telephone</legend>
                            </label>
                            <input type="text" name="telephone" id="telephone" class="form-control"
                                   value="{{$owners->telephone}}" required>
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
                                        <img src="data:image/png;base64, {{base64_encode($owners->image)}} "  class="owner-photo" id="showPhoto">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="col-md-12">

                            <table class="table table-striped table-advance table-hover" border="1">
                                <thead>
                                <tr>
                                    <th>CAR TYPE</th>
                                    <th>MODEL</th>
                                    <th>CAR NUMBER</th>
                                    <th>COLOR</th>
                                    <th>IMAGE</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($ownerdetails)>0)
                                @foreach($ownerdetails as $key => $o)
                                <tr>
                                    <td>{{$o->car_name}}</td>
                                    <td>{{$o->model_name}} </td>
                                    <td>{{$o->car_number}}</td>
                                    <td>{{$o->car_color}}</td>
                                    <<td ><div id="content"> <img src="data:image/png;base64, {{base64_encode($o->car_image)}} " class="car-photo" id="myImg"/></div>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" style="color: red; text-align: center">No car detail found.</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>


                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
@section('script')

@endsection