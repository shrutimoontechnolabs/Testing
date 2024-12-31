@extends('layouts.userlayout')

@section('title')
Time Logs
@endsection

@section('activedashboard')
active
@endsection

@section('link')
<style>
    .button {
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        margin-top: 20px;
    }
    .clock-in {
        background-color: green;
        color: white;
    }
    .clock-out {
        background-color: red;
        color: white;
    }
</style>
@endsection

@section('activemanagerole')
active
@endsection

@section('content')
<div class="pcoded-inner-content">
    <!-- Main body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page-header start -->
            <div class="page-header">
                <div class="page-header-title">
                    <h4>Current Week Time Logs</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Time Logs</a></li>
                    </ul>
                </div>
            </div>
            <!-- Page-header end -->

            <!-- Page-body start -->
            <div class="page-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-header-text">Time Logs for Current Week</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped datatable">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Day</th>
                                                <th>In Time</th>
                                                <th>Out Time</th>
                                                <th>Hours</th>
                                            </tr>
                                        </thead>
                                        <tbody id="inoutTable">
                                            @if($inouts->isEmpty())
                                                <tr>
                                                    <td colspan="5" class="text-center">No time logs available for this week.</td>
                                                </tr>
                                            @else
                                            @foreach($inouts as $inout)
                                                <tr>

                                                    <td>{{ \Carbon\Carbon::parse($inout->date)->format('d/m/Y') }}</td>
                                                    <td>{{ $inout->day }}</td>
                                                    <td>{{ $inout->in_time ? \Carbon\Carbon::parse($inout->in_time)->format('H:i A') : '' }}</td>
                                                    <td>{{ $inout->out_time ? \Carbon\Carbon::parse($inout->out_time)->format('H:i A') : '' }}</td>
                                                    <td>{{ $inout->hours }}</td>
                                                </tr>
                                            @endforeach
                                        
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page-body end -->
        </div>
    </div>
    <!-- Main body end -->
</div>
@endsection
