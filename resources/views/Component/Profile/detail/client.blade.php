@extends('Layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/backoffice">Home</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <style>
        .image-with-text {
            position: relative;
            display: inline-block;
            margin-bottom: 10px;
            /* Adjust as needed */
        }

        .image-text {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Semi-transparent background */
            color: white;
            padding: 5px;
            text-align: center;
        }
    </style>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('storage/avatars/' . $client->avatar) }}" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $client->lastName . ' ' . $client->firstName }}</h3>

                            <p class="text-muted text-center">{{ $client->email }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Number of Favorites</b> <a class="float-right">1,322</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Number of Content </b> <a class="float-right">543</a>
                                </li>

                            </ul>


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fa fa-plus mr-1"></i> Registration date</strong>

                            <p class="text-muted">
                                {{ $client->created_at }}
                            </p>

                            <hr>

                            <strong><i class="fa fa-plug mr-1"></i>Activation date</strong>

                            <p class="text-muted">{{ $client->created_at }}</p>

                            <hr>

                            <strong><i class="fa fa-retweet mr-1" aria-hidden="true"></i> Renewal Date</strong>

                            <p class="text-muted">{{ $client->updated_at }}</p>




                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity"
                                        data-toggle="tab">Objectives / Domain</a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Statistic</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <div class="row">
                                        <!-- /.col -->
                                        <div class="col-md-4">
                                            <div class="card card-outline card-primary">
                                                <div class="card-header">
                                                    <h3 class="card-title">Argent et Carrière</h3>
                                                </div>

                                            </div>
                                            <!-- /.card -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-8 ">
                                            <div class="row  align-items-center" style="gap: 2px">
                                                @foreach ($doamin1 as $doamin)
                                                    <div class="col">
                                                        <h3><span
                                                                class="badge badge-secondary">{{ $doamin->goals->goals }}</span>
                                                        </h3>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- /.col -->
                                        <div class="col-md-4">
                                            <div class="card card-outline card-success">
                                                <div class="card-header">
                                                    <h3 class="card-title">Santé et bien être</h3>
                                                </div>
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-8 ">
                                            <div class="row  align-items-center" style="gap: 2px">
                                                @foreach ($doamin2 as $doamin)
                                                    <div class="col">
                                                        <h3><span
                                                                class="badge badge-secondary">{{ $doamin->goals->goals }}</span>
                                                        </h3>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- /.col -->
                                        <div class="col-md-4">
                                            <div class="card card-outline card-warning">
                                                <div class="card-header">
                                                    <h3 class="card-title">Relations humaines</h3>
                                                </div>

                                            </div>
                                            <!-- /.card -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-8 ">
                                            <div class="row  align-items-center" style="gap: 2px">
                                                @foreach ($doamin3 as $doamin)
                                                    <div class="col">
                                                        <h3><span
                                                                class="badge badge-secondary">{{ $doamin->goals->goals }}</span>
                                                        </h3>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- /.col -->
                                        <div class="col-md-4">
                                            <div class="card card-outline card-danger">
                                                <div class="card-header">
                                                    <h3 class="card-title">Epanouissement personnel</h3>
                                                </div>

                                            </div>
                                            <!-- /.card -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-8 ">
                                            <div class="row  align-items-center" style="gap: 10px">
                                                @foreach ($doamin4 as $doamin)
                                                    <div class="col">
                                                        <h3><span
                                                                class="badge badge-secondary">{{ $doamin->goals->goals }}</span>
                                                        </h3>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="timeline">
                                    <!-- The timeline -->
                                    <div class="timeline timeline-inverse">
                                        <!-- timeline item -->
                                        <div>
                                            <div class="timeline-item">
                                                <h3 class="timeline-header">Ongoing Formation</h3>
                                                <div class="timeline-body">
                                                    @foreach ($filteredCourFormation as $filteredCourFormation)
                                                        <div class="image-with-text">
                                                            <img src="{{ asset('storage/upload/cour/image/' . $filteredCourFormation->CoursFormation->image) }}"
                                                                alt="..." style="height: 141px">
                                                            <div class="image-text">{{ $filteredCourFormation->title }}
                                                            </div>
                                                        </div>
                                                    @endforeach



                                                </div>
                                            </div>
                                        </div>
                                        <!-- END timeline item -->
                                    </div>


                                    <div class="timeline timeline-inverse">
                                        <!-- timeline item -->
                                        <div>
                                            <div class="timeline-item">

                                                <h3 class="timeline-header">Completed Formation</h3>

                                                <div class="timeline-body">
                                                    @foreach ($filteredCourVideoFormation as $filteredCourVideoFormation)
                                                        <div class="image-with-text">
                                                            <img src="{{ asset('storage/upload/cour/image/' . $filteredCourVideoFormation->CoursFormation->image) }}"
                                                                alt="..." style="height: 141px">
                                                            <div class="image-text">
                                                                {{ $filteredCourVideoFormation->title }}
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                        <!-- END timeline item -->

                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
