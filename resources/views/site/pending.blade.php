@extends('dashboard.auth.layouts.app')

@section('title') {{ trans('admin.reset_password')}} @endsection

@section('content')


<div class="login-logo">
  <a href="{{ url('')}}"><img src="{{ url('')}}/design/adminlte/dist/img/logo.png" alt="logo"></a>
</div>
  <!-- /.login-logo -->
  <div class="login-box-body" style="background-color: #62b988;">
    <p class="login-box-msg"></p>

    <div class="alert" style="color: white; font-weight: 600; text-align: center;background-color: #62b988;">you are pending, please wait for approving!!</div>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

@endsection
