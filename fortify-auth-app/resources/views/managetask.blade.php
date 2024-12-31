@extends('layouts.manageadminlayout')

@section('title')
Manage Task
@endsection

@section('activemanagetask')
active
@endsection

@section('content')
<div id="confirmationModal" class="modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.6); z-index: 9999;">
    <div class="modal-content">
        <h5 class="modal-title" style="color: #333;">Confirm Deletion</h5>
        <p style="color: #666;">Are you sure you want to delete this task?</p>
        <div class="modal-actions" style="margin-top: 20px; text-align: center;">
            <button id="confirmDelete" class="btn btn-danger" style="padding: 10px 20px; border-radius: 5px; background-color: #dc3545; color: white; border: none;">Yes, Delete</button>
            <button id="cancelDelete" class="btn btn-secondary" style="padding: 10px 20px; border-radius: 5px; background-color: #6c757d; color: white; border: none;">Cancel</button>
        </div>
    </div>
</div>
<div class="pcoded-inner-content">
   <div class="main-body">
       <div class="page-wrapper">
           <div class="page-header">
               <div class="page-header-title">
                   <h4>Manage Task</h4>
               </div>
               <div class="page-header-breadcrumb">
                   <ul class="breadcrumb-title">
                       <li class="breadcrumb-item">
                           <a href="{{ route('dashboard') }}">
                               <i class="icofont icofont-home"></i>
                           </a>
                       </li>
                       <li class="breadcrumb-item"><a href="#!">Manage Task</a></li>
                   </ul>
               </div>
           </div>

           <div class="page-body">
               <div class="row">
                   <div class="col-lg-12">
                       <div id="toast" style="position: fixed; top: 20px; right: 20px; z-index: 9999; display: none;">
                           <div id="toast-message" class="toast-message" style="background-color: #28a745; color: white; padding: 10px 20px; border-radius: 5px; min-width: 400px; box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);"></div>
                       </div>
                       <div class="card">
                           <div class="row">
                               <div class="col-12">
                                   <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                                       <h5 class="mb-0">Manage Task</h5>
                                       <a href="{{ route('task.create') }}" class="btn btn-primary d-flex align-items-center text-white text-decoration-none">
                                           <span class="pcoded-micon me-2"><i class="icofont icofont-task"></i></span>
                                           <span class="pcoded-mtext">Add Task</span>
                                       </a>
                                   </div>
                               </div>
                           </div>

                           <div class="card-body m-2">
                               <div class="table-responsive">
                                   <table class="table table-striped datatable">
                                       <thead>
                                           <tr>
                                               <th>#</th>
                                               <th>Title</th>
                                               <th>Description</th>
                                               <th>Status</th>
                                               <th>Due Date</th>
                                               <th>Assigned To</th>
                                               <th>Action</th>
                                           </tr>
                                       </thead>
                                   </table>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        let table = $('.datatable').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: '{{ route("tasks.index") }}',
                type: 'GET'
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                { data: 'description', name: 'description' },
                { data: 'status', name: 'status' },
                { data: 'due_date', name: 'due_date' },
                {
                    data: 'assigned_to',
                    name: 'assigned_to',
                    render: function(data, type, row) {
                        return data || 'N/A'; // Render the names or show 'N/A' if not available
                    }
                },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        function showToast(message, color) {
            var toastContainer = document.getElementById('toast');
            var toastMessage = document.getElementById('toast-message');
            toastMessage.style.backgroundColor = color;
            toastMessage.textContent = message;
            toastContainer.style.display = 'block';

            setTimeout(function() {
                toastContainer.classList.add('toast-hide');
            }, 5000);

            setTimeout(function() {
                toastContainer.style.display = 'none';
                toastContainer.classList.remove('toast-hide');
            }, 5500);
        }

        // Handling task deletion
        $('.datatable').on('click', '.delete-task', function() {
            const taskId = $(this).data('id');
            if (taskId) {
                $('#confirmationModal').fadeIn();

                $('#confirmDelete').on('click', function() {
                    $.ajax({
                        url: `{{ url('tasks') }}/${taskId}`,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                table.ajax.reload(null, false);
                                showToast("Task deleted successfully!", "#28a745");
                            } else {
                                showToast("Error deleting task.", "#dc3545");
                            }
                            $('#confirmationModal').fadeOut();
                        },
                        error: function() {
                            showToast("Error deleting task.", "#dc3545");
                            $('#confirmationModal').fadeOut();
                        }
                    });
                });

                $('#cancelDelete').on('click', function() {
                    $('#confirmationModal').fadeOut();
                });
            }
        });

        $('.datatable').on('click', '.edit-task', function() {
            const taskId = $(this).data('id');
            if (taskId) {
                window.location.href = `{{ url('tasks') }}/${taskId}/edit`;
            }
        });

        $('.datatable').on('click', '.view-task', function() {
        const taskId = $(this).data('id'); // Get the task ID from the data attribute
        if (taskId) {
            // Redirect to the task view page
            window.location.href = `{{ url('tasks') }}/${taskId}/view`;
        }
        });
    });
</script>
<script>
    // Track task creation
    document.getElementById('createTaskButton').addEventListener('click', () => {
        trackEvent('task_created', 'Task Creation', { task_name: 'New Task', page: '/tasks/create' });
    });

    // Track task status change
    document.querySelectorAll('.task-status-button').forEach(button => {
        button.addEventListener('click', () => {
            trackEvent('task_status_changed', 'Task Status', { task_id: button.dataset.taskId, status: button.dataset.status });
        });
    });
</script>

@endsection
