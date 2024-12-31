@extends('layouts.addtasklayout')

@section('title')
Add Holiday
@endsection

@section('activemanageholiday')
active
@endsection

@section('content')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-header">
                <div class="page-header-title">
                    <h4>Add Holiday</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Add Holiday</a></li>
                    </ul>
                </div>
            </div>

            <div class="page-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-header-text">Add Holiday</h5>
                            </div>
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('holidays.store') }}" method="POST" id="holiday-form" class="m-2">
                                    @csrf
                                    <div class="row">
                                        <!-- Holiday Date -->
                                        <div class="mb-3 col-lg-6 input-group">
                                            <span class="input-group-addon"><i class="icofont icofont-ui-calendar"></i></span>
                                            <input type="date" class="form-control" id="holiday_date" name="holiday_date" required>
                                            <span class="text-danger" id="holidayDateError"></span>
                                        </div>
                                    </div>

                                    <!-- Holiday Description -->
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Holiday Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter holiday description" required></textarea>
                                        <span class="text-danger" id="descriptionError"></span>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary">Add Holiday</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    function clearErrors() {
        $('#holidayDateError, #descriptionError').text('');
    }

    $('#holiday-form').on('submit', function (e) {
        e.preventDefault();

        // Clear previous errors
        clearErrors();

        // Form values
        var holidayDate = $('#holiday_date').val().trim();
        var description = $('#description').val().trim();

        var isValid = true;

        // Holiday Date Validation
        if (holidayDate === '') {
            $('#holidayDateError').text('Please select a holiday date.');
            isValid = false;
        }

        // Description Validation
        if (description === '') {
            $('#descriptionError').text('Please enter a holiday description.');
            isValid = false;
        }

        // Submit if valid
        if (isValid) {
            this.submit();
        }
    });
});
</script>
@endsection
