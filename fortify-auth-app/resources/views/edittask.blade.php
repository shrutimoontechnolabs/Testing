@extends('layouts.addtasklayout')

@section('title')
Edit Task
@endsection

@section('activemanagetask')
active
@endsection

@section('content')
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice span {
            color: #1a1818 !important;
        }
</style>
<div class="pcoded-inner-content">
    <!-- Main body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page-header start -->
            <div class="page-header">
                <div class="page-header-title">
                    <h4>Edit Task</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Edit Task</a></li>
                    </ul>
                </div>
            </div>
            <!-- Page-header end -->
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <!-- Page-body start -->
            <div class="page-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-header-text">Edit Task</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('tasks.update', $task->id) }}" method="POST" id="task-form" class="m-2">
                                    @csrf
                                    @method('POST')
                                     <!-- Include the method if you're using update with POST -->

                                     <input type="hidden" name="id" value="{{ $task->id }}">

                                    <div class="row">
                                        <!-- Task Title -->
                                        <div class="mb-3 col-lg-6 input-group">
                                            <span class="input-group-addon"><i class="icofont icofont-tasks"></i></span>
                                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $task->title) }}" placeholder="Enter Task Title">
                                            <span class="text-danger" id="titleError"></span>
                                        </div>

                                        <!-- Status -->
                                        <div class="mb-3 col-lg-6 input-group">
                                            <span class="input-group-addon"><i class="icofont icofont-ui-check"></i></span>
                                            <select class="form-control" id="status" name="status">
                                                <option value="Pending" {{ old('status', $task->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="In Progress" {{ old('status', $task->status) == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                                <option value="Completed" {{ old('status', $task->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                                            </select>
                                            <span class="text-danger" id="statusError"></span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Due Date -->
                                        <div class="mb-3 col-lg-6 input-group">
                                            <span class="input-group-addon"><i class="icofont icofont-calendar"></i></span>
                                            <input type="date" class="form-control" id="due_date" name="due_date" value="{{ $task->due_date }}">
                                            <span class="text-danger" id="dueDateError"></span>
                                        </div>

                                        <!-- Assigned To -->
                                        <div class="mb-3 col-lg-6 input-group">
                                            <span class="input-group-addon"><i class="icofont icofont-user"></i></span>
                                            <select class="form-control select2" id="assigned_to" name="assigned_to[]" multiple>
                                                @php
                                                    $assignedTo = is_array(old('assigned_to')) 
                                                        ? old('assigned_to') 
                                                        : explode(',', $task->assigned_to ?? '');
                                                @endphp
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}" 
                                                        {{ in_array($user->id, $assignedTo) ? 'selected' : '' }}>
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger" id="assignedToError"></span>
                                        </div>
                                    </div>

                                    <!-- Task Description -->
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Task Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter task description">{{ old('description', $task->description) }}</textarea>
                                        <span class="text-danger" id="descriptionError"></span>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
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
<!-- Include Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Include Select2 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize Select2
        $('#assigned_to').select2({
            placeholder: "Select Assignees",
            allowClear: true
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#task-form').on('submit', function (e) {
            e.preventDefault();

            // Clear previous errors
            $('#titleError, #statusError, #dueDateError, #assignedToError, #descriptionError').text('');

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
            if (assignedTo === '') {
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
    });
</script>
@endsection
