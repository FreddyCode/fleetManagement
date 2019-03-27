@extends('layouts.master')
@section('content')
    <style type="text/css">
        .photo {
            width:80px;
            height: 100px;
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
                <table class="table table-striped table-advance table-hover" id="table-carowners">
                    <thead>
                    <tr>
                        <th>CODE</th>
                        <th>FULL NAME</th>
                        <th>EMAIL</th>
                        <th>TEL</th>
                        <th>BANK DETAILS</th>
                        <th>PICTURE</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($owners as $key => $o)
                        <tr>
                            <td>{{$o->code}}</td>
                            <td>{{$o->first_name." "." ".$o->last_name}} </td>
                            <td>{{$o->email}} </td>
                            <td>{{$o->telephone}}</td>
                            <td>{{$o->bank."/ ".$o->account_number."/ ".$o->branch}}</td>
                            {{--<td>{{Html::imagebase64_decode($s->photo,null,['class'=>'photo'])}} </td>--}}
                            <td ><img src="data:image/png;base64, {{base64_encode($o->image)}} " class="photo" />
                            </td>

                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('viewCarOwner',$o->owner_id)}}"><button class="btn btn-primary " title="View Car Owner"><i class="fa fa-eye"></i></button></a>
                                    <a href="{{ route('editCarOwner',$o->owner_id)}}"><button class="btn btn-success" title="Edit Car Owner"><i class="icon_pencil-edit"></i></button></a>
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
        var $rows = $('#table-carowners tr');
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