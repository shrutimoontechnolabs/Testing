@extends('layouts.manageadminlayout')


@section('title')
Manage Role
@endsection

@section('activemanagerole')
active
@endsection

@section('content')
<div id="confirmationModal" class="modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.6); z-index: 9999;">
    <div class="modal-content">
        <h5 class="modal-title" style="color: #333;">Confirm Deletion</h5>
        <p style="color: #666;">Are you sure you want to delete this user?</p>
        <div class="modal-actions" style="margin-top: 20px; text-align: center;">
            <button id="confirmDelete" class="btn btn-danger" style="padding: 10px 20px; border-radius: 5px; background-color: #dc3545; color: white; border: none;">Yes, Delete</button>
            <button id="cancelDelete" class="btn btn-secondary" style="padding: 10px 20px; border-radius: 5px; background-color: #6c757d; color: white; border: none;">Cancel</button>
        </div>
    </div>
</div>
<div class="pcoded-inner-content">
   <!-- Main body start -->
   <div class="main-body">
       <div class="page-wrapper">
           <!-- Page-header start -->
           <div class="page-header">
               <div class="page-header-title">
                   <h4>Manage Role</h4>
               </div>
               <div class="page-header-breadcrumb">
                   <ul class="breadcrumb-title">
                       <li class="breadcrumb-item">
                           <a href="{{ route('dashboard') }}">
                               <i class="icofont icofont-home"></i>
                           </a>
                       </li>
                       <li class="breadcrumb-item"><a href="#!">Manage Role</a></li>
                   </ul>
               </div>
           </div>
           <!-- Page-header end -->

           <!-- Page-body start -->
           <div class="page-body">
               <div class="row">
                   <div class="col-lg-12">
                       {{-- @if (session('status'))
                           <div class="alert alert-success">
                               {{ session('status') }}
                           </div>
                       @endif --}}
                       <div id="toast" style="position: fixed; top: 20px; right: 20px; z-index: 9999; display: none;">
                        <div id="toast-message" class="toast-message" style="background-color: #28a745; color: white; padding: 10px 20px; border-radius: 5px; min-width: 400px; box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);">
                            <!-- Message will be inserted here -->
                        </div>
                        </div>
                        
                       <div class="card">
                            <div class="row">
                                <!-- Card Header -->
                                <div class="col-12">
                                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Manage Role</h5>
                                        <!-- Add Role Button -->
                                        <a href="{{ route('role.create') }}" class="btn btn-primary d-flex align-items-center text-white text-decoration-none">
                                            <span class="pcoded-micon me-2"><i class="icofont icofont-people"></i></span>
                                            <span class="pcoded-mtext">Add Role</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        
                        
                    
                           <div class="card-body m-2">
                               <!-- Add .table-responsive class -->
                               <div class="table-responsive">
                                   <table class="table table-striped datatable">
                                       <thead>
                                           <tr>
                                               <th>#</th>
                                               <th>Title</th>
                                               <th>Status</th>
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
           <!-- Page-body end -->
       </div>
   </div>
   <!-- Main body end -->
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        let table = $('.datatable').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: '{{ route("roles.index") }}',
                type: 'GET'
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]

        });


        //delete role

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

// Handling the role deletion
$('.datatable').on('click', '.delete-role', function() {
    const roleId = $(this).data('id');
    
    if (roleId) {
        // Show the custom confirmation modal
        $('#confirmationModal').fadeIn();

        // Confirm the deletion
        $('#confirmDelete').on('click', function() {
            $.ajax({
                url: `{{ url('roles') }}/${roleId}`,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        $('.datatable').DataTable().ajax.reload(null, false);
                        showToast("Role deleted successfully!", "#28a745");
                    } else {
                        showToast("Error deleting role.", "#dc3545");
                    }
                    $('#confirmationModal').fadeOut(); // Hide modal after action
                },
                error: function() {
                    showToast("Error deleting role.", "#dc3545");
                    $('#confirmationModal').fadeOut(); // Hide modal if error
                }
            });
        });

        // Cancel the deletion
        $('#cancelDelete').on('click', function() {
            $('#confirmationModal').fadeOut(); // Hide modal if canceled
        });
    }
});

        const editableColumns = [1, 2];
        let currentEditableRow = null;

    //     //edit role
  
    $('.datatable').on('click', '.edit-role', function() {
    const roleId = $(this).data('id');
    
    // Redirect to the edit page with the role's ID
    if (roleId) {
        window.location.href = `{{ url('roles') }}/${roleId}/edit`;
    }
});


        function makeEditableRow(currentRow){
          currentRow.find('td').each(function(index){
            
            const currentCell = $(this);
            const currentText = currentCell.text().trim();

            if(editableColumns.includes(index)){
                currentCell.html(`<input type="text" class="form-control editable-input" value="${currentText}" />`);
            }
          });
        }

        function resetEditableRow(currentEditableRow) {
          currentEditableRow.find('td').each(function(index) {
            const currentCell = $(this);

            if (editableColumns.includes(index)) {
              const currentValue = currentCell.find('input').val();
              currentCell.html(`${currentValue}`);
            }
          });

          const roleId = currentEditableRow.find('.btn-update').data('id');

          currentEditableRow.find('td:last').html(`
            <button class="btn btn-success btn-sm edit-role" data-id="${roleId}">Edit</button>
            <button class="btn btn-danger btn-sm delete-role" data-id="${roleId}">Delete</button>
          `);
            currentEditableRow = null; // Clear the current editable row
        }

        $('table').on('click', '.btn-update', function() {
          const roleId = $(this).data('id');
          const currentRow = $(this).closest('tr');
          const updatedRoleData = {};

          currentRow.find('td').each(function(index) {
            if (editableColumns.includes(index)) {
              const inputValue = $(this).find('input').val();

              if (index === 1) updatedRoleData.title = inputValue;
              if (index === 2) updatedRoleData.status = inputValue;
              
            }
          });
 

          $.ajax({
            url: '{{ route('roles.update') }}',
              type: 'POST',
              data: {
                _method: "POST",
                id: roleId,
                title: updatedRoleData.title,
                status: updatedRoleData.status,
                
                _token: "{{ csrf_token() }}"
              },
                    success: function(response) {
                        if (response.status === 'success') {
                            table.ajax.reload(null,
                            false); // Reload table without resetting pagination
                            table.rowReorder.enable(); // Re-enable rowReorder
                            alert('Role updated successfully!');
                        } else {
                            alert(response.message || 'Failed to update role.');
                        }
                    },
                    error: function(error) {
                        console.error(error);
                        alert('Error occurred while updating the role.');
                    }
                });

                // Reset the row regardless of success or failure
                resetEditableRow(currentRow);
                currentEditableRow = null;
            });
    });
    
  </script>
@endsection