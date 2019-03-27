<div class="modal fade" id="car-show" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Car</h4>
            </div>
            <form  id="frm-update-car"  class="form-horizontal" action="">
                <div class="modal-body">
                    <input type="hidden" id="car_id_edit" name="car_id">
                    <div class="form-group">
                        <div class="col-lg-4">
                            <label for="class_name">Car Name</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="car_name" id="car_name_edit" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    <button class="btn btn-success btn-update-car" type="button">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>