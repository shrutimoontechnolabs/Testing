@extends('layout')

@section('title')
Edit Contact
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
                    <h4>Edit Contact</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Edit Contact</a></li>
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
                            <h5 class="card-header-text">Edit Contact</h5>
                            </div>
                            

                            <div class="card-body">
                                <form action="{{ route('contacts.update', $contact->id) }}" method="POST" id="crud-form" class="m-2" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')

                                    <input type="hidden" name="id" value="{{ $contact->id }}">
                                    <div class="row">
                                    <!-- First Name Field -->
                                        <div class="mb-3 col-lg-6 input-group">
                                            <span class="input-group-addon"><i class="icofont icofont-user"></i></span>
                                            <input type="text" class="form-control" id="fname" name="fname" value="{{ old('fname', $contact->fname) }}" placeholder="Enter First Name">
                                            <span class="text-danger" id="fnameError"></span>
                                        </div>

                                        <!-- Last Name Field -->
                                        <div class="mb-3 col-lg-6 input-group">
                                            <span class="input-group-addon"><i class="icofont icofont-user"></i></span>
                                            <input type="text" class="form-control" id="lname" name="lname" value="{{ old('lname', $contact->lname) }}" placeholder="Enter Last Name">
                                            <span class="text-danger" id="lnameError"></span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Primary Contact Field -->
                                        <div class="mb-3 col-lg-6 input-group">
                                            <span class="input-group-addon"><i class="icofont icofont-phone"></i></span>
                                            <input type="tel" class="form-control" id="contact" name="contact" value="{{ old('contact', $contact->contact) }}" placeholder="Enter Primary Contact">
                                            <div class="text-danger" id="contactError"></div>
                                        </div>

                                        <!-- Secondary Contact Field -->
                                        <div class="mb-3 col-lg-6 input-group">
                                            <span class="input-group-addon"><i class="icofont icofont-phone"></i></span>
                                            <input type="tel" class="form-control" id="secondary_contact" name="secondary_contact" value="{{ old('secondary_contact', $contact->secondary_contact) }}" placeholder="Enter Secondary Contact">
                                            <div class="text-danger" id="secondaryContactError"></div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Email Field -->
                                        <div class="mb-3 col-lg-6 input-group">
                                            <span class="input-group-addon"><i class="icofont icofont-envelope"></i></span>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $contact->email) }}" placeholder="Enter Email Address">
                                            <span class="text-danger" id="emailError"></span>
                                        </div>

                                        <!-- Date of Birth Field -->
                                        <div class="mb-3 col-lg-6 input-group">
                                            <span class="input-group-addon"><i class="icofont icofont-calendar"></i></span>
                                            <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob', $contact->dob) }}" placeholder="Select Date of Birth">
                                            <div class="text-danger" id="dobError"></div>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary">Update</button>
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
            $('#fnameError, #lnameError, #contactError, #secondaryContactError, #emailError, #dobError').text('');

            var fname = $('#fname').val().trim();
            var lname = $('#lname').val().trim();
            var contact = $('#contact').val().trim();
            var secondaryContact = $('#secondary_contact').val().trim();
            var email = $('#email').val().trim();
            var dob = $('#dob').val().trim();

            var isValid = true;

            // First Name Validation
            if (fname === '') {
                $('#fnameError').text('Please enter the first name.');
                isValid = false;
            }

            // Last Name Validation
            if (lname === '') {
                $('#lnameError').text('Please enter the last name.');
                isValid = false;
            }

            // Primary Contact Validation
            if (contact === '') {
                $('#contactError').text('Please enter the primary contact.');
                isValid = false;
            } else if (!/^[0-9]{10}$/.test(contact)) {
                $('#contactError').text('Please enter a valid 10-digit phone number for the primary contact.');
                isValid = false;
            }

            // Secondary Contact Validation
            if (secondaryContact !== '' && !/^[0-9]{10}$/.test(secondaryContact)) {
                $('#secondaryContactError').text('Please enter a valid 10-digit phone number for the secondary contact.');
                isValid = false;
            }

            // Email Validation
            if (email === '') {
                $('#emailError').text('Please enter the email address.');
                isValid = false;
            } else if (!validateEmail(email)) {
                $('#emailError').text('The email address you entered is not valid.');
                isValid = false;
            }

            // Date of Birth Validation
            if (dob === '') {
                $('#dobError').text('Please enter the date of birth.');
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
