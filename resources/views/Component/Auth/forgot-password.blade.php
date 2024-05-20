@extends('Layouts.master_empty')

@section('content')
    @include('Layouts.errorshandler')

    <div class="login-logo">
        <a href="/"><b>N</b>AHRAWAND</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Have you forgotten your password? Here, you can easily recover a new password.</p>

            <form id="forget_password" action="{{ Route('password.email') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Request a new password</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mt-3 mb-1">
                <a href="{{ Route('login.create') }}">Login</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
@endsection
