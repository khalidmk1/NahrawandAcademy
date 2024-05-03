@extends('Layouts.master')

@section('content')
    <style>
        .div.dataTables_wrapper div.dataTables_filter input {
            height: 30px !important;
        }
    </style>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manger Client</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">


                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">DataTable with default features</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Email</th>
                                        <th>Prénom</th>
                                        <th>Nom</th>
                                        <th>Status</th>
                                        <th>Date Abonnement</th>
                                        <th>Date Renouvellement</th>
                                        <th>Voir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Clients as $client)
                                        <tr>
                                            <td>{{ $client->user->email }}</td>
                                            <td>{{ $client->user->firstName }}</td>
                                            <td>{{ $client->user->lastName }}</td>
                                            <td>No</td>
                                            <td>{{ $client->user->created_at }}</td>
                                            <td>{{ $client->user->updated_at }}</td>
                                            <td>
                                                <a class="btn btn-block btn-info"
                                                    href="{{ Route('dashboard.client.detail' , Crypt::encrypt($client->user->id)) }}"><i class="fa fa-eye"
                                                        aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
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
@endsection
