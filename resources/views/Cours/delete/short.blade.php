<!-- Modal -->
<div class="modal fade" id="delete_podcast" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Quickly Content</h5>
            </div>
            <form action="{{Route('dashboard.short.delete' , Crypt::encrypt($short->id))}}" method="post">
                @csrf
                @method('delete')
                <div class="modal-body">
                    Are you sure you want to delete?
                    <div class="form-group mt-3">
                        <input type="password" class="form-control" id="exampleInputPassword1"
                            placeholder="Enter Voter Mots de Passe" name="password">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-danger">Confirm</button>


                </div>
            </form>
        </div>
    </div>
</div>
