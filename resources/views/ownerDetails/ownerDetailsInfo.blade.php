@extends('layouts.master')
@section('content')
    <style type="text/css">
        .photo {
            width:80px;
            height: 50px;
        }

    </style>
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header"><i class="fa fa-file-text-g"></i>Fleet Management Portal</h2>
            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="/dashboard">Home</a></li>
                <li><i class="icon_document_alt"></i>Cars </li>
                <li><i class="fa fa-file-text-o"></i>Car Owners list</li>
            </ol>
        </div>
    </div>
    <div class="panel panel-success" id="add-carowner">
        <header class="panel-heading">
            Car Owners List
        </header>
        <div class="panel-body">
            @if(session()->get('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong> {{ session()->get('success') }}</strong>
                </div>
            @endif
            <div class="form-group">
                <form class="form-horizontal " method="get">
                    <div class="form-group has-success">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="search" id="search" placeholder="Filter by Name"
                                   autocomplete="off" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="form-group">
                <table class="table table-striped table-advance table-hover" id="table-carownersdetails">
                    <thead>
                    <tr>
                        <th>CODE</th>
                        <th>FULL NAME</th>
                        <th>CAR TYPE</th>
                        <th>CAR MODEL</th>
                        <th>CAR IMAGE</th>
                        <th>CAR NUMBER</th>
                        <th>CAR COLOR</th>
                        <th>COMMENCEMENT DATE</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ownersdetails as $key => $o)
                        <tr>
                            <td>{{$o->code}}</td>
                            <td>{{$o->first_name." "." ".$o->last_name}} </td>
                            <td>{{$o->car_name}}</td>
                            <td>{{$o->model_name}}</td>
                            <td ><div id="content"> <img src="data:image/png;base64, {{base64_encode($o->car_image)}} " class="photo" id="myImg"/></div>
                            </td>
                            <td>{{$o->car_number}} </td>
                            <td>{{$o->car_color}}</td>
                            <td>{{$o->start_date}}</td>
                            {{--<td>{{Html::imagebase64_decode($s->photo,null,['class'=>'photo'])}} </td>--}}

                            <td>
                                <a class="btn-group">
                                    <a href="{{ route('viewCarOwnerDetail',$o->detail_id)}}"><button class="btn btn-primary" title="View Car Owners Detail"><i class="fa fa-eye"></i></button></a>
                                    <a href="{{ route('editCarOwnerDetail',$o->detail_id)}}"><button class="btn btn-success " title="Edit Car Owners Detail"><i class="icon_pencil-edit"></i></button></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="application/javascript">
        var $rows = $('#table-carownersdetails tr');
        $('#search').keyup(function() {

            var val = '^(?=.*\\b' + $.trim($(this).val()).split(/\s+/).join('\\b)(?=.*\\b') + ').*$',
                reg = RegExp(val, 'i'),
                text;
            $rows.show().filter(function() {
                text = $(this).text().replace(/\s+/g, ' ');
                return !reg.test(text);
            }).hide();
        });
    </script>
@endsection