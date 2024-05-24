@extends('Layouts.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Events Page</h1>
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
                            <h3 class="card-title">Create Event.</h3>
                        </div>

                        <div class="col-6 d-flex justify-content-end">
                            <a href="{{ Route('dashboard.event') }}" class="btn btn-block btn-default w-25">
                                View Events
                            </a>
                        </div>

                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">

                        <form action="{{ Route('dashboard.event.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="text">Ttile</label>
                                <input type="text" name="title" class="form-control" id="text"
                                    placeholder="Enter Title ...">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" rows="3" placeholder="Enter ..."></textarea>
                            </div>

                            <div class="form-group">
                                <label>Speakers</label>
                                <select class="select2" name="speakerID[]" multiple="multiple"
                                    data-placeholder="Select a State" style="width: 100%;">
                                    @foreach ($Speakers as $Speaker)
                                        <option value="{{ $Speaker->user->id }}">
                                            {{ $Speaker->user->lastName . ' ' . $Speaker->user->firstName }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Date Start:</label>
                                <div class="input-group date" id="DateStart" data-target-input="nearest">
                                    <input type="text" name="datestart" class="form-control datetimepicker-input"
                                        data-target="#DateStart" />
                                    <div class="input-group-append" data-target="#DateStart" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Date End:</label>
                                <div class="input-group date" id="DateEnd" data-target-input="nearest">
                                    <input type="text" name="Dateend" class="form-control datetimepicker-input"
                                        data-target="#DateEnd" />
                                    <div class="input-group-append" data-target="#DateEnd" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input"
                                            id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="url">Event Url</label>
                                <input type="url" name="url" class="form-control" id="url"
                                    placeholder="Enter Title ...">
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
    <script src="../../plugins/jquery/jquery.min.js"></script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            //Date and time picker
            $('#DateStart').datetimepicker({
                icons: {
                    time: 'far fa-clock'
                }
            });
            //Date and time picker
            $('#DateEnd').datetimepicker({
                icons: {
                    time: 'far fa-clock'
                }
            });

        })
    </script>
@endsection
