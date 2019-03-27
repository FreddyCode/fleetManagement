@extends('layouts.master')
@section('content')
    @include('cars.editCars')
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header"><i class="fa fa-file-text-g"></i>Fleet Management Portal</h2>
            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="/dashboard">Home</a></li>
                <li><i class="icon_document_alt"></i>Car</li>
                <li><i class="fa fa-file-text-o"></i>Add New Car</li>
            </ol>
        </div>
    </div>
    <div class="panel panel-success">
        <header class="panel-heading">
            Add A New Car
        </header>
        <div class="panel-body">

            <form class="form-horizontal" action="{{route('postCar')}}" id="frm-create-car" method="post">
                <div class="alert alert-danger" style="display:none">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            <div class="form-group">
                <div class="col-lg-2">
                    <label for="car-name">Car Type</label>
                </div>
                <div class="col-lg-6">
                    <input type="text" class="form-control" name="car_name" id = "car_name" value="{{old('car_name')}}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-4">

                </div>
                <div class="col-lg-2">
                    <button type="submit" class="btn btn-success btn-lg btn-block">Add Car</button>
                </div>
            </div>
            </form>
        </div>
        <div class="panel panel-success">
            <header class="panel-heading">
                Car Details
            </header>
            <div class="panel-body" id="add-car">



            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript">
        showCarInfo();


           $('#frm-create-car').on('submit', function (e) {
                e.preventDefault();
                var data = $(this).serialize();
                var url = $(this).attr('action');
                $.post(url, data,function (data) {
                    showCarInfo(data.car_name);
                    console.log(data);
                    swal('SUCCESS',
                        'Car '+data.car_name+' saved successfully',
                        'success');
                    $(this).trigger('reset');
                }).error(function (data,status,error) {
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

        function showCarInfo()
        {
            var data = $('#frm-create-car').serialize();
            console.log(data);
            $.get("{{route('showCarsInfo')}}", data, function (data) {
                $('#add-car').empty().append(data);
            });
        }
        $(document).on('click', '.edit-car', function (e) {
            $('#car-show').modal('show');
            var car_id = $(this).val();
            $.get("{{route('editCar')}}", {car_id:car_id}, function (data) {
                console.log(data)
                $('#car_id_edit').val(data.car_id);
                $('#car_name_edit').val(data.car_name);
            });
        });
        $('.btn-update-car').on('click', function (e) {
            e.preventDefault();
            var data = $('#frm-update-car').serialize();
            $.post("{{route('updateCar')}}", data, function (data) {
                showCarInfo(data.car_name);
                $('#car-show').modal('hide');
                swal('SUCCESS',
                    'Car '+data.car_name+' updated successfully',
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

        $(document).on('click', '.del-car', function (e) {
            var id = $(this).val();
            var validate = confirm("Are you sure you want to delete this car?");
            if (validate === true) {
                $.post("{{route('deleteCar')}}", {car_id: id}, function (data) {
                    showCarInfo(data.car_name);
                    swal('Deleted',
                        'Selected Car deleted successfully',
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
            }else{swal('Cancelled',"Car not deleted");}
        })

    </script>
@endsection