@extends('layouts.master')
@section('content')
    @include('users.editUser')
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header"><i class="fa fa-file-text-g"></i>Fleet Management Portal</h2>
            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="/dashboard">Home</a></li>
                <li><i class="icon_document_alt"></i>User</li>
                <li><i class="fa fa-file-text-o"></i>Info</li>
            </ol>
        </div>
    </div>
    <div class="panel panel-success">
        <header class="panel-heading">
            Users Details
        </header>
        <div class="panel-body" id="add-student">
            <div class="form-group">
                <form class="form-horizontal " method="get">
                    <div class="form-group has-success">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="search" id="search" placeholder="Filter by username or name"
                                   autocomplete="off" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="form-group">
                <table class="table table-striped table-advance table-hover" id="table-users" border="1">
                    <thead>
                    <tr>
                        <th>FIRST NAME</th>
                        <th>LAST NAME</th>
                        <th>EMAIL</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key => $u)
                        <tr>
                            <td>{{$u->first_name}}</td>
                            <td>{{$u->last_name}} </td>
                            <td>{{$u->email}} </td>

                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-success edit-user" value="{{$u->id}}"><i class="icon_pencil-edit" title="Edit User"></i></button>
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
                        {{$users->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
@section('script')
    <script type="text/javascript">
        var $rows = $('#table-users tr');
        $('#search').keyup(function() {

            var val = '^(?=.*\\b' + $.trim($(this).val()).split(/\s+/).join('\\b)(?=.*\\b') + ').*$',
                reg = RegExp(val, 'i'),
                text;

            $rows.show().filter(function() {
                text = $(this).text().replace(/\s+/g, ' ');
                return !reg.test(text);
            }).hide();
        });
        $(document).on('click', '.edit-user', function (e) {
            $('#user-show').modal('show');
            var id = $(this).val();
            $.get("{{route('editUser')}}", {id:id}, function (data) {
                console.log(data)
                $('#id_edit').val(data.id);
                $('#first_name_edit').val(data.first_name);
                $('#last_name_edit').val(data.last_name);
                $('#email_edit').val(data.email);
            });
        });
        $('.btn-update-user').on('click', function (e) {
            e.preventDefault();
            var data = $('#frm-update-user').serialize();
            $.post("{{route('updateUser')}}", data, function (data) {
                $('#user-show').modal('hide');
                swal('FLEET PORTAL',
                    'User '+data.first_name+' updated successfully',
                    'success');

            }).fail(function (data) {
                console.log(data);
                var responseJSON = data.responseJSON;
                var response = '';
                for (var key in responseJSON) {
                    if (responseJSON.hasOwnProperty(key)) {
                        response += "\n" + responseJSON[key] + "\n";
                    }
                }
                swal('FLEET PORTAL',
                    response,
                    'Something Went Wrong',
                    'error');
            });
        })

    </script>
@endsection