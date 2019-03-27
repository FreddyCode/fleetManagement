@extends('layouts.master')
@section('content')
    @include('models.editModel')
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header"><i class="fa fa-file-text-g"></i>Fleet Management Portal</h2>
            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="/dashboard">Home</a></li>
                <li><i class="icon_document_alt"></i>Cars</li>
                <li><i class="fa fa-file-text-o"></i>Models</li>
            </ol>
        </div>
    </div>
    <div class="panel panel-success">
        <header class="panel-heading">
            Add A Car Model
        </header>
        <div class="panel-body">
            <form class="form-horizontal" action="{{route('postModel')}}" id="frm-create-model" method="post">
                <div class="form-group">
                    <div class="col-lg-2">
                        <label for="car-name">Car Type</label>
                    </div>
                    <div class="col-lg-6">
                        <select class="form-control selectpicker"  data-live-search="true" name="car_id" id="car_id" data-value="{{old('car_id')}}">
                            <option value="">---------------</option>
                            @foreach($cars as $key =>$c)
                                <option value="{{$c->car_id}}">{{$c->car_name}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-lg-2">
                        <label for="model-name">Model</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="model_name" id = "model" value="{{old('model_name')}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-4">

                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-lg btn-block">Add Model</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="panel panel-success">
            <header class="panel-heading">
                Model Details
            </header>
            <div class="panel-body" id="add-model">

            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript">
        showModelInfo();
        $('#frm-create-model').on('submit', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');
            $.post(url, data,function (data) {
                showModelInfo(data.model_name);
                console.log(data);
                swal('SAVED',
                    'Model '+data.model_name+' saved successfully',
                    'success');
                $(this).trigger('reset');
            }).fail(function (data) {
                console.log(data);
                var response = $.parseJSON(data.responseText)
                $.each(response.errors, function(key, value){
                    swal({
                        title: "ooops!",
                        text: value,
                        icon: "error",
                        color: "#FEFAE3",
                        button: "OK",
                    });


                });
            });

        });
        function showModelInfo()
        {
            var data = $('#frm-create-model').serialize();
            console.log(data);
            $.get("{{route('showModelsInfo')}}", data, function (data) {
                $('#add-model').empty().append(data);
            });
        }
        $(document).on('click', '.edit-model', function (e) {
            $('#model-show').modal('show');
            var model_id = $(this).val();
            $.get("{{route('editModel')}}", {model_id:model_id}, function (data) {
                console.log(data)
                $('#model_id_edit').val(data.model_id);
                $('#model_name_edit').val(data.model_name);
                $('#car_id_edit').val(data.car_id);
            });
        });
        $('.btn-update-model').on('click', function (e) {
            e.preventDefault();
            var data = $('#frm-update-model').serialize();
            $.post("{{route('updateModel')}}", data, function (data) {
                showModelInfo(data.model_name);
                $('#model-show').modal('hide');
                swal('UPDATED',
                    'Model '+data.model_name+' updated successfully',
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
                swal('ERROR',
                    response,
                    'error');
            });
        })

        $(document).on('click', '.del-model', function (e) {
            var id = $(this).val();
            var validate = confirm("Are you sure you want to delete this Car Model?");
            if (validate === true) {
                $.post("{{route('deleteModel')}}", {model_id: id}, function (data) {
                    showModelInfo(data.model_name);
                    swal('Deleted',
                        'Selected Car Model deleted successfully',
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
                    swal('ERROR',
                        response,
                        'error');
                })
            }else{swal('Cancelled',"Car Model not deleted");}
        })


    </script>
@endsection