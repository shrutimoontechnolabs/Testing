@extends('layouts.userlayout')

@section('title')
edit Leave
 @endsection

 @section('activeleave')
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
                    <h4>Add Leave</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Edit Leave</a></li>
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
                            <h5 class="card-header-text">Edit Leave</h5>
                            </div>
                            {{-- @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif --}}

                            
                            <div class="card-body">
                                <form action="{{ route('leaves.update') }}" method="POST" id="role-form" class="p-3">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $leave->id }}">
                                    <div class="row">
                                        <!-- Start Date -->
                                        <div class="mb-3 col-md-6">
                                            <label for="start_date" class="form-label">Start Date:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="ti-calendar"></i></span>
                                                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $leave->start_date) }}">
                                            </div>
                                            <div class="row mt-2">
                                                <div class="mb-3 col-md-4">
                                                    <input class="form-check-input" type="radio" name="start_date_type" id="startFullDay" value="fullDay" 
                                                           {{ old('start_date_type', $leave->start_date_type) == 'fullDay' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="startFullDay">Full Day</label>
                                                </div>
                                                <div class="mb-3 col-md-4">
                                                    <input class="form-check-input" type="radio" name="start_date_type" id="start1Half" value="1half"
                                                           {{ old('start_date_type', $leave->start_date_type) == '1half' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="start1Half">1 Half</label>
                                                </div>
                                                <div class="mb-3 col-md-4">
                                                    <input class="form-check-input" type="radio" name="start_date_type" id="start2Half" value="2half"
                                                           {{ old('start_date_type', $leave->start_date_type) == '2half' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="start2Half">2 Half</label>
                                                </div>
                                            </div>
                                            @error('start_date')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                
                                        <!-- End Date -->
                                        <div class="mb-3 col-md-6">
                                            <label for="end_date" class="form-label">End Date:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="ti-calendar"></i></span>
                                                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $leave->end_date) }}">
                                            </div>
                                            <div class="row mt-2">
                                                <div class="mb-3 col-md-4">
                                                    <input class="form-check-input" type="radio" name="end_date_type" id="endFullDay" value="fullDay"
                                                           {{ old('end_date_type', $leave->end_date_type) == 'fullDay' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="endFullDay">Full Day</label>
                                                </div>
                                                <div class="mb-3 col-md-4">
                                                    <input class="form-check-input" type="radio" name="end_date_type" id="end1Half" value="1half"
                                                           {{ old('end_date_type', $leave->end_date_type) == '1half' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="end1Half">1 Half</label>
                                                </div>
                                                <div class="mb-3 col-md-4">
                                                    <input class="form-check-input" type="radio" name="end_date_type" id="end2Half" value="2half"
                                                           {{ old('end_date_type', $leave->end_date_type) == '2half' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="end2Half">2 Half</label>
                                                </div>
                                            </div>
                                            @error('end_date')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                
                                    <!-- Reason -->
                                    <div class="mb-3">
                                        <label for="reason" class="form-label">Reason:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="ti-pencil"></i></span>
                                            <textarea name="reason" id="reason" class="form-control" placeholder="Enter your reason">{{ old('reason', $leave->reason) }}</textarea>
                                        </div>
                                        @error('reason')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Update Leave</button>
                                    </div>
                                </form>
                                
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
