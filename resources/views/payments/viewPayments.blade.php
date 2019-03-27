@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header"><i class="fa fa-file-text-g"></i>Fleet Management Portal</h2>
            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="/dashboard">Home</a></li>
                <li><i class="icon_document_alt"></i>Payment </li>
                <li><i class="fa fa-file-text-o"></i>Payment List</li>
            </ol>
        </div>
    </div>
    <div class="panel panel-success" id="add-carowner">
        <header class="panel-heading">
            Car Owners List
        </header>
        <div class="panel-body">
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
                <table class="table table-striped table-advance table-hover" id="table-payment">
                    <thead>
                    <tr>
                        <th>CODE</th>
                        <th>FULL NAME</th>
                        <th>DATE</th>
                        <th>REGISTRATION</th>
                        <th>FUEL</th>
                        <th>REPAIRS</th>
                        <th>TOTAL AMOUNT</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($payments as $key => $p)
                        <tr>
                            <td>{{$p->code}}</td>
                            <td>{{$p->first_name." "." ".$p->last_name}} </td>
                            <td>{{$p->payment_date}}</td>
                            <td>{{$p->reg_amount}}</td>
                            <td >{{$p->fuel_amount}}</td>
                            <td>{{$p->repairs_amount}} </td>
                            <td>{{$p->total_amount}}</td>
                            {{--<td>{{Html::imagebase64_decode($s->photo,null,['class'=>'photo'])}} </td>--}}

                            <td>
                                <div class="btn-group">
                                    {{--<button class="btn btn-primary view-student" value="{{$o->owner_id}}"><i class="fa fa-eye"></i></button>--}}
                                    <button class="btn btn-success edit-carowner" value="{{$p->payment_id}}"><i class="icon_printer"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-10 page-links">
                        {{$payments->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="application/javascript">
        var $rows = $('#table-payment tr');
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