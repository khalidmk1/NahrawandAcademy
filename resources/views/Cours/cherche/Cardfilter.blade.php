<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="col-12">
                    <div class="card-tools">
                        <div class="input-group input-group-sm mb-2">
                            <input type="text" id="search_title" name="title" class="form-control float-right"
                                placeholder="Cherche titre">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <select class="form-control select2" name="user" id="search_user" style="width: 100%;">
                            <option selected="selected">Choisez Speaker</option>
                            @foreach ($RoleUser as $role)
                                @if ($role->user->userspeaker && in_array($role->user->userspeaker->type_speaker, ['Animateur', 'Formateur']))
                                    <option value="{{ $role->user->id }}">{{ $role->user->email }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <select class="form-control select2" name="category" id="search_category" style="width: 100%;">
                            <option selected="selected">Choisez Category</option>
                            @foreach ($category as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>


            </div>

        </div>
    </div>
</div>
