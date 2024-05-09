@extends('Layouts.master')

@section('content')
    <style>
        .card-img-top {
            height: 180px;
            object-fit: cover;
        }
    </style>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Voir Tout Les Contenus</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    @include('Cours.cherche.Cardfilter')

    <section class="content">
        <div class="container-fluid">
            @include('Layouts.errorshandler')
            <div id="message_containe"></div>
            <div class="row">
                <div class="card card-default col-12">
                    <div class="card-header row">
                        <div class="col-4">
                            <h3 class="card-title">Voir les Contenu</h3>
                        </div>
                        <div class="col-8">
                            <button type="button" style="float: right" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                <i class="fa fa-filter" aria-hidden="true"></i>
                            </button>

                        </div>

                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">


                        <div class="row row-cols-1 row-cols-md-3  event_conatine " id="resultcours">
                            @foreach ($cours as $cour)
                                <div class="col ">

                                    <div class="card">
                                        <div class="position-relative">
                                            <h5
                                                class="position-absolute badge {{ $cour->isActive ? 'badge-success' : '' }} ">
                                                {{ $cour->isActive ? 'Active' : '' }}</h5>
                                            <h5 class="position-absolute badge {{ $cour->isComing ? 'badge-warning' : '' }}"
                                                style="right: 0">
                                                {{ $cour->isComing ? 'A Venir' : '' }}</h5>

                                            @if ($cour->cours_type == 'conference')
                                                <img src="{{ asset('storage/upload/cour/image/' . $cour->CoursConference->image) }}"
                                                    class="card-img-top about_img" alt="Skyscrapers" />
                                            @elseif ($cour->cours_type == 'podcast')
                                                <img src="{{ asset('storage/upload/cour/image/' . $cour->CoursPodcast->image) }}"
                                                    class="card-img-top about_img" alt="Skyscrapers" />
                                            @elseif($cour->cours_type == 'formation' && $cour->CoursFormation)
                                                <img src="{{ asset('storage/upload/cour/image/' . $cour->CoursFormation->image) }}"
                                                    class="card-img-top about_img" alt="Skyscrapers" />
                                            @endif

                                        </div>

                                        <div class="card-body">
                                            <h5 class="card-title"> {{ $cour->title }}</h5>
                                            <p class="card-text">{{ Str::limit($cour->description, '100', '...') }}...</p>
                                            <a href="{{ Route('dashboard.cours.show', Crypt::encrypt($cour->id)) }}"
                                                class="btn btn-primary">Detail</a>
                                        </div>
                                    </div>

                                </div>
                            @endforeach


                        </div>



                        <div class="card-footer">
                            <nav aria-label="Contacts Page Navigation">
                                <ul class="pagination justify-content-center m-0">
                                    <li class="page-item ">{{ $cours->links() }}</li>

                                </ul>
                            </nav>
                        </div>



                    </div>
                </div>


            </div>
    </section>

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script>
        $(function() {

            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            })

            //Initialize Select2 Elements
            $('.select2').select2();
            $('.select3').select2();


            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })


        })

        $(document).ready(function() {

            //search with title
            $('#search_title').on('keyup', function() {

                var title = $(this).val()

                var url = '/backoffice/search/cours'


                $.ajax({
                    url: url,
                    method: 'get',
                    data: {
                        'title': title,
                    },
                    success: function(data) {
                        console.log(data.output);

                        $('#resultcours').empty();

                        $('#resultcours').append(data.output)


                    },
                    error: function(error) {
                        console.log(error);

                    }
                });

            })

            //search with user speaker

            $('#search_user').on('change', function() {

                var user = $(this).val()

                var url = '/backoffice/search/cours'


                $.ajax({
                    url: url,
                    method: 'get',
                    data: {
                        'user': user,
                    },
                    success: function(data) {
                        console.log(data.output);

                        $('#resultcours').empty();

                        $('#resultcours').append(data.output)


                    },
                    error: function(error) {
                        console.log(error);

                    }
                });

            })


            //search with category
            $('#search_category').on('change', function() {

                var category = $(this).val()

                var url = '/backoffice/search/cours'


                $.ajax({
                    url: url,
                    method: 'get',
                    data: {
                        'category': category,
                    },
                    success: function(data) {
                        console.log(data.output);

                        $('#resultcours').empty();

                        $('#resultcours').append(data.output)


                    },
                    error: function(error) {
                        console.log(error);

                    }
                });

            })

        })
    </script>
@endsection
