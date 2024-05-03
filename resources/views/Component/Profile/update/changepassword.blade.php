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
                        <label for="exampleInputPassword1"> Mot de passe actuel</label>
                        <input type="password" class="form-control" id="exampleInputPassword1"
                            placeholder="Enter Mots de Passe" name="current_password">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Nouveaux Mots de Passe</label>
                        <input type="password" class="form-control" id="exampleInputPassword1"
                            placeholder="Enter Mots de Passe" name="password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">confirmé Mots de Passe</label>
                        <input type="password" class="form-control" id="exampleInputPassword1"
                            placeholder="Enter confirmé Mots de Passe" name="password_confirmation">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Sauvegarder les modifications</button>

                </div>
            </form>

        </div>
    </div>
</div> 