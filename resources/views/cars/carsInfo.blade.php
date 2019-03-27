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
<div class="form-group" >
<table class="table table-striped table-advance table-hover"  id="table-cars" border="1">
    <thead>
    <tr>
        <th>CAR NAME</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($cars as $key => $c)
        <tr>
            <td>{{$c->car_name}}</td>
            <td>
                <div class="btn-group">
                    <button class="btn btn-success edit-car" value="{{$c->car_id}}"><i class="icon_pencil-edit"></i></button>
                    <button class="btn btn-danger del-car" value="{{$c->car_id}}"><i class="icon_close_alt2"></i></button>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
<script type="application/javascript">
    var $rows = $('#table-cars tr');
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