<div class="modal fade" id="user-show" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit User</h4>
            </div>
            <form  id="frm-update-user"  class="form-horizontal" action="">
                <div class="modal-body">
                    <input type="hidden" id="id_edit" name="id">

                    <div class="form-group">
                        <div class="col-lg-4">
                            <label for="first_name">First Name</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="first_name" id="first_name_edit" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4">
                            <label for="last_name">Last Name</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="last_name" id="last_name_edit" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4">
                            <label for="email">Email</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="email" class="form-control" name="email" id="email_edit">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    <button class="btn btn-success btn-update-user" type="button">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>