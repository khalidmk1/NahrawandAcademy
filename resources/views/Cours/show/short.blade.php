@extends('Layouts.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>View All Content</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="/"><a href="#">Home</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @include('Cours.cherche.short.Cardfilter')

    <section class="content">
        <div class="container-fluid">
            @include('Layouts.errorshandler')
            <div id="message_containe"></div>
            <div class="row">
                <div class="card card-default col-12">
                    <div class="card-header row">
                        <div class="col-4">
                            <h3 class="card-title">View Content</h3>
                        </div>
                        <div class="col-8">
                            <button type="button" style="float: right" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal">
                                <i class="fa fa-filter" aria-hidden="true"></i>
                            </button>

                        </div>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">


                        <div class="row row-cols-1 row-cols-md-3  event_conatine" id="resultcours">
                            @foreach ($shorts as $cour)
                                <div class="col ">

                                    <div class="card">
                                        <div class="position-relative">
                                            <img src="{{ asset('storage/upload/cour/image/' . $cour->image) }}"
                                                class="card-img-top about_img" alt="Skyscrapers" />

                                        </div>
                                        {{-- <img src="thumbnail.jpg" class="card-img-top" alt="Thumbnail"> --}}
                                        <div class="card-body">
                                            <h5 class="card-title"> {{ $cour->title }}</h5>
                                            <p class="card-text">
                                            <h4>
                                                @foreach ($cour->tags as $tag)
                                                    <span class="badge badge-info">{{ $tag }}</span>
                                                @endforeach
                                            </h4>
                                            </p>
                                            <a href="{{ Route('dashboard.short.detail', Crypt::encrypt($cour->id)) }}"
                                                class="btn btn-primary">Detail</a>
                                        </div>
                                    </div>

                                </div>
                            @endforeach


                        </div>



                        <div class="card-footer">
                            <nav aria-label="Contacts Page Navigation">
                                <ul class="pagination justify-content-center m-0">
                                    <li class="page-item ">{{ $shorts->links() }}</li>

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

                var url = '/backoffice/search/short'


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

                var url = '/backoffice/search/short'


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

                var url = '/backoffice/search/short'


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
