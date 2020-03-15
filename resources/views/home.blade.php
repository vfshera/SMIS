@extends('layouts.master')

@section('content')
     <div id="app">

        <div class="hold-transition sidebar-mini layout-fixed">
            <div class="wrapper">

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand fixed-top navbar-white navbar-light " style="height:57px;background:#fff">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars" style="color:black"></i></a>
                </li>
                </ul>

            <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto pt-2">
                    <li class="nav-item d-none d-sm-inline-block m">
                        <router-link to="/home" class="nav-link">DASHBOARD</router-link>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block m">
                        <a href="/" class="nav-link">SITE</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block m">
                        <a href="/register" class="nav-link">REGISTER</a>
                    </li>

                    <messages></messages>
                    <notifications class="mr-4"></notifications>

                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
            <div style="background:#fff; height:56px">
                <img src="/storage/images/smislogo.png" alt="SMIS LOGO" height="50px" width="120px" class="pt-2 ml-3">
            </div>
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">

                <a href="#" class="ml-3 text-white d-inline" style="font-weight:900;font-size:24px">{{ Auth::user()->name }}</a>

                            <li class="nav-item">
                                    <a class="nav-link" href="/logout"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    Logout <i class="fas fa-sign-out-alt"></i>
                                    </a>

                                    <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            </li>

                    </div>
                </div>

                <!-- Sidebar -->
                <sidebar></sidebar>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <admin></admin>
            <!-- ./wrapper -->
         </div>
     </div>
     </div>


@endsection
