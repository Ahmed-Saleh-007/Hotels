
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                    @role('admin')
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ route('dashboard.home') }}" class="nav-link">@lang('admin.dashboard')</a>
                    </li>
                    @endrole
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="" id="btnFullscreen" class="nav-link"><i class="fas fa-expand"></i></a>
                    </li>
                    
                    <!-- lang setting-->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fa fa-globe"></i>
                            <span class="">{{lang()}}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right"style="width:auto;">
                            <a class="dropdown-item" href="{{ url('lang/ar') }}"><i class="fa fa-flag"></i> عربى</a>
                            <a class="dropdown-item" href="{{ url('lang/en') }}"><i class="fa fa-flag"></i> English</a>
                        </div>
                    </li>
                    <!-- User Account -->
                    <li class="nav-item dropdown user user-menu">
                        <a class="nav-link" data-toggle="dropdown" href="#">

                            @if (isset(auth()->user()->avatar_image))

                                @if(auth()->user()->avatar_image == 'avatar.png')
                                
                                    <img src="{{url('images/' . auth()->user()->avatar_image )}}" class="img-circle elevation-2" style="height: 28px"   alt="User Image">
                                    
                                @else

                                    <img src="{{url('/storage/users_images/' . auth()->user()->avatar_image )}}" class="img-circle elevation-2" style="height: 28px"  alt="User Image">
                                @endif

                            @endif
                            
                        <span class="hidden-xs"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <!-- User image -->
                            <li class="user-header">
                                
                                @if (isset(auth()->user()->avatar_image))

                                    @if(auth()->user()->avatar_image == 'avatar.png')
                                
                                        <img src="{{url('images/' . auth()->user()->avatar_image )}}" class="img-circle elevation-2" alt="User Image">
                                    
                                    @else

                                        <img src="{{url('/storage/users_images/' . auth()->user()->avatar_image )}}" class="img-circle elevation-2" alt="User Image">
                                    
                                    @endif
                                    
                                @endif

                                <p>
                                    {{auth()->user()->name}} <br>
                                    @lang('admin.Member Since') {{auth()->user()->created_at->format('d/m/Y')}}
                                </p>
                             
                            </li>
                       
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="row">
                                    <div class="col-sm-4 text-center">
                                        <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm">Edit Profile</a>
                                    </div>

                                    <div class="col-sm-4 text-center">
                                    </div>
                                  
                                    <div class="col-sm-4 text-center">
                                        <a href="{{ route('dashboard.logout') }}" class="btn btn-dark btn-sm">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                            <i class="fas fa-th-large"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->