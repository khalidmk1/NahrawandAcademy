    <!-- Modal Create -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crée SousCatégorie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ Route('dashboard.souscategorie.store') }}" method="post">
                    @csrf

                    <div class="modal-body">


                        <div class="form-group">
                            <label>Category</label>
                            <select name="category" class="form-control select2" style="width: 100%;">
                                @foreach ($souscategories['categories'] as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- /.form-group -->



                        <div class="form-group">
                            <label for="categorie">Subcategory name</label>
                            <input value="{{ old('souscategorie') }}" type="text" class="form-control" id="categorie"
                                placeholder="Entre Subcategory name ..." name="souscategory_name">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default">Create</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!-- jQuery -->
