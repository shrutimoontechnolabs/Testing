@extends('layout')
@section('title')
Dashboard
 @endsection
 
 @section('activedashboard')
 active
 @endsection


@section('content')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-header">
                <div class="page-header-title">
                    <h4>Dashboard</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="#!">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Dashboard</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="page-body">
                <div class="row">
                    <!-- counter-card-1 start-->
                    <div class="col-md-12 col-xl-4">
                        <div class="card counter-card-1">
                            <div class="card-block-big">
                                <div class="row">
                                    <div class="col-6 counter-card-icon">
                                        <i class="icofont icofont-chart-histogram"></i>
                                    </div>
                                    <div class="col-6  text-right">
                                        <div class="counter-card-text">
                                            <h3>14</h3>
                                            <p>ACTIVE USER</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- counter-card-1 end-->
                    <!-- counter-card-2 start -->
                    <div class="col-md-6 col-xl-4">
                        <div class="card counter-card-2">
                            <div class="card-block-big">
                                <div class="row">
                                    <div class="col-6 counter-card-icon">
                                        <i class="icofont icofont-chart-line-alt"></i>
                                    </div>
                                    <div class="col-6 text-right">
                                        <div class="counter-card-text">
                                            <h3>3</h3>
                                            <p>All Role</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- counter-card-2 end -->
                    <!-- counter-card-3 start -->
                    <div class="col-md-6 col-xl-4">
                        <div class="card counter-card-3">
                            <div class="card-block-big">
                                <div class="row">
                                    <div class="col-6 counter-card-icon">
                                        <i class="icofont icofont-chart-line"></i>
                                    </div>
                                    <div class="col-6 text-right">
                                        <div class="counter-card-text">
                                            <h3>35%</h3>
                                            <p>SALE RATIO</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- counter-card-3 end -->
                    <!-- Morris chart start -->
                    
                    <!-- Morris chart end -->
                    <!--Follow block start-->
                  
                    <!--Follow block Ends-->
                    <!-- Product table Start -->

                    <!-- Pie Chart end -->

                    <!--user chat box start-->
                    
        
                    <!-- Analythics Start -->
                   
                    <!-- Analythics Ends -->
                </div>
            </div>
        </div>
    </div>
    <!--<div id="styleSelector">-->

    <!--</div>-->
</div>
@endsection