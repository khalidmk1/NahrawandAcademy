@extends('Layouts.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Administrative management</h1>
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
                            <h3 class="card-title">Create an administrator</h3>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <a href="{{ Route('dashboard.view.admin') }}" class="btn btn-block btn-default w-25">
                                View administrators
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{ Route('dashboard.admin.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputFile">Avatar</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" name="avatar" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                  </div>
                                  <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                  </div>
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
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" value="{{ old('email') }}" name="email" class="form-control"
                                    id="exampleInputEmail1" placeholder="Enter email ...">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                                    placeholder="Enter Password ...">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm the password</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    id="password_confirmation" placeholder="Enter Confirm the password ...">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-block btn-info w-25 mb-3 ml-3" style="float: right">Create Admin</button>

                    </form>

                </div>
            </div>
        </div>

    </section>
@endsection
