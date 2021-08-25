@extends('layouts.app')

@section('app-content')
    <div class="wrapper">

        <!-- Navbar -->
        @include('includes.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('includes.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('includes.bradcame')
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
             <!-- Main Contents -->   
             @yield('master-content')
             <!-- Main Contents End -->   
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('includes.footer')
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
@endsection
