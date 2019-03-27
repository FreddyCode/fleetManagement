@extends('layouts.master')
@section('content')
    <style type="text/css">
        .photo {
            width:80px;
            height: 50px;
        }
        .profile {
            width:100px;
            height: 100px;
        }

    </style>
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header"><i class="fa fa-file-text-g"></i>Fleet Management Portal</h2>
            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="/dashboard">Home</a></li>
                <li><i class="icon_document_alt"></i>Drivers</li>
                <li><i class="fa fa-file-text-o"></i>Drivers List</li>
            </ol>
        </div>
    </div>
    <div class="panel panel-success" id="add-carowner">
        <header class="panel-heading">
            Drivers List
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
                <table class="table table-striped table-advance table-hover" id="table-drivers" border="1">
                    <thead>
                    <tr>
                        <th colspan="4" style="text-align: center">PERSONAL DETAILS</th>
                        <th colspan="5" style="text-align: center">CAR DETAILS</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($drivers as $key => $d)
                        <tr>
                            <td>{{$d->first_name." "." ".$d->last_name}} </td>
                            <td>{{$d->telephone}}</td>
                            <td>{{$d->email}}</td>
                            <td><div id="content"> <img src="data:image/png;base64, {{base64_encode($d->image)}} " class="profile"/></div></td>
                            <td>{{$d->car_name}}</td>
                            <td>{{$d->model_name}}</td>
                            <td ><div id="content"> <img src="data:image/png;base64, {{base64_encode($d->car_image)}} " class="photo" id="myImg"/></div>
                            </td>
                            <td>{{$d->car_number}} </td>
                            <td>{{$d->car_color}}</td>


                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('viewDriver',$d->id)}}"><button class="btn btn-primary" title="View Driver"><i class="fa fa-eye"></i></button></a>
                                    <a href="{{ route('editDriver',$d->id)}}"><button class="btn btn-success" title="Edit Driver"><i class="icon_pencil-edit"></i></button></a>
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
        var $rows = $('#table-drivers tr');
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