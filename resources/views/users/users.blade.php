@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header"><i class="fa fa-file-text-g"></i>Fleet Management Portal</h2>
            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="/dashboard">Home</a></li>
                <li><i class="icon_document_alt"></i>Users</li>
                <li><i class="fa fa-file-text-o"></i>Users Info</li>
            </ol>
        </div>
    </div>
    <div class="panel panel-success">
        <header class="panel-heading">
            Add A New user
        </header>
        <div class="panel-body">
            <form action="/post/user" id="frm-create-user" class="form-horizontal" method="POST">
                @if(count($errors)>0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{csrf_field()}}
                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif
                <div class="form-group">
                    <div class="col-lg-2">
                        <label for="first_name">First Name</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="first_name" id="first_name" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-2">
                        <label for="last_name">Last Name</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="last_name" id="last_name" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-2">
                        <label for="email">Email</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="email" class="form-control" name="email" id="email" placeholder="example@example.com">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-2">
                        <label for="password">Password</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-2">
                        <label for="confirm_password">Confirm Password</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="password" class="form-control" name="password_confirmation" id="confirm_password" required>
                    </div>
                </div>
                    <input type="hidden" name="remember_token" value="{{csrf_token()}}">
                <div class="col-lg-4 ">
                    <button type="submit" class="btn btn-success btn-lg btn-block">Add User</button>
                </div>
            </form>
        </div>
    </div>
@endsection