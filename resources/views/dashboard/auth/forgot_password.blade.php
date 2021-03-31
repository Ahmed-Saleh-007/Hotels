@extends('dashboard.auth.layouts.app')

@section('title') {{ trans('admin.forgot_password')}} @endsection

@section('content')
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Reset Account</p>

        @if(session()->has('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($errors->all())

          @foreach ($errors->all() as $error)
          
            <div class="alert alert-danger">{{ $error }}</div>
              
          @endforeach
            
        @endif


      <form action="{{ route('dashboard.forgot_password') }}" method="post"> 

        @csrf

        <div class="form-group has-feedback">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
      
        <div class="row">
          
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Reset</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
  
      I have not account <a href="{{ route('dashboard.registration.create') }}" class="text-center">Sign up</a>

    </div>
    <!-- /.login-box-body -->
@endsection
  