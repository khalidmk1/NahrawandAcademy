@extends('Layouts.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>History</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Compose</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @include('Hisotry.chereche.ModalCours')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @include('Layouts.errorshandler')
            <div class="row">


                <div class="card card-default col-12">
                    <div class="card-header row">
                        <div class="col-4">
                            <h3 class="card-title">Voir les Contenu</h3>
                        </div>
                        {{--  <div class="col-8">
                            <button type="button" style="float: right" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal">
                                <i class="fa fa-filter" aria-hidden="true"></i>
                            </button>

                        </div> --}}
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body" id="resultcours">


                        {{--   @include('Hisotry.cour.show')


                        <div class="card-footer">
                            <nav aria-label="Contacts Page Navigation">
                                <ul class="pagination justify-content-center m-0">
                                    <li class="page-item ">{{ $cours->links() }}</li>

                                </ul>
                            </nav>
                        </div>
 --}}

                        <!-- ./row -->
                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <div class="card card-primary card-tabs">
                                    <div class="card-header p-0 ">
                                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="custom-tabs-one-Content-tab"
                                                    data-toggle="pill" href="#custom-tabs-one-Content" role="tab"
                                                    aria-controls="custom-tabs-one-home" aria-selected="true">Content</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-one-Quicly-tab"
                                                    data-toggle="pill" href="#custom-tabs-one-Quicly" role="tab"
                                                    aria-controls="custom-tabs-one-Quicly" aria-selected="true">Quickly</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-one-Categoty-tab" data-toggle="pill"
                                                    href="#custom-tabs-one-Categoty" role="tab"
                                                    aria-controls="custom-tabs-one-Categoty"
                                                    aria-selected="false">Category</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-one-SubCategory-tab" data-toggle="pill"
                                                    href="#custom-tabs-one-SubCategory" role="tab"
                                                    aria-controls="custom-tabs-one-SubCategory"
                                                    aria-selected="false">SubCategory</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-one-Program-tab" data-toggle="pill"
                                                    href="#custom-tabs-one-Program" role="tab"
                                                    aria-controls="custom-tabs-one-Program"
                                                    aria-selected="false">Program</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-one-Objectives-tab" data-toggle="pill"
                                                    href="#custom-tabs-one-Objectives" role="tab"
                                                    aria-controls="custom-tabs-one-Objectives"
                                                    aria-selected="false">Objectives</a>
                                            </li>

                                            {{-- <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-one-Speaker-tab" data-toggle="pill"
                                                    href="#custom-tabs-one-Speaker" role="tab"
                                                    aria-controls="custom-tabs-one-Speaker"
                                                    aria-selected="false">Speaker</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-one-Manager-tab" data-toggle="pill"
                                                    href="#custom-tabs-one-Manager" role="tab"
                                                    aria-controls="custom-tabs-one-Manager"
                                                    aria-selected="false">Manager</a>
                                            </li> --}}

                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="custom-tabs-one-tabContent">
                                            <div class="tab-pane fade show active" id="custom-tabs-one-Content"
                                                role="tabpanel" aria-labelledby="custom-tabs-one-Content-tab">
                                                @include('Hisotry.cour.show')
                                            </div>
                                            <div class="tab-pane fade" id="custom-tabs-one-Quicly"
                                                role="tabpanel" aria-labelledby="custom-tabs-one-Quicly-tab">
                                                @include('Hisotry.cour.Quicly')
                                            </div>
                                            <div class="tab-pane fade" id="custom-tabs-one-Categoty" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-Categoty-tab">
                                                @include('Hisotry.Filter.Category')
                                            </div>
                                            <div class="tab-pane fade" id="custom-tabs-one-SubCategory" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-SubCategory-tab">
                                               @include('Hisotry.Filter.SubCategory')
                                            </div>
                                            <div class="tab-pane fade" id="custom-tabs-one-Program" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-Program-tab">
                                                @include('Hisotry.Filter.Program')
                                            </div>
                                            <div class="tab-pane fade" id="custom-tabs-one-Objectives" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-Objectives-tab">
                                               @include('Hisotry.Filter.Objectives')
                                            </div>
                                            {{-- <div class="tab-pane fade" id="custom-tabs-one-Speaker" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-Speaker-tab">
                                                Speaker
                                                Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna,
                                                iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor.
                                                Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique.
                                                Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat
                                                urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at
                                                consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse
                                                platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                                            </div>
                                            <div class="tab-pane fade" id="custom-tabs-one-Manager" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-Manager-tab">
                                                Manager
                                                Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna,
                                                iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor.
                                                Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique.
                                                Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat
                                                urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at
                                                consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse
                                                platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                                            </div> --}}
                                        </div>
                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>
                        </div>



                    </div>
                </div>


                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <script>
        $(function() {
            $(".example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            //search with title
            $('#search_title').on('keyup', function() {

                var title = $(this).val()

                var url = '/backoffice/search/history'


                $.ajax({
                    url: url,
                    method: 'get',
                    data: {
                        'title': title,
                    },
                    success: function(data) {
                        console.log(data);

                        $('#resultcours').empty();

                        $('#resultcours').append(data)


                    },
                    error: function(error) {
                        console.log(error);

                    }
                });

            })
        })
    </script>
@endsection
