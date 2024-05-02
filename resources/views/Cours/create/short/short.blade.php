@extends('Layouts.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Mange Shourt Contenu Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>



    <section class="content">
        <div class="container-fluid">
            @include('Layouts.errorshandler')
            <div class="row">
                <div class="card card-default col-12">
                    <div class="card-header row">
                        <div class="col-6">
                            <h3 class="card-title">Crée Cotenu</h3>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <a href="{{ Route('dashboard.view.admin') }}" class="btn btn-block btn-primary w-25">
                                List Contenu
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{ Route('dashboard.short.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Titre</label>
                                <input type="text" value="{{ old('title') }}" class="form-control" name="title"
                                    id="title" placeholder="Entrez Titre ...">
                            </div>

        

                            <div class="form-group">
                                <label for="tags">Mots Clé</label>
                                <input type="text" class="form-control" name="tags[]" id="tags-input" />
                            </div>

                          
                            <div class="form-group">
                                <label for="image">Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="image">
                                    <label class="custom-file-label"  for="image">Choisez image</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="video">Video</label>
                                <input type="url" value="{{ old('video') }}" class="form-control" name="video"
                                id="video" placeholder="Entrez url video ...">
                            </div>
                           




                        </div>

                        <button type="submit" class="btn btn-block btn-info w-25 mb-3 ml-3" style="float: right">Crée
                            Contnu</button>

                    </form>





                </div>

            </div>
        </div>
        </div>
    </section>
 <!-- jQuery -->
 <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

 <script>
     $(document).ready(function() {
          //tags
          var tagInputEle = $('#tags-input');
            tagInputEle.tagsinput();
     })
 </script>

@endsection
