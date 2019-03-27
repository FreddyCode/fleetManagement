<table class="table table-striped table-advance table-hover" border="1">
    <thead>
    <tr>
        <th>CAR NAME</th>
        <th>MODEL</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($models as $key => $m)
        <tr>
            <td>{{strtoupper($m->car_name)}}</td>
            <td>{{strtoupper($m->model_name)}}</td>
            <td>
                <div class="btn-group">
                    <button class="btn btn-success edit-model" value="{{$m->model_id}}"><i class="icon_pencil-edit"></i></button>
                    <button class="btn btn-danger del-model" value="{{$m->model_id}}"><i class="icon_close_alt2"></i></button>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>