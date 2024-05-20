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
    </style>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Speaker Video Content</h1>
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
            <div id="ajax-errors-container"></div>
            <div class="row">
                <div class="card card-default col-12">
                    <div class="card-header row">
                        <div class="col-6">
                            <h3 class="card-title">Create Video</h3>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{ Route('dashboard.store.video') }}" id="create_videos" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <input hidden type="text" name="confrenceId" value="{{ $confrenceInfo['conferenceId'] }}">

                            <div class="form-group">
                                <label for="titleVideo">Title</label>
                                <input type="text" value="{{ old('titleVideo') }}" class="form-control" name="titleVideo"
                                    id="titleVideo" placeholder="Entre title Video ...">
                            </div>

                            <!-- textarea -->
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="descriptionVideo" rows="3" placeholder="Entre Description Video ..."></textarea>
                            </div>

                            <div class="form-group">
                                <label for="guests">Conférencies</label>
                                <select class="select3" name="guestIds[]" multiple="multiple" id="guests"
                                    data-placeholder="Select a State" style="width: 100%;">
                                    @foreach ($confrenceInfo['Guest'] as $guest)
                                        <option value="{{ $guest->user->id }}">{{ $guest->user->email }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <!-- /.form-group -->

                         

                            <div class="form-group">
                                <label for="image2">Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="image2" required>
                                    <label class="custom-file-label" for="image2">Choose file...</label>
                                    <div class="invalid-feedback">Example invalid custom file feedback</div>
                                </div>
                            </div>
                            

                            <div class="form-group">
                                <label for="tags_video">Tags</label>
                                <input type="text" class="form-control" name="videoTags[]" id="tags-input" />
                            </div>

                            <div class="form-group">
                                <label for="videoConference">Video</label>
                                <input type="url" value="{{ old('videoConference') }}" class="form-control"
                                    name="videoConference" id="videoConference" placeholder="Enter url video Conférence ...">
                            </div>

                            <!-- time Picker -->
                            <div class="form-group">
                                <label for="videoduration">Duration</label>
                                <input type="time" class="form-control" id="videoduration" name="videoduration"
                                    value="00:00:00" step="1">
                            </div>

                        </div>

                        <button type="submit" class="btn btn-block btn-dark w-50 mb-3 ml-3">Create</button>
                    </form>

                    <div class="row row-cols-1 row-cols-md-3 vidoeContent">



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


            //Initialize Select2 Elements
            $('.select2').select2();
            $('.select3').select2();


            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })



            $('#create_videos').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    success: function(response) {

                        console.log(response);

                        $('#create_videos')[0].reset();
                        tagInputEle.tagsinput('removeAll');

                        $('.vidoeContent').html(response.output)
                        $('body,html').animate({
                            scrollTop: $('body').height()
                        }, 800);


                    },
                    error: function(error) {
                        handleErrors(error);
                        $('html, body').animate({ scrollTop: 0 }, 'slow');
                    },
                })


            })


            function handleErrors(error) {
                // Clear previous errors
                $('#ajax-errors-container').empty();

                // Append new errors to the container
                if (error.responseJSON && error.responseJSON.errors) {
                    var errors = error.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $('#ajax-errors-container').append(
                            '<div class="alert  alert-warning alert-dismissible fade show ml-1" role="alert"><i class="icon fas fa-exclamation-triangle"></i>  ' +
                            value +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                        );
                    });
                }
            }



        })
    </script>
@endsection
