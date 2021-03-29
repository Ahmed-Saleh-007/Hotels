<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ trans('admin.Register')}}</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ url('') }}/design/adminlte/plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{ url('') }}/design/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- toastr -->
        <link rel="stylesheet" href="{{url('')}}/design/adminlte/plugins/toastr/toastr.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ url('') }}/design/adminlte/dist/css/adminlte.min.css">
        <!-- custom style -->
        <link rel="stylesheet" href="{{ url('') }}/design/adminlte/dist/css/custom_admin_form.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

        <link rel="icon" href="" />
        
    </head>
    <body class="hold-transition login-page auth-background"  style="background-image:url('{{url('/design/adminlte/dist/img/auth-background.jpg')}}')">
        <div class="login-box">
            <div class="login-logo">
                {{-- <a href="{{ url('')}}"><img src="{{ url('')}}/design/adminlte/dist/img/logo.png" alt="sehaty"></a> --}}
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Sign up to create new account</p>

                @if (session()->has('success'))

                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                    
                @endif
               
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">

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

                        {!! Form::label('gender' , trans('admin.gender')) !!}

    
                    
                        {!! Form::select('gender', [
                            'male'     => trans('admin.male'),
                            'female'   => trans('admin.female')
                        ]
                        ,old('gender'),['class' => 'form-control', 'placeholder' => 'gender']) !!}

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

                        {!! Form::label('gender' , trans('admin.gender')) !!}
                    
                        {!! Form::label('country' , trans('admin.country')) !!}
            
                        {!! Form::select('country', get_countries()
                        ,old('country'),['class' => 'form-control', 'placeholder' => 'country']) !!}
            
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-flag"></span>
                            </div>
                        </div>

                        @error('gender')
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

                <a href="{{ url('auth/login')}}" class="signin">already member ?</a><br>

                <div class="hr-container">
                    <hr>
                    <label>Or</label>
                </div>
                
                <div class="social row">
                    <div class="col-sm-12">
                        <a href="" class="btn-face m-b-10">
                            <i class="fab fa-facebook-square"></i>
                            Continue With Facebook
                        </a>
                    </div>
                </div>


            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->

        <!-- jQuery 3 -->
        <script src="{{ url('') }}/design/adminlte/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ url('') }}/design/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- toastr -->
        <script src="{{url('')}}/design/adminlte/plugins/toastr/toastr.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{ url('') }}/design/adminlte/dist/js/adminlte.min.js"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' /* optional */
                });
            });
        </script>
        <script>
            $(".input-group input").change(function() {
                if ($(this).val() != "") {
                    $(this).addClass('filled');
                } else {
                    $(this).removeClass('filled');
                }
            });

            //==========================//
            //for showing selected image//
            //==========================//
            function doAfterSelectImage(input){
                readURL(input);
            }

            function readURL(input){
                if(input.files && input.files[0]){
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('#post_user_image_').attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);

                }
            }
            //===========================//


        </script>
        @stack('js')
    </body>
</html> 

