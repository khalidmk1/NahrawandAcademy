@extends('Layouts.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Content Quickly.</h1>
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
            <div class="row">
                <div class="card card-default col-12">
                    <div class="card-header row">
                        <div class="col-6">
                            <h3 class="card-title">Create Quickly.</h3>
                        </div>

                    </div>
                    <!-- /.card-header -->
                    <form action="{{ Route('dashboard.short.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" value="{{ old('title') }}" class="form-control" name="title"
                                    id="title" placeholder="Entrez Title ...">
                            </div>

                            <div class="form-group">
                                <label>Formateur</label>
                                <select class="form-control select2 " name="hostFormateur" style="width: 100%;">
                                    @foreach ($HostFromateur as $HostFromateur)
                                        <option value="{{ $HostFromateur->user->id }}">
                                            {{ $HostFromateur->user->email }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <!-- /.form-group -->

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Subcategory</label>
                                        <select class="form-control select2" id="souscategory_goals" name="cotegoryId"
                                            style="width: 100%;">
                                            <option value="">Choose Your Subcategory</option>
                                            @foreach ($souscategory as $souscategory)
                                                <option value="{{ $souscategory->category->id }}"
                                                    {{ old('cotegoryId') == $souscategory->category->id ? 'selected' : '' }}>
                                                    {{ $souscategory->category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-6">

                                    <div class="form-group">
                                        <label for="goals_option">Objectives</label>
                                        <select class="select3" name="gaols_id[]" multiple="multiple" id="goals_option"
                                            data-placeholder="Select a State" style="width: 100%;">

                                        </select>
                                    </div>
                                    <!-- /.form-group -->

                                </div>


                            </div>

                            <div class="form-group">
                                <label for="tags">Tags</label>
                                <input type="text" class="form-control" name="tags[]" id="tags-input" />
                            </div>


                            <div class="form-group">
                                <label for="image">Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="image">
                                    <label class="custom-file-label" for="image">Choose image</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="imageFlex">Image Flex</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imageFlex" id="image">
                                    <label class="custom-file-label" for="imageFlex">Choose image</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="video">Video</label>
                                <input type="url" value="{{ old('video') }}" class="form-control" name="video"
                                    id="video" placeholder="Entrez url video ...">
                            </div>





                        </div>

                        <button type="submit" class="btn btn-block btn-info w-25 mb-3 ml-3"
                            style="float: right">Create</button>

                    </form>





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
    </script>
@endsection
