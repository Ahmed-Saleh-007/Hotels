@extends('dashboard.auth.layouts.app')

@section('title') {{ trans('admin.login')}} @endsection


@section('content')

<div class="login-logo">
  <a href="{{ url('')}}"><img src="{{ url('')}}/design/adminlte/dist/img/logo.png" alt="logo"></a>
</div>
<!-- /.login-logo -->

<div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    @if(session()->has('error'))
    @push('js')
    <script>
        toastr.error('{{ session('error') }}', 'Error Alert', {timeOut: 10000, closeButton: true, progressBar: true})
    </script>
    @endpush
    @endif
    @if(session()->has('success'))
    @push('js')
    <script>
        toastr.success('{{ session('success') }}', 'Success Alert', {timeOut: 10000, closeButton: true, progressBar: true})
    </script>
    @endpush
    @endif
    <form method="post"  action="{{ route('dashboard.login') }}">
        {!! csrf_field() !!}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" id="email" autocomplete="off">
            <label for="email">Email</label>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

          </div>

          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
            <label for="password">Password</label>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

          </div>

        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="remember" name="rememberme" value="1">
                  <label for="remember">Remember Me</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div>
            <!-- /.col -->
        </div>
    </form>

    <a href="{{ route('dashboard.forgot_password')}}" class="forget">I forgot my password</a><br>

    <a href="{{ route('dashboard.registration.create')}}" class="register">Create new account <i class="fa fa-arrow-right"></i> </a>

</div>
<!-- /.login-box-body -->
    
@endsection


