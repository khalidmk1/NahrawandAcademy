@php
    use App\Models\RolePermission;

    $user_role = auth()->user()->userRole->role_id;
    $rolePermissionmodifiction = RolePermission::where([
        'role_id' => $user_role,
        'permission_id' => 2,
        'confirmed' => '1',
    ])->exists();
    $rolePermissiondelete = RolePermission::where([
        'role_id' => $user_role,
        'permission_id' => 3,
        'confirmed' => '1',
    ])->exists();

@endphp

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


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @include('Layouts.errorshandler')
            <div class="row">

                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('storage/avatars/' . $short->user->avatar) }}"
                                    style="height: 100px; width: 100px" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">
                                {{ $short->user->firstName . ' ' . $short->user->lastName }}</h3>

                            <p class="text-muted text-center">{{ $short->user->userspeaker->type_speaker }}</p>

                            {{--     <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Nomber des invite</b> <a class="float-right">{{ $short->count() }}</a>
                                </li>


                            </ul> --}}


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
                                        data-toggle="tab">Detail</a></li>
                                @if ($rolePermissionmodifiction)
                                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Modifier</a>
                                    </li>
                                @endif

                                 <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Parameter</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <!-- Post -->
                                    <div class="post">
                                        <div class="d-flex align-items-center">
                                            <h1 class="username">
                                                <div>{{ $short->title }}</div>
                                            </h1>

                                        </div>
                                        <!-- /.user-block -->

                                        <div class="row mb-3">
                                            <div class="col-sm-6">
                                                <iframe class="embed-responsive-item w-100 h-100 rounded border-dark"
                                                    src="{{ $short->video }}" allowfullscreen></iframe>

                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <img class="img-fluid"
                                                            src="{{ asset('storage/upload/cour/image/' . $short->image) }}"
                                                            alt="Photo">

                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col-sm-6">

                                                        <img class="img-fluid"
                                                            src="{{ asset('storage/upload/cour/image/flex/' . $short->image_flex) }}"
                                                            alt="Photo">
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.row -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->


                                        <!-- /.row -->
                                    </div>
                                    <!-- /.post -->


                                    <!-- Post -->
                                    <div class="post">
                                        <div class="d-flex">
                                            <i class="fa fa-tags" style="font-size: x-large" aria-hidden="true"></i>

                                            <div class="ml-2"><strong>Mots Clé.</strong></div>

                                        </div>
                                        <!-- /.user-block -->
                                        <div class="row" style="gap: 2px">
                                            @foreach ($short->tags as $tag)
                                                <h3 class="pt-1 ">
                                                    <span class="badge badge-info">{{ $tag }}</span>
                                                </h3>
                                            @endforeach
                                        </div>

                                    </div>
                                    <!-- /.post -->


                                    <!-- Post -->
                                    <div class="post">
                                        <div class="d-flex">

                                            <i class="fa fa-bullseye" style="font-size: x-large" aria-hidden="true"></i>
                                            <div class="ml-2"><strong>Objectifs.</strong></div>

                                        </div>
                                        <!-- /.user-block -->
                                        @foreach ($CoursGols as $goal)
                                            <h4>
                                                <span class="badge badge-info mt-2">{{ $goal->Goal->goals }}</span>
                                            </h4>
                                        @endforeach

                                    </div>
                                    <!-- /.post -->
                                </div>

                                @include('Cours.update.short')

                                    <div class="tab-pane" id="settings">
                                    <div class="form-group">
                                        <button type="submit" data-toggle="modal" data-target="#delete_podcast"
                                            class="btn btn-danger w-50">suprimer</button>
                                    </div>
                                    @include('Cours.delete.short')
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

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>


    <script>
        $(function() {

            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            })


            $('.update_video_podcast').on('click', function() {
                //tags
                var targetId = $(this).attr('data-id');
                //Initialize Select2 Elements
                $('.select2-' + targetId).select2();



            })

            //Initialize Select2 Elements
            $('.select2').select2();
            $('.select3').select2();


            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })


            $(document).ready(function() {
                //tags
                var tagInputEle = $('#tags-input');
                tagInputEle.tagsinput();
                var videoTags = $('.videoTags');
                videoTags.tagsinput();



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
