@extends('Layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update your profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    @include('Component.Profile.update.changepassword')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid ">
            @include('Layouts.errorshandler')
            <div class="row ">
                <!-- left column -->
                <div class="col-md-8 m-auto">
                    <!-- general form elements -->
                    <div class="card card-primary card-outline">

                        <!-- form start -->
                        <form action="{{ Route('dashboard.profile.update', Crypt::encrypt($user->id)) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="card-body">


                                <div class="form-group">
                                    <label for="avatar">avatar</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="avatar" id="avatar">
                                        <label class="custom-file-label" for="avatar">Choisez image</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="profile_image">Profile Image</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="profile_image"
                                            id="profile_image">
                                        <label class="custom-file-label" for="profile_image">Upload</label>
                                    </div>
                                </div>

                                @if ($user->userRole->role_id == 3)
                                    <div class="form-group clearfix text-center col-4">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" name="isPopulaire" id="isPopulaire"
                                                {{ $user->is_popular == 1 ? 'checked' : '' }}>
                                            <label for="isPopulaire">
                                                Popular
                                            </label>
                                        </div>

                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="firstName"> Last name</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName"
                                        value="{{ old('firstName', $user->firstName) }}">

                                </div>
                                <div class="form-group">
                                    <label for="lastName">First name</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName"
                                        value="{{ old('lastName', $user->lastName) }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                        value="{{ old('email', $user->email) }}">
                                </div>

                                @if ($user->userRole->role_id == 3)
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label for="biographie">Biography</label>
                                        <textarea class="form-control" id="biographie" rows="3" name="biographie" placeholder="Enter ...">{{ $user->userspeaker->biographie }}</textarea>
                                    </div>



                                    <div class="form-group">
                                        <label for="facebook">facebook</label>
                                        <input type="url" value="{{ old('facebook', $user->userspeaker->faceboock) }}"
                                            class="form-control" name="facebook" id="facebook"
                                            placeholder="Entrez url reseau social ...">
                                    </div>
                                    <div class="form-group">
                                        <label for="linkedin">linkedin</label>
                                        <input type="url" value="{{ old('linkedin', $user->userspeaker->linkdin) }}"
                                            class="form-control" name="linkedin" id="linkedin"
                                            placeholder="Entrez url reseau social ...">
                                    </div>
                                    <div class="form-group">
                                        <label for="instagram">instagram</label>
                                        <input type="url" value="{{ old('instagram', $user->userspeaker->instagram) }}"
                                            class="form-control" name="instagram" id="instagram"
                                            placeholder="Entrez url reseau social ...">
                                    </div>
                                @endif

                            </div>
                            <!-- /.card-body -->


                            <div class="card-footer">
                                <button type="submit" class="btn btn-block btn-warning w-25" style="float: right">Mettre
                                    à
                                    jour</button>
                                @if (auth()->user()->id == $user->id)
                                    <button type="button" data-toggle="modal" data-target="#exampleModal"
                                        class="btn btn-primary">Change Password</button>
                                @endif
                            </div>


                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
