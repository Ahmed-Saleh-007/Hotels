
            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="" class="brand-link">
                    <img src="{{url('/design/adminlte')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">@lang('admin.sitename')</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="{{url('/design/adminlte')}}/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
                            {{-- @if (!empty(admin()->user()->image))
                            <img src="{{ Storage::url(admin()->user()->image) }}" style="width: 35px; height: 35px;" class="img-circle elevation-2" alt="User Image"/>
                            @else
                            <img src="{{url('/design/adminlte')}}/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
                            @endif --}}

                        </div>
                        <div class="info">
                            <a href="#" class="d-block">
                                Admin
                                {{-- @if (lang() == 'en')
                                {{ admin()->user()->name_en }}
                                @else
                                {{ admin()->user()->name_ar }}
                                @endif --}}
                            </a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                                with font-awesome or any other icon font library -->
                            <li class="nav-item has-treeview menu-open">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        {{ trans('admin.dashboard') }}
                                        @if (direction() == 'rtl')
                                        <i class="right fas fa-angle-right"></i>
                                        @else
                                        <i class="right fas fa-angle-left"></i>
                                        @endif
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('/') }}" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{ trans('admin.control_panel') }}</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        {{ trans('admin.users') }}
                                        @if (direction() == 'rtl')
                                        <i class="right fas fa-angle-right"></i>
                                        @else
                                        <i class="right fas fa-angle-left"></i>
                                        @endif
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('users.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{ trans('admin.users_account') }}</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>


                            <li class="nav-item">
                                <a href="{{ route('roles.index') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-danger"></i>
                                    <p>{{ trans('admin.roles') }}</p>
                                </a>
                            </li>

                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>
