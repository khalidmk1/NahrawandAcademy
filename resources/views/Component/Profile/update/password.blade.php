@extends('Layouts.master_empty')

@section('content')

@include('Layouts.errorshandler')

    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="/" class="h1"><b>N</b>Ahrawand</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">You cannot access your back office, so you change your passwords</p>

            <form action="{{ Route('password-change.update') }}" method="post">
                @csrf
                @method('patch')


                <div class="form-group">
                    <label for="exampleInputPassword1"> Current password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Entre Current password"
                        name="current_password">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">New Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Entre Password"
                        name="password">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Confirm Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1"
                        placeholder="Entre Confirm Password" name="password_confirmation">
                </div>

                <button type="submit" class="btn btn-primary">Change Password</button>
            </form>


        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
@endsection


