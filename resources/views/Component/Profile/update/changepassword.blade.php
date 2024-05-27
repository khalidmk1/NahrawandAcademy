<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mettre à jour Mots de Passe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ Route('dashboard.password.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="modal-body">

                    <div class="form-group">
                        <label for="exampleInputPassword1"> Current password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1"
                            placeholder="Entre Current password" name="current_password">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">New Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1"
                            placeholder="Entre New Password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Confirm Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1"
                            placeholder="Entre Confirm Password" name="password_confirmation">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>

                </div>
            </form>

        </div>
    </div>
</div> 