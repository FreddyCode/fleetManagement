@extends('layouts.master')
@section('content')
    <style type="text/css">
        .owner-photo{
            height:280px;
            padding-left:1px;
            padding-right:1px;
            border:1px solid #ccc;
            background: #eee;
            width: 500px;
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
                <li><i class="icon_document_alt"></i>Cars</li>
                <li><i class="fa fa-file-text-o"></i>Car Owners Details</li>
            </ol>
        </div>
    </div>
    <div class="panel panel-success">
        <header class="panel-heading">
            Add A Car Owner Details
        </header>
        <div class="panel-body">
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li style="font-weight: bold">{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form  action="{{route('updateCarOwnerDetail',$owner->detail_id)}}" id="frm-edit-ownerdetail" method="post" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="car_owner">
                                    <legend> Car Owner</legend>
                                </label>
                                <select class="form-control selectpicker" data-live-search="true" name="owner_id" id="car_owner_id" data-value="{{old('owner_id')}}">
                                    <option value="">---------------</option>
                                    @foreach($carowners as $key =>$c)
                                        <option value="{{$c->owner_id}}" {{ ($owner->owner_id == $c->owner_id ? "selected":"")}}>{{$c->code." ".$c->first_name." "." ".$c->last_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="car">
                                    <legend>Car</legend>
                                </label>
                                <select class="form-control selectpicker"  data-live-search="true" name="car" id="car_id_append" data-value="{{old('car')}}">
                                    <option value="">---------------</option>
                                    @foreach($cars as $key =>$c)
                                        <option value="{{$c->car_id}}" {{ ($owner->car_id == $c->car_id ? "selected":"")}}>{{$c->car_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="model">
                                    <legend> Model</legend>
                                </label>
                                <select class="form-control" name="model_id" id="model_id_append">
                                    @foreach($models as $key =>$c)
                                        <option value="{{$c->model_id}}" {{ ($owner->model_id == $c->model_id ? "selected":"")}}>{{$c->model_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="car-number">
                                    <legend>Car Number</legend>
                                </label>
                                <input type="text" name="car_number" id="car_number" class="form-control" value="{{$owner->car_number}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">
                                    <legend>Car Color</legend>
                                </label>
                                <input type="text" name="car_color" id="car_color" class="form-control" value="{{$owner->car_color}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">
                                    <legend>Date of Commencement</legend>
                                </label>
                                <input type="text" name="start_date" id="com_date" class="form-control"
                                       placeholder="click to add date" value="{{$owner->start_date}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <table style="margin: 0 auto;">
                                    <tbody>
                                    <thead>
                                    <tr class="info">
                                        <th>Car Image</th>
                                    </tr>
                                    </thead>
                                    <tr>
                                        <td class="photo">
                                            <img src="data:image/png;base64, {{base64_encode($owner->car_image)}} " class="owner-photo" id="showPhoto">
                                            <input type="file" name="car_image" id="photo" accept="image/x-png,image/png,image/jpg,image/jpeg">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;background: #ddd;">
                                            <input type="button" name="browse_file" id="browse_file" class="form-control btn-browse" value="Browse">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="panel-footer">
                    <button value="submit" class="btn btn-block">UPDATE OWNER <i class="fa fa-save"></i> </button>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('script')
    <script type="application/javascript">
        $('#com_date').datepicker({
            format: 'yyyy-mm-dd'
        });

        $('#browse_file').on('click',function (){
            $('#photo').click();
        });
        $('#photo').on('change',function (e) {
            showfile(this,'#showPhoto');
        });
        function showfile(fileInput,img,showName) {
            if(fileInput.files[0]){
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(img).attr('src',e.target.result);
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
            $(showName).text(fileInput.files[0].name);
        }

        $("#frm-edit-ownerdetail #car_id_append").on('change',function(e){
            var car_id = $(this).val();
            var model = $('#model_id_append')
            $(model).empty();
            $.get("{{route('showModels')}}",{car_id:car_id}, function(data){
                $.each(data,function (i,models) {
                    $(model).append($("<option/>",{
                        value : models.model_id,
                        text  : models.model_name
                    }))
                })
            })
        })


    </script>
@endsection