@extends('layout')

@section('title')
Add Role
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
                    <h4>Add User</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Add Role</a></li>
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
                            <h5 class="card-header-text">Add Role</h5>
                            </div>
                            {{-- @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif --}}

                            
                            <div class="card-body">
                                <form action="{{ route('role.store') }}" method="POST" id="role-form"  class="m-2">
                                    @csrf
                                    <!--title-->
                                    <div class="mb-3 col-lg-6 input-group">
                                        <span class="input-group-addon"><i class="ti-info"></i></span>
                                        <input type="text" name="title" id="title" class="form-control" placeholder="Enter role title" >
                                    </div>
                                    <div>
                                        <span class="text-danger" id="titleError"></span>
                                    </div>


                                    <div class="mb-3 col-lg-6 input-group">
                                        <span class="input-group-addon"><i class="ti-help"></i></span>
                                        <select name="status" id="status" class="form-control" >
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Role</button>
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

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('#role-form').on('submit', function (e) {
            e.preventDefault();  // Prevent the default form submission

            // Clear previous errors
            $('#titleError').text('');

            var title = $('#title').val().trim();

            var isValid = true;

            // Title Validation
            if (title === '') {
                $('#titleError').text('Please enter title.');
                isValid = false;
            }

            // If validation passed, submit the form
            if (isValid) {
                // Submit the form manually
                this.submit(); 
            }
        });
    });
</script>
@endsection
