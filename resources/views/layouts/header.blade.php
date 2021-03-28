<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@lang('admin.sitename')</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{url('')}}/design/adminlte/plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bbootstrap 4 -->
        <link rel="stylesheet" href="{{url('')}}/design/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{url('')}}/design/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- JQVMap -->
        <link rel="stylesheet" href="{{url('')}}/design/adminlte/plugins/jqvmap/jqvmap.min.css">
        <!-- toastr -->
        <link rel="stylesheet" href="{{url('')}}/design/adminlte/plugins/toastr/toastr.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{url('')}}/design/adminlte/dist/css/adminlte.min.css">
        <link rel="stylesheet" href="{{url('')}}/design/adminlte/dist/css/custom_style.css">
        <link rel="stylesheet" href="{{url('')}}/design/adminlte/dist/css/custom.css">

        <!-- rtl Theme style -->
        
        @if (direction() == 'rtl')
        <link rel="stylesheet" href="{{url('')}}/design/adminlte/dist/css/bootstrap-rtl.css">
        <link rel="stylesheet" href="{{url('')}}/design/adminlte/dist/css/rtl.css">
        <link href="https://fonts.googleapis.com/css?family=Cairo:300,400&amp;subset=arabic,latin-ext" rel="stylesheet">
        <style type="text/css">
			html,body ,h1,h2,h3,h4,h5,h6{
			    font-family: 'Cairo', sans-serif;
			}
            .dataTables_filter {
                text-align: left !important;
            }
		</style>
        @endif
        <!--
        <link rel="stylesheet" href="{{url('')}}/design/adminlte/dist/css/bootstrap-rtl.css">
        <link rel="stylesheet" href="{{url('')}}/design/adminlte/dist/css/rtl.css">
        -->

        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{url('')}}/design/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{url('')}}/design/adminlte/plugins/daterangepicker/daterangepicker.css">
        <!-- summernote -->
        <link rel="stylesheet" href="{{url('')}}/design/adminlte/plugins/summernote/summernote-bs4.css">
        <!-- dropzone -->
		<link rel="stylesheet" href="{{url('')}}/design/adminlte/plugins/dropzone-master/dist/min/dropzone.min.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <!-- dataTables -->
		<link rel="stylesheet" href="{{ url('design/adminlte') }}/plugins/datatables.net-bs/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="{{ url('design/adminlte') }}/plugins/datatables.net-bs/css/rowReorder.dataTables.min.css">
        <link rel="stylesheet" href="{{ url('design/adminlte') }}/plugins/datatables.net-bs/css/rowReorder.bootstrap4.min.css">
        <link rel="stylesheet" href="{{ url('design/adminlte') }}/plugins/datatables.net-bs/css/responsive.dataTables.min.css">
        <link rel="stylesheet" href="{{ url('design/adminlte') }}/plugins/datatables.net-bs/css/responsive.bootstrap4.min.css">
        <!-- jstree -->
		<link rel="stylesheet" href="{{ url('/') }}/design/adminlte/jstree/themes/default/style.css">
        
        <!-- multi-choose checkbox  -->
		<link rel="stylesheet" href="{{ url('/') }}/design/adminlte/dist/css/checkbox/vanillaSelectBox.css">


        <style>
            .hidden { display: none; }
			.dataTable {width: 100% !important; }
			.dataTable tbody tr td {vertical-align: middle; }
			.dataTables_length {margin-top : 10px; margin-bottom : 5px; }
            .dataTables_filter {margin-top : -45px;}
			.dataTables_info {padding-bottom: 8px; }
            .dataTables_paginate {margin-top : -40px !important; }
			th input {width: 100%; }
            
        </style>
        
        {{-- <link rel="icon" href="{{ Storage::url(setting()->icon) }}" /> --}}
        
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">