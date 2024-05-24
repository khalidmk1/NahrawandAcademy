@extends('Layouts.master')

@section('content')
    <style>
        .bootstrap-tagsinput {
            border: #00000029 solid 2px;
            padding: 4px;
            border-radius: 3px;

        }

        .bootstrap-tagsinput:first-child {
            border: none,

        }

        .bootstrap-tagsinput .tag {
            background: rgb(163, 159, 154);
            padding: 4px;
            font-size: 14px;
        }

        .select2-container--default .select2-selection--single {
            height: 40px !important;
        }
    </style>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>View Detail</h1>
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
            @include('Layouts.errorshandler')
            <div class="row">
                <div class="col-md-3">
                    @foreach ($event->userevent as $eventuser)
                        <div class="row">
                            <div class="col">
                                <!-- Profile Image -->
                                <div class="card card-primary card-outline">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <img class="profile-user-img img-fluid img-circle"
                                                src="{{ asset('storage/avatars/' . $eventuser->user->avatar) }}"
                                                alt="User profile picture" style="height: 100px; width: 100px">
                                        </div>

                                        <h3 class="profile-username text-center">
                                            {{ $eventuser->user->firstName . ' ' . $eventuser->user->lastName }}</h3>

                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    @endforeach
                </div>


                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" id="pills-home-tab" data-toggle="pill"
                                        href="#pills-home" role="tab" aria-controls="pills-home"
                                        aria-selected="true">Detail</a></li>

                            

                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                    aria-labelledby="pills-home-tab">
                                    <!-- Post -->
                                    <div class="post">
                                        <div class="d-flex align-items-center">
                                            <h1 class="username">
                                                <div>{{ $event->title }}</div>

                                            </h1>
                                        </div>
                                        <!-- /.user-block -->

                                        <div class="row mb-3 justify-content-center align-items-center">

                                            <div class="row mb-3">

                                                <div class="col-sm-12">
                                                    <img class="img-fluid"
                                                    src="{{ asset('storage/upload/event/664f71bf5cb81_cov final_.png') }}"
                                                        alt="Photo">

                                                </div>
                                                <!-- /.col -->


                                            </div>
                                            <!-- /.row -->


                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.post -->

                                    <!-- Post -->
                                    <div class="post">
                                        <div class="d-flex">
                                            <i class="fa fa-exclamation-circle" style="font-size: x-large"
                                                aria-hidden="true"></i>
                                            <div class="ml-2"><strong>Description.</strong></div>

                                        </div>
                                        <!-- /.user-block -->
                                        <p>
                                            {{ $event->description }}
                                        </p>
                                    </div>
                                    <!-- /.post -->



                                    <!-- Post -->
                                    <div class="post clearfix">





                                        {{-- <div class="row">
                                            @foreach ($coursFormation->CoursFormationVideo as $video)
                                                @include('Cours.update.formation.video.update.video')
                                                @include('Cours.update.formation.video.delete.delete')

                                                <div class="col-12">
                                                    <!-- Card -->

                                                    <div class="card">

                                                        <div class="row">
                                                            <div class="col-md-6" style="height: 230px;">
                                                                <iframe
                                                                    class="embed-responsive-item w-100 h-100 rounded border-dark"
                                                                    src="{{ $video->video }}" allowfullscreen></iframe>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="text-white  m-2 "
                                                                    style="border-radius: 20px ; background: #343a4070 ">
                                                                    <div class="position-relative ">
                                                                        @if ($rolePermissionmodifiction)
                                                                            <!-- Button trigger modal -->
                                                                            <button style="right: 0;"
                                                                                class="btn btn-sm bg-warning position-absolute update_video_btn"
                                                                                data-toggle="modal"
                                                                                data-id="{{ $video->id }}"
                                                                                data-target="#update_video_{{ $video->id }}">
                                                                                <img src="{{ asset('asset/update_icon.png') }}"
                                                                                    style="height: 18px;"
                                                                                    alt="update_icon">
                                                                            </button>
                                                                        @endif


                                                                        @if ($rolePermissiondelete)
                                                                            <button type="button" data-toggle="modal"
                                                                                data-target="#delete_video_{{ $video->id }}"
                                                                                class="btn btn-sm btn-danger position-absolute"
                                                                                style="float: right"
                                                                                data-id="{{ $video->id }}">
                                                                                <i class="fa fa-trash"
                                                                                    aria-hidden="true"></i>
                                                                            </button>
                                                                        @endif


                                                                    </div>

                                                                    <div class="card-body"
                                                                        style="background: url('{{ asset('storage/upload/cour/video/image/' . $video->image) }}')">


                                                                        <div class="p-3"
                                                                            style="background-image: #04040439">
                                                                            <h3 class="pt-2">
                                                                                {{ $video->title }}
                                                                            </h3>

                                                                            @foreach ($video->tags as $tag)
                                                                                <h2 class="badge badge-info">
                                                                                    {{ $tag }}
                                                                                </h2>
                                                                            @endforeach

                                                                            <p class="text">{{ $video->description }}.
                                                                            </p>

                                                                            <p class="text-right">Views :
                                                                                {{ $video->videoProgressFormation->count() }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Content -->


                                                    </div>
                                                    <!-- Card -->
                                                </div>
                                            @endforeach

                                        </div> --}}
                                    </div>
                                    <!-- /.post -->


                                </div>

                



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
            $('select[name="hostPodcast"]').trigger('change');

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            $(document).ready(function() {

                $('.update_video_btn').on('click', function() {
                    //tags
                    var targetId = $(this).attr('data-id');
                    var tagVideo = $('#tags-input-' + targetId);
                    tagVideo.tagsinput();

                })
                var tagCour = $('#tags-input');
                tagCour.tagsinput();



                //search live for goals

                $('#souscategory_goals').on('change', function() {
                    var sousCategorieId = $(this).val();

                    $.ajax({
                        url: '/backoffice/goals-bySouscategory/' +
                            sousCategorieId,
                        method: 'GET',
                        success: function(response) {
                            var goalsSelect = $('#goals_option');
                            goalsSelect.empty();

                            /* window.navigate("page.html"); */

                            console.log(response);

                            $.each(response.goals, function(index, goal) {
                                goalsSelect.append($('<option>', {
                                    value: goal.id,
                                    text: goal.goals
                                }));

                                console.log(goal.id);
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching goals:', error);
                        }
                    });
                });






            })

        })
    </script>
@endsection
