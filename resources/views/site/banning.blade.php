@extends('dashboard.auth.layouts.app')

@section('title') {{ trans('admin.banned')}} @endsection

@section('content')


<div class="login-logo">
  <a href="{{ url('')}}"><img src="{{ url('')}}/design/adminlte/dist/img/logo.png" alt="logo"></a>
</div>
  <!-- /.login-logo -->
  <div class="login-box-body" style="background-color: #ff5b5b;">
    <p class="login-box-msg"></p>

    

    <div class="alert" style="color: white; font-weight: 600; text-align: center;background-color: #ff5b5b;">you are banning, you can not login now!!</div>
  


    
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

@endsection
