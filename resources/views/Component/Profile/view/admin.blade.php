@extends('Layouts.master')



@section('content')
    @include('Component.styling.css')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>View the administrator</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/backoffice">Home</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    @include('Layouts.errorshandler')

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card card-solid">


            <div class="card-header">

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" id="search_admin" name="table_search" class="form-control float-right"
                            placeholder="Nom">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>



            <div class="card-body pb-0">


                <div class="row" id="resultUser">

                    @foreach ($admins as $admin)
                        @include('Component.Profile.delete.admin')
                        <div class="col-lg-4 col-md-6 col-sm-6 oldUser">
                            <div class="text-center card-box bg-light">
                                <div class="member-card pt-2 pb-2">
                                    <div class="thumb-lg member-thumb mx-auto"><img
                                            src="{{ asset('storage/avatars/' . $admin->user->avatar) }}"
                                            style="height: 89px;width: 89px;"
                                            class="rounded-circle img-thumbnail" alt="profile-image"></div>
                                    <div class="">
                                        <h4>{{ $admin->user->firstName . ' ' . $admin->user->lastName }}</h4>
                                        <p class="text-muted">@Admin <span>| </span><span><a href="#"
                                                    class="text-pink">{{ $admin->user->email }}</a></span></p>
                                    </div>

                                </div>
                                <div class="text-right">
                                    <a style="float: left"
                                        href="{{ Route('dashboard.profile.edit', Crypt::encrypt($admin->user->id)) }}"
                                        class="btn btn-sm bg-warning">
                                        <img src="{{ asset('asset/update_icon.png') }}" style="height: 18px;"
                                            alt="update_icon">
                                    </a>
                                    <button type="button" data-toggle="modal"
                                        data-target="#delete_admin_{{ $admin->id }}" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    @endforeach


                </div>
                <!-- end row -->

            </div>


            <!-- /.card-body -->
            <div class="card-footer">
                <nav aria-label="Contacts Page Navigation">
                    <ul class="pagination justify-content-center m-0">
                        <li class="page-item ">{{ $admins->links() }}</li>

                    </ul>
                </nav>
            </div>
            <!-- /.card-footer -->
        </div>
    </section>


    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <script>
        $(document).ready(function() {

            $('#search_admin').on('keyup', function() {

                var admin = $(this).val()

                var url = '/backoffice/search/pofile'


                $.ajax({
                    url: url,
                    method: 'get',
                    data: {
                        'admin': admin,
                    },
                    success: function(data) {
                        console.log(data);

                        $('#resultUser').empty();

                        $('#resultUser').append(data)


                    },
                    error: function(error) {
                        console.log(error);

                    }
                });

            })

        })
    </script>
@endsection
