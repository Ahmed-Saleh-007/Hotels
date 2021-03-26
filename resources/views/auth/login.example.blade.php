{{-- <!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>{{ trans('admin.login')}}</title>
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

        <link rel="icon" href="{{ Storage::url(setting()->icon) }}" />
        
    </head>
    <body class="hold-transition login-page auth-background" style="background-image:url('{{url('/design/adminlte/dist/img/auth-background.png')}}')">
        <div class="login-box">
            <div class="login-logo">
                <a href="{{ url('')}}"><img src="{{ url('')}}/design/adminlte/dist/img/logo.png" alt="sehaty"></a>
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
                <form method="post">
                    {!! csrf_field() !!}
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" id="email" autocomplete="off">
                        <label for="email">Email</label>
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                          </div>
                        </div>
                      </div>
                      <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" id="password">
                        <label for="password">Password</label>
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                          </div>
                        </div>
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

                <a href="{{ url('auth/forgot/password')}}" class="forget">I forgot my password</a><br>

                <div class="hr-container">
                    <hr>
                    <label>Or</label>
                </div>
                
                <div class="social row">
                    <div class="col-sm-12">
                        <a href="{{route('patient.socialLogin','facebook')}}" class="btn-face m-b-10">
                            <i class="fab fa-facebook-square"></i>
                            Continue With Facebook
                        </a>
                    </div>
                </div>

                <a href="{{ url('auth/register')}}" class="register">Create new account <i class="fa fa-arrow-right"></i> </a>

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
        </script>
        @stack('js')
    </body>
</html> --}}

