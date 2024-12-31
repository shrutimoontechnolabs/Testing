@extends('layouts.addtasklayout')

@section('title')
Add Task
@endsection

@section('activemanagetask')
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
                    <h4>Add Task</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Add Task</a></li>
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
                                <h5 class="card-header-text">Add Task</h5>
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

                                <form action="{{ route('task.store') }}" method="POST" id="task-form" class="m-2">
                                    @csrf
                                    <div class="row">
                                        <!-- Task Title -->
                                        <div class="mb-3 col-lg-6 input-group">
                                            <span class="input-group-addon"><i class="icofont icofont-tasks"></i></span>
                                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Task Title">
                                            <span class="text-danger" id="titleError"></span>
                                        </div>

                                        <!-- Status -->
                                        <div class="mb-3 col-lg-6 input-group">
                                            <span class="input-group-addon"><i class="icofont icofont-ui-check"></i></span>
                                            <select class="form-control" id="status" name="status">
                                                <option value="Pending">Pending</option>
                                                <option value="In Progress">In Progress</option>
                                                <option value="Completed">Completed</option>
                                            </select>
                                            <span class="text-danger" id="statusError"></span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Due Date -->
                                        <div class="mb-3 col-lg-6 input-group">
                                            <span class="input-group-addon"><i class="icofont icofont-calendar"></i></span>
                                            <input type="date" class="form-control" id="due_date" name="due_date">
                                            <span class="text-danger" id="dueDateError"></span>
                                        </div>

                                        <!-- Assigned To (Select2) -->
                                        <div class="mb-3 col-lg-6 input-group">
                                            <span class="input-group-addon"><i class="icofont icofont-user"></i></span>
                                            <select class="form-control" id="assigned_to" name="assigned_to[]" multiple>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                            
                                            <span class="text-danger" id="assignedToError"></span>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <select class="form-control tags" name="tags[]" id="tags" multiple="multiple"></select>
                                    </div>

                                    <!-- Task Description -->
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Task Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter task description"></textarea>
                                        <span class="text-danger" id="descriptionError"></span>
                                    </div>

                                    <!-- Submit Button -->
                                    <button  id="createTaskButton" type="submit" class="btn btn-primary">Submit</button>
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
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function () {
    function clearErrors() {
        $('#titleError, #statusError, #dueDateError, #assignedToError, #descriptionError').text('');
    }

    $('#task-form').on('submit', function (e) {
        e.preventDefault();

        // Clear previous errors
        clearErrors();  

        // Form values
        var title = $('#title').val().trim();
        var status = $('#status').val();
        var dueDate = $('#due_date').val().trim();
        var assignedTo = $('#assigned_to').val();
        var description = $('#description').val().trim();

        var isValid = true;

        // Title Validation
        if (title === '') {
            $('#titleError').text('Please enter the task title.');
            isValid = false;
        }

        // Status Validation
        if (status === '') {
            $('#statusError').text('Please select a status.');
            isValid = false;
        }

        // Due Date Validation
        if (dueDate === '') {
            $('#dueDateError').text('Please select a due date.');
            isValid = false;
        }

        // Assigned To Validation
        if (!assignedTo) {
            $('#assignedToError').text('Please select an assignee.');
            isValid = false;
        }

        // Description Validation
        if (description === '') {
            $('#descriptionError').text('Please enter a task description.');
            isValid = false;
        }

        // Submit if valid
        if (isValid) {
            this.submit();
        }
    });

    // Initialize Select2 for Assignee field
    $("#assigned_to").select2({
        placeholder: "Select Assignee",
        allowClear: true,
    });

    $("#tags").select2({
        placeholder: "Select Tags",
        allowClear: true,
        ajax: {
            url: "{{ route('select') }}",  // Laravel route
            type: "POST",  // POST method to send the request
            delay: 250,  // Debounce AJAX requests
            dataType: "json",  // Expect JSON response
            data: function (params) {
                return {
                    name: params.term,  // Search term entered by user
                    _token: "{{ csrf_token() }}"  // CSRF token for security
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            id: item.id,  // Map 'id'
                            text: item.text  // Map 'text' (user name)
                        };
                    })
                };
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("AJAX error:", textStatus, errorThrown); // Debug AJAX issues
            }
        }
    });
});
</script>
@endsection
