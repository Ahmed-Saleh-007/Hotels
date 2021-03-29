@extends('dashboard.auth.layouts.app')

@section('title') {{ trans('admin.register')}} @endsection

@section('content')
    
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign up to create new account</p>

        @if (session()->has('success'))

            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            
        @endif
        
        <form method="POST" action="{{ route('dashboard.register') }}" enctype="multipart/form-data">

            @csrf

            <div class="input-group mb-3">
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" autocomplete="off">
                <label for="name">Name In English</label>
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-user"></span>
                    </div>
                </div>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="input-group mb-3">

                <select name="gender" class="form-control @error('gender') is-invalid @enderror" id="">
                    <option value="">...</option>
                    <option value="male">{{ trans('admin.male') }}</option>
                    <option value="female">{{ trans('admin.female') }}</option>
                </select>

                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-venus-mars"></span>
                    </div>
                </div>

                @error('gender')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            
            </div>

            <div class="input-group mb-3">

                <select name="country" class="form-control @error('country') is-invalid @enderror" id="">
                    <option value="">...</option>
                    @foreach (get_countries() as $country)
                        <option value="{{ $country }}">{{ $country }}</option>      
                    @endforeach
                </select>
    
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                    </div>
                </div>

                @error('country')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            
            </div>
            
            <div class="form-group">

                <input type="file" name="avatar_image" class="form-control" id="avatar_image" onchange="doAfterSelectImage(this)" style="display: none">

                <label for="avatar_image">

                    <img src="{{ url('images/image.png') }}" class="img-thumbnail" alt="" width="80" id="post_user_image_">
                </label>
                
            </div>

            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" autocomplete="off">
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

            <div class="input-group mb-3">
                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation">
                <label for="password_confirmation">Confirm Password</label>
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                    </div>
                </div>

                @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="row">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign Up</button>
                </div>
                <!-- /.col -->
            </div>

        </form>

        <a href="{{ route('dashboard.login')}}" class="signin">already member ?</a><br>

    </div>
    <!-- /.login-box-body -->

@endsection

