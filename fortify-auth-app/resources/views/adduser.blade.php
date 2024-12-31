@extends('layout')

@section('title')
Add User
 @endsection

 @section('activemanageuser')
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
                        <li class="breadcrumb-item"><a href="#!">Add User</a></li>
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
                            <h5 class="card-header-text">Add User</h5>
                            </div>
                           

                            
                            <div class="card-body">
                                <form action="{{ route('user.store') }}" method="POST" id="crud-form" class="m-2" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                    <!-- Name Field -->
                                        <div class="mb-3 col-lg-6 input-group">
                                            <span class="input-group-addon"><i class="icofont icofont-user"></i></span>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter User Name">
                                            <span class="text-danger" id="nameError"></span>
                                        </div>

                                        <!-- Email Field -->
                                        <div class="mb-3 col-lg-6 input-group">
                                            <span class="input-group-addon"><i class="icofont icofont-envelope"></i></span>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter User Email">
                                            <span class="text-danger" id="emailError"></sapn>
                                        </div>
                                    </div>

                                    <div class=" row">
                                        <!-- Phone Field -->
                                        <div class="mb-3 col-lg-6 input-group">
                                            <span class="input-group-addon"><i class="icofont icofont-phone"></i></span>
                                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter User Phone">
                                            <div class="text-danger" id="phoneError"></div>
                                        </div>

                                        <!-- Gender Field -->
                                        <div class="mb-3 col-lg-6 input-group">
                                            <span class="input-group-addon"><i class="icofont icofont-user"></i></span>
                                            <select class="form-control" id="gender" name="gender" placeholder="Select User Gender">
                                                <option value="">Select Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                            <div class="text-danger" id="genderError"></div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- City Field -->
                                        <div class="mb-3 col-lg-6 input-group">
                                            <span class="input-group-addon"><i class="icofont icofont-location-pin"></i></span>
                                            <input type="text" class="form-control" id="city" name="city" placeholder="Enter User City">
                                            <div class="text-danger" id="cityError"></div>
                                        </div>

                                        <!-- Password Field -->
                                        <div class="mb-3 col-lg-6 input-group">
                                            <span class="input-group-addon"><i class="icofont icofont-lock"></i></span>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter User Password">
                                            <div class="text-danger" id="passwordError"></div>
                                        </div>
                                    </div>

                                    <div class="row">
                                    <!--file upload-->
                                    <div class="mb-3 col-lg-6 input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-image"></i></span>
                                        <input type="file" class="form-control" id="profile_image" name="profile_image" accept="image/*">
                                        <div class="text-danger" id="fileError"></div>
                                    </div>

                                    <div class="mb-3 col-lg-6">
                                        <label for="role" class="form-label">Assign Role</label>
                                        <select class="form-select" id="role" name="role">
                                            <option value="">Select a Role</option>
                                            @foreach ($roles as $id => $title)
                                                <option value="{{ $title }}">{{ $title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    
                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
        $('#crud-form').on('submit', function (e) {
            e.preventDefault();

            // Clear previous errors
            $('#nameError, #emailError, #phoneError, #genderError, #cityError, #passwordError').text('');

            var name = $('#name').val().trim();
            var email = $('#email').val().trim();
            var phone = $('#phone').val().trim();
            var gender = $('#gender').val();
            var city = $('#city').val().trim();
            var password = $('#password').val().trim();

            var isValid = true;

            // Name Validation
            if (name === '') {
                $('#nameError').text('Please enter your name.');
                isValid = false;
            }

            // Email Validation
            if (email === '') {
                $('#emailError').text('Please enter your email address.');
                isValid = false;
            } else if (!validateEmail(email)) {
                $('#emailError').text('The email address you entered is not valid.');
                isValid = false;
            }

            // Phone Validation
            if (phone === '') {
                $('#phoneError').text('Please enter your phone number.');
                isValid = false;
            } else if (!/^[0-9]{10}$/.test(phone)) {
                $('#phoneError').text('Please enter a valid 10-digit phone number.');
                isValid = false;
            }

            // Gender Validation
            if (gender === '') {
                $('#genderError').text('Please select a gender.');
                isValid = false;
            }

            // City Validation
            if (city === '') {
                $('#cityError').text('Please enter your city.');
                isValid = false;
            }

            // Password Validation
            if (password === '') {
                $('#passwordError').text('Please enter a password.');
                isValid = false;
            } else if (password.length < 8) {
                $('#passwordError').text('Password must be at least 8 characters long.');
                isValid = false;
            }

            // Submit if valid
            if (isValid) {
                this.submit();
            }
        });

        function validateEmail(email) {
            var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }
    });
</script>
@endsection
