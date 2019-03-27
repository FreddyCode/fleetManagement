@extends('layouts.master')
@section('content')
    <style type="text/css">
        .profile-photo{
            height:150px;
            padding-left:1px;
            padding-right:1px;
            border:1px solid #ccc;
            background: #eee;
            width: 150px;
            margin: 0 auto;
        }
        .profile-photo > input[type = 'file']{
            display: none;
        }

        .insurance-photo{
            height:195px;
            padding-left:1px;
            padding-right:1px;
            border:1px solid #ccc;
            background: #eee;
            width: 195px;
            margin: 0 auto;
        }
        .insurance-photo > input[type = 'file']{
            display: none;
        }
        .license-photo{
            height:195px;
            padding-left:1px;
            padding-right:1px;
            border:1px solid #ccc;
            background: #eee;
            width: 195px;
            margin: 0 auto;
        }
        .license-photo > input[type = 'file']{
            display: none;
        }
        .identity-photo{
            height:195px;
            padding-left:1px;
            padding-right:1px;
            border:1px solid #ccc;
            background: #eee;
            width: 195px;
            margin: 0 auto;
        }
        .identity-photo > input[type = 'file']{
            display: none;
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
                <li><i class="icon_document_alt"></i>Drivers</li>
                <li><i class="fa fa-file-text-o"></i>Add Driver</li>
            </ol>
        </div>
    </div>
    <div class="panel panel-primary">
        <header class="panel-heading">
            Add A Driver
        </header>
        <div class="panel-body">
            <form  action="{{route('postDriver')}}" id="frm-create-driver" method="post" enctype="multipart/form-data">
                {!!csrf_field()!!}
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
                <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="panel panel-primary">
                                    <header class="panel-heading">
                                        Driver Details
                                    </header>
                                    <div class="panel-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first-name">
                                            <legend>First Name</legend>
                                        </label>
                                        <input type="text" name="first_name" id="first_name" class="form-control" value={{old('first_name')}}>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last-name">
                                            <legend>Last Name</legend>
                                        </label>
                                        <input type="text" name="last_name" id="last_name" class="form-control" value={{old('last_name')}}>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">
                                            <legend>Email</legend>
                                        </label>
                                        <input type="email" name="email" id="email" class="form-control"  value={{old('email')}}>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">
                                            <legend>Telephone</legend>
                                        </label>
                                        <input type="text" name="telephone" id="telephone" class="form-control" value={{old('telephone')}}>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="car_owner">
                                            <legend> Assign Car</legend>
                                        </label>
                                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="detail_id" id="detail_id"}}>
                                            <option value="">---------------</option>
                                            @foreach($ownersdetails as $key =>$c)
                                                <option value="{{$c->detail_id}}" {{ (old("detail_id") == $c->detail_id ? "selected":"")}}>{{$c->code."/ ".$c->car_name." "." /".$c->model_name." /".$c->car_number}}</option>
                                            @endforeach
                                        </select>
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
                                                <td class="profile-photo">
                                                    <img src="assets/img/placeholder.png" class="profile-photo" id="showProfilePhoto">
                                                    <input type="file" name="image" id="profile-photo" accept="image/x-png,image/png,image/jpg,image/jpeg">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center;background: #ddd;">
                                                    <input type="button" name="browse_file" id="browse_profile" class="form-control btn-browse" value="Browse">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="panel panel-primary">
                                    <header class="panel-heading">
                                        Documents Upload
                                    </header>
                                    <div class="panel-body">
                                        <div class="col-md-6">
                                    <div class="form-group ">
                                        <table style="margin: 0 auto;">
                                            <tbody>
                                            <thead>
                                            <tr class="info">
                                                <th>Insurance</th>
                                            </tr>
                                            </thead>
                                            <tr>
                                                <td class="insurance-photo">
                                                    <img src="assets/img/placeholder.png" class="insurance-photo" id="showInsurancePhoto">
                                                    <input type="file" name="insurance" id="insurance-photo" accept="image/x-png,image/png,image/jpg,image/jpeg">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center;background: #ddd;">
                                                    <input type="button" name="browse_file" id="browse_insurance" class="form-control btn-browse" value="Browse">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                <table style="margin: 0 auto;">
                                                    <tbody>
                                                    <thead>
                                                    <tr class="info">
                                                        <th>Drivers License</th>
                                                    </tr>
                                                    </thead>
                                                    <tr>
                                                        <td class="license-photo">
                                                            <img src="assets/img/placeholder.png" class="license-photo" id="showLicensePhoto">
                                                            <input type="file" name="license" id="license-photo" accept="image/x-png,image/png,image/jpg,image/jpeg">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: center;background: #ddd;">
                                                            <input type="button" name="browse_file" id="browse_license" class="form-control btn-browse" value="Browse">
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                <table style="margin: 0 auto;">
                                                    <tbody>
                                                    <thead>
                                                    <tr class="info">
                                                        <th>Passport/Voter's ID</th>
                                                    </tr>
                                                    </thead>
                                                    <tr>
                                                        <td class="identity-photo">
                                                            <img src="assets/img/placeholder.png" class="identity-photo" id="showIdentityPhoto">
                                                            <input type="file" name="identity" id="identity-photo" accept="image/x-png,image/png,image/jpg,image/jpeg">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: center;background: #ddd;">
                                                            <input type="button" name="browse_file" id="browse_identity" class="form-control btn-browse" value="Browse">
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="panel-footer">
                    <button value="submit" class="btn  btn-block">SAVE DRIVER <i class="fa fa-save"></i> </button>
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

        $('#browse_profile').on('click',function (){
            $('#profile-photo').click();
        });
        $('#profile-photo').on('change',function (e) {
            showfile(this,'#showProfilePhoto');
        });
        //===============================================
        $('#browse_insurance').on('click',function (){
            $('#insurance-photo').click();
        });
        $('#insurance-photo').on('change',function (e) {
            showfile(this,'#showInsurancePhoto');
        });
        //=============================================
        $('#browse_license').on('click',function (){
            $('#license-photo').click();
        });
        $('#license-photo').on('change',function (e) {
            showfile(this,'#showLicensePhoto');
        });
        //==============================================
        $('#browse_identity').on('click',function (){
            $('#identity-photo').click();
        });
        $('#identity-photo').on('change',function (e) {
            showfile(this,'#showIdentityPhoto');
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
//        $('#frm-create-driver').on('submit', function (e) {
//            e.preventDefault();
//            var data = $(this).serialize();
//            var url = $(this).attr('action');
//            $.post(url, data,function (data) {
//                console.log(data);
//                swal('SUCCESS',
//                    'Driver '+data.first_name+' saved successfully',
//                    'success');
//                $(this).trigger('reset');
//            }).fail(function (data) {
//                console.log(data);
//                var responseJSON = data.responseJSON;
//                var response = '';
//                for (var key in responseJSON) {
//                    if (responseJSON.hasOwnProperty(key)) {
//                        response += "\n" + responseJSON[key] + "\n";
//                    }
//                }
//                swal('ERROR',
//                    response,
//                    'error');
//            });
//
//        });

    </script>
@endsection