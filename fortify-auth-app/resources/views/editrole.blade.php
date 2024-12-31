@extends('layout')

@section('title')
Edit role
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
                    <h4>Edit role</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Edit role</a></li>
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
                                <h5 class="card-header-text">Edit role</h5>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('roles.update') }}" method="POST" class="m-2">
                                    @csrf
                                    @method('POST')

                                    <input type="hidden" name="id" value="{{ $role->id }}">

                                  
                                        <!-- title Field -->
                                        <div class="mb-3 col-lg-6 input-group">
                                            <span class="input-group-addon"><i class="ti-info"></i></span>
                                            <input type="text" class="form-control" id="title" name="title" value="{{ old('name', $role->title) }}" placeholder="Enter title Name">
                                        </div>

                                        <!-- Email Field -->
                                        <div class="mb-3 col-lg-6 input-group">
                                            <span class="input-group-addon"><i class="ti-help"></i></span>
                                        <select name="status" id="status" class="form-control" value="{{ old('status', $role->status) }}">
                                            <option value="Active" {{ old('status', $role->status) == 'Active' ? 'selected' : '' }}>Active</option>
                                            <option value="Inactive" {{ old('status', $role->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>

                                        </select>
                                        </div>
                                    

                                    <!-- Submit Button -->
                                    <button id="updateBtn" type="submit" class="btn btn-primary">Update role</button>
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

