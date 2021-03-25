@extends('admin.index')
@section('content')
    
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
            <div class="inner">
                <h3>{{$doctorsNumber}}</h3>

                <p>@lang('admin.Doctors')</p>
            </div>
            <div class="icon">
                <i class="nav-icon fas fa-user-md"></i>
            </div>
            <a href="{{route('doctor.index')}}" class="small-box-footer">@lang('admin.More Info')<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
            <div class="inner">
                <h3>{{$patientsNumber}}</h3>

                <p>@lang('admin.Patients')</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('patient.index') }}" class="small-box-footer">@lang('admin.More Info')<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{$pharmacysNumber}}</h3>

                <p>@lang('admin.Pharmacy')</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('pharmacy.index') }}" class="small-box-footer">@lang('admin.More Info')<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{$adminsNumber}}</h3>

                <p>@lang('admin.admins')</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('admins.index') }}" class="small-box-footer">@lang('admin.More Info')<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{$reservationsNumber}}</h3>

                <p>@lang('admin.All Reservations')</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>        

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-light">
            <div class="inner">
                <h3>{{$todayReservationNumbers}}</h3>

                <p>@lang('admin.Today Reservations')</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('admin.todayReservations') }}" class="small-box-footer">@lang('admin.More Info')<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>        

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
            <div class="inner">
                <h3>{{$prviousReservationNumbers}}</h3>

                <p>@lang('admin.Previous Reservations')</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('admin.previousReservations') }}" class="small-box-footer">@lang('admin.More Info')<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>        

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
            <div class="inner">
                <h3>{{$futureReservationNumbers}}</h3>

                <p>@lang('admin.Future Reservations')</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('admin.futureReservations') }}" class="small-box-footer">@lang('admin.More Info')<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{$citiesNumber}}</h3>

                <p>@lang('admin.cities')</p>
            </div>
            <div class="icon">
                <i class="ion ion-location"></i>
            </div>
            <a href="{{ route('cities.index') }}" class="small-box-footer">@lang('admin.More Info')<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        </div>
        <!-- /.row -->

        @include('admin.dashboardCommentedCode')
        <!-- Main row -->

    </div><!-- /.container-fluid -->

@endsection