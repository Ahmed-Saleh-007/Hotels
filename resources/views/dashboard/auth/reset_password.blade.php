@extends('dashboard.auth.layouts.app')

@section('title') {{ trans('admin.reset_password')}} @endsection

@section('content')


<div class="login-logo">
  <a href="{{ url('')}}"><img src="{{ url('')}}/design/adminlte/dist/img/logo.png" alt="logo"></a>
</div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Reset Password Now</p>

    

    <form action="{{ route('dashboard.reset_password', $data->token) }}" method="post"> 

      @csrf

      <div class="form-group has-feedback">
        <input type="email" name="email" value="{{ $data->email }}" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirmation">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
     
      <div class="row">
        
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Reset</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <hr>
    
    I have an account <a href="{{ route('dashboard.login') }}" class="text-center">Sign in</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

@endsection
