@extends('Layouts.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Management of speakers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/backoffice">Home</a></li>
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
                <div class="card card-default col-12">

                    <div class="card-header row">
                        <div class="col-6">
                            <h3 class="card-title">Create of speakers</h3>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <a href="{{ Route('dashboard.speaker.view') }}" class="btn btn-block btn-default w-25">
                                View the speakers
                            </a>
                        </div>
                    </div>

                    <!-- /.card-header -->
                    <form action="{{ Route('dashboard.speaker.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="form-group">
                                <label for="exampleInputFile">Avatar</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="avatar" class="custom-file-input"
                                            id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="profile_image">Profile Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="profile_image" class="custom-file-input"
                                            id="profile_image">
                                        <label class="custom-file-label" for="profile_image">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group clearfix text-center col-4">
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" name="isPopulaire" id="isPopulaire">
                                    <label for="isPopulaire">
                                        Popular
                                    </label>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="firstName">First name</label>
                                <input type="text" value="{{ old('firstName') }}" class="form-control" name="firstName"
                                    id="firstName" placeholder="Enter First Name ...">
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last name</label>
                                <input type="text" value="{{ old('lastName') }}" class="form-control" name="lastName"
                                    id="lastName" placeholder="Enter Last name ...">
                            </div>




                            <div class="form-group">
                                <label>Speaker biography</label>
                                <textarea class="form-control" name="biographie" rows="3" placeholder="Entrez biographie ..."></textarea>
                            </div>

                            <div class="form-group">
                                <label>Type of Speaker</label>
                                <select name="type_speaker" class="custom-select">
                                    <option value="Animateur">Animateur</option>
                                    <option value="Formateur">Formateur</option>
                                    <option value="Invité">Invité</option>
                                    <option value="Modérateur">Modérateur</option>
                                    <option value="Conférencier">Conférencier</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" value="{{ old('email') }}" name="email" class="form-control"
                                    id="exampleInputEmail1" placeholder="Enter email ...">
                            </div>

                            <div class="form-group">
                                <label for="facebook">Facebook</label>
                                <input type="url" value="{{ old('facebook') }}" class="form-control" name="facebook"
                                    id="facebook" placeholder="Enter Facebook URL ...">
                            </div>
                            <div class="form-group">
                                <label for="linkedin">Linkedin</label>
                                <input type="url" value="{{ old('linkedin') }}" class="form-control" name="linkedin"
                                    id="linkedin" placeholder="Enter Linkedin URL ...">
                            </div>
                            <div class="form-group">
                                <label for="instagram">Instagram</label>
                                <input type="url" value="{{ old('instagram') }}" class="form-control"
                                    name="instagram" id="instagram" placeholder="Enter Instagram URL ...">
                            </div>


                        </div>

                        <button type="submit" class="btn btn-block btn-info w-25 mb-3 ml-3" style="float: right">Create</button>

                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
