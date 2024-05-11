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


                        @include('Hisotry.cour.show')


                        <div class="card-footer">
                            <nav aria-label="Contacts Page Navigation">
                                <ul class="pagination justify-content-center m-0">
                                    <li class="page-item ">{{ $cours->links() }}</li>

                                </ul>
                            </nav>
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
