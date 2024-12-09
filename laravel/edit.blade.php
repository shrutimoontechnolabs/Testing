@extends('layout')

@section('title')
Edit User
@endsection

@section('activeedituser')
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
                    <h4>Edit User</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Edit User</a></li>
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
                                <h5 class="card-header-text">Edit User</h5>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('users.update') }}" method="POST">
                                    @csrf
                                    @method('POST')

                                    <input type="hidden" name="id" value="{{ $user->id }}">

                                    <div class="row">
                                        <!-- Name Field -->
                                        <div class="mb-3 col-lg-6 input-group">
                                            <span class="input-group-addon"><i class="icofont icofont-user"></i></span>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" placeholder="Enter User Name">
                                        </div>

                                        <!-- Email Field -->
                                        <div class="mb-3 col-lg-6 input-group">
                                            <span class="input-group-addon"><i class="icofont icofont-envelope"></i></span>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Enter User Email">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Phone Field -->
                                        <div class="mb-3 col-lg-6 input-group">
                                            <span class="input-group-addon"><i class="icofont icofont-phone"></i></span>
                                            <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Enter User Phone">
                                        </div>

                                        <!-- Gender Field -->
                                        <div class="mb-3 col-lg-6 input-group">
                                            <span class="input-group-addon"><i class="icofont icofont-user"></i></span>
                                            <select class="form-control" id="gender" name="gender">
                                                <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                                <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- City Field -->
                                        <div class="mb-3 col-lg-6 input-group">
                                            <span class="input-group-addon"><i class="icofont icofont-location-pin"></i></span>
                                            <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $user->city) }}" placeholder="Enter User City">
                                        </div>

                                        <!-- Password Field -->
                                        <div class="mb-3 col-lg-6 input-group">
                                            <span class="input-group-addon"><i class="icofont icofont-lock"></i></span>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter User Password">
                                        </div>
                                    </div>
                                    <div class="mb-3 col-lg-6">
                                        <label for="role" class="form-label">Assign Role</label>
                                        <select class="form-select" id="role" name="role">
                                        @foreach ($roles as $id => $title)
                                            <option value="{{ $id }}" {{ old('role', $user->role_id) == $id ? 'selected' : '' }}>
                                                {{ $title }}
                                            </option>
                                        @endforeach
                                    </select>

                                    </div>

                                    <!-- Submit Button -->
                                    <button id="updateBtn" type="submit" class="btn btn-primary">Update User</button>
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

