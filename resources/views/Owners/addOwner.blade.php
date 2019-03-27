@extends('layouts.master')
@section('content')
    <style type="text/css">
        .owner-photo{
            height:280px;
            padding-left:1px;
            padding-right:1px;
            border:1px solid #ccc;
            background: #eee;
            width: 280px;
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
                <li><i class="fa fa-file-text-o"></i>Car Owners</li>
            </ol>
        </div>
    </div>
    <div class="panel panel-success">
        <header class="panel-heading">
            Add A Car Owner
        </header>
        <div class="panel-body">
            <form class="" action="{{route('postCarOwner')}}" id="frm-create-owner" method="post" enctype="multipart/form-data">
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
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
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
                                <input type="email" name="email" id="email" class="form-control" value={{old('email')}}>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tel">
                                    <legend>Telephone</legend>
                                </label>
                                <input type="tel" name="telephone" id="telephone" class="form-control" value={{old('telephone')}}>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="address">
                                    <legend>Address</legend>
                                </label>
                                <input type="text" name="address" id="address" class="form-control" value={{old('address')}}>
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
                                        <th>Image</th>
                                    </tr>
                                    </thead>
                                    <tr>
                                        <td class="photo">
                                            <img src="assets/img/placeholder.png" class="owner-photo" id="showPhoto" name="photo" value="{{old('photo')}}">
                                            <input type="file" name="image" id="photo" accept="image/x-png,image/png,image/jpg,image/jpeg" data-value="{{old('image')}}">
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
                    <div class="col-lg-11 col-md-11 col-sm-11">
                        <div class="panel panel-primary">
                            <header class="panel-heading">
                                Bank Details
                            </header>
                            <div class="panel-body">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bank">
                                            <legend>Bank Name</legend>
                                        </label>
                                        <input type="text" name="bank" id="bank" class="form-control" value={{old('bank')}}>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="num">
                                            <legend>Account Number</legend>
                                        </label>
                                        <input type="text" name="account_number" id="account_number" class="form-control" value={{old('account_number')}}>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bank">
                                            <legend>Branch</legend>
                                        </label>
                                        <input type="text" name="branch" id="branch" class="form-control" value={{old('branch')}}>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="panel-footer">
                    <button value="submit" class="btn btn-block">SAVE OWNER <i class="fa fa-save"></i> </button>
                </div>
            </form>
        </div>
    </div>
    @endsection
@section('script')
    <script type="application/javascript">
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
    </script>
    @endsection