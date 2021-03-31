
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

                            @if (isset(auth()->user()->avatar_image))

                                @if(auth()->user()->avatar_image == 'avatar.png')
                            
                                    <img src="{{url('images/' . auth()->user()->avatar_image )}}" class="img-circle elevation-2" style="height: 35px"  alt="User Image">
                                
                                @else

                                    <img src="{{url('/storage/users_images/' . auth()->user()->avatar_image )}}" class="img-circle elevation-2" style="height: 35px"  alt="User Image">
                                
                                @endif

                            @endif

                            
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">
                                {{ isset( auth()->user()->name )  ? auth()->user()->name : ''  }}
                            </a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                                with font-awesome or any other icon font library -->
                            <li class="nav-item has-treeview menu-open">

                                @role('admin')
                                    
                                    <li class="nav-item">
                                        <a href="{{ url('/') }}" class="nav-link active">
                                            <i class="far fa-circle text-gray nav-icon"></i>
                                            <p>{{ trans('admin.dashboard') }}</p>
                                        </a>
                                    </li>

                                @endrole

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

                                @role('admin')

                                    <li class="nav-item">
                                        <a href="{{ route('users.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-users text-success"></i>
                                            <p>{{ trans('admin.all_users') }}</p>
                                        </a>
                                    </li>

                                @endrole

                                @role('admin')
                                    <li class="nav-item">
                                        <a href="{{ route('managers.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-users text-warning"></i>
                                            <p>{{ trans('admin.managers') }}</p>
                                        </a>
                                    </li>
                                @endrole

                                @role('admin|manager')
                                    <li class="nav-item">
                                        <a href="{{ route('receptionists.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-users text-info"></i>
                                            <p>{{ trans('admin.receptionists') }}</p>
                                        </a>
                                    </li>
                                @endrole

                                
                                    <li class="nav-item">
                                        <a href="{{ route('clients.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-users text-default"></i>
                                            <p>{{ trans('admin.clients') }}</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>

                            @role('receptionist')
                            <li class="nav-item">
                                <a href="{{ route('clients.approved') }}" class="nav-link">
                                    <i class="nav-icon fas fa-user-check text-default"></i>
                                    <p>{{ trans('admin.my_approved_clients') }}</p>
                                </a>
                            </li>
                            @endrole

                            @role('admin')
                            <li class="nav-item has-treeview">

                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user-shield"></i>
                                    <p>
                                        {{ trans('admin.authorization') }}
                                        @if (direction() == 'rtl')
                                        <i class="right fas fa-angle-right"></i>
                                        @else
                                        <i class="right fas fa-angle-left"></i>
                                        @endif
                                    </p>

                                </a>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('roles.index') }}" class="nav-link">
                                            <i class="nav-icon far fa-circle text-danger"></i>
                                            <p>{{ trans('admin.roles') }}</p>
                                        </a>
                                    </li>
        
                                    <li class="nav-item">
                                        <a href="{{ route('permissions.index') }}" class="nav-link">
                                            <i class="nav-icon far fa-circle text-warning"></i>
                                            <p>{{ trans('admin.permissions') }}</p>
                                        </a>
                                    </li>

                                </ul>


                            </li>
                            @endrole

                            @role('admin|manager')
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-building"></i>
                                    <p>
                                        {{ trans('admin.floor_room') }}
                                        @if (direction() == 'rtl')
                                        <i class="right fas fa-angle-right"></i>
                                        @else
                                        <i class="right fas fa-angle-left"></i>
                                        @endif
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('floors.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-stream"></i>
                                            <p>{{ trans('admin.floors') }}</p>
                                        </a>
                                    </li>
        
                                    <li class="nav-item">
                                        <a href="{{ route('rooms.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-person-booth"></i>
                                            <p>{{ trans('admin.rooms') }}</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            @endrole

                            @role('admin|manager')

                                <li class="nav-item">
                                    
                                    <a href="{{ route('clients.statistics') }}" class="nav-link">
                                        <i class="nav-icon fas fa-chart-pie"></i>
                                        <p>{{ __('admin.statistics_chart') }}</p>
                                    </a>

                                </li>

                                {{-- <li class="nav-item">
                                    
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-chart-pie text-cyan"></i>
                                        <p>{{ __('admin.line_chart') }}</p>
                                    </a>

                                </li> --}}

                            @endrole


                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>
