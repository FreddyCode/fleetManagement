<div class="modal fade" id="model-show" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Model</h4>
            </div>
            <form  id="frm-update-model"  class="form-horizontal" action="">
                <div class="modal-body">
                    <input type="hidden" id="model_id_edit" name="model_id">
                    <div class="form-group">
                        <div class="col-lg-4">
                            <label for="car-name">Car Type</label>
                        </div>
                        <div class="col-lg-8">
                            <select class="form-control" name="car_id" id="car_id_edit" required>
                                <option value="">---------------</option>
                                @foreach($cars as $key =>$c)
                                    <option value="{{$c->car_id}}">{{$c->car_name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="col-lg-4">
                            <label for="cmodel_name">Model</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="model_name" id="model_name_edit" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    <button class="btn btn-success btn-update-model" type="button">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>