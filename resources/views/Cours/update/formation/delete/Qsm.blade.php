   <!-- delete  -->
   <div class="modal fade" id="delete_Qsm_video_{{ $Qsm->id }}" tabindex="-1" role="dialog"
       aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Delete Qsm
                   </h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <form action="{{ Route('dashboard.delete.update.Qsm', Crypt::encrypt($Qsm->id)) }}" method="POST">
                   @method('delete')
                   @csrf
                   <div class="modal-body">
                       Are you sure you want to delete?
                       <div class="form-group">
                           <label for="password">Password</label>
                           <input type="password" class="form-control" name="password" id="password"
                               placeholder="Enter password ...">
                       </div>

                   </div>
                   <div class="modal-footer">

                       <button type="submit" class="btn btn-danger">Delete</button>
                   </div>
               </form>
           </div>
       </div>
   </div>
