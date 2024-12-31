@extends('layouts.manageadminlayout')


@section('title')
Manage Role
@endsection

@section('activemanagefaq')
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
                                        <a href="{{ route('faq.create') }}" class="btn btn-primary d-flex align-items-center text-white text-decoration-none">
                                            <span class="pcoded-micon me-2"><i class="icofont icofont-people"></i></span>
                                            <span class="pcoded-mtext">Add Faq</span>
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
                url: '{{ route("faqs.index") }}',
                type: 'GET'
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'question', name: 'question' },
                { data: 'answer', name: 'answer', render: function(data, type, row) {
                return data.length > 50 ? data.substr(0, 50) + '...' : data; 
            }},
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]

        });


        //delete faq

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

// Handling the faq deletion
$('.datatable').on('click', '.delete-faq', function() {
    const faqId = $(this).data('id');
    
    if (faqId) {
        // Show the custom confirmation modal
        $('#confirmationModal').fadeIn();

        // Confirm the deletion
        $('#confirmDelete').on('click', function() {
            $.ajax({
                url: `{{ url('faqs') }}/${faqId}`,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        $('.datatable').DataTable().ajax.reload(null, false);
                        showToast("faq deleted successfully!", "#28a745");
                    } else {
                        showToast("Error deleting faq.", "#dc3545");
                    }
                    $('#confirmationModal').fadeOut(); // Hide modal after action
                },
                error: function() {
                    showToast("Error deleting faq.", "#dc3545");
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

    //     //edit faq
  
    $('.datatable').on('click', '.edit-faq', function() {
    const faqId = $(this).data('id');
    
    // Redirect to the edit page with the faq's ID
    if (faqId) {
        window.location.href = `{{ url('faqs') }}/${faqId}/edit`;
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

          const faqId = currentEditableRow.find('.btn-update').data('id');

          currentEditableRow.find('td:last').html(`
            <button class="btn btn-success btn-sm edit-faq" data-id="${faqId}">Edit</button>
            <button class="btn btn-danger btn-sm delete-faq" data-id="${faqId}">Delete</button>
          `);
            currentEditableRow = null; // Clear the current editable row
        }

        $('table').on('click', '.btn-update', function() {
          const faqId = $(this).data('id');
          const currentRow = $(this).closest('tr');
          const updatedFaqData = {};

          currentRow.find('td').each(function(index) {
            if (editableColumns.includes(index)) {
              const inputValue = $(this).find('input').val();

              if (index === 1) updatedFaqData.question = inputValue;
              if (index === 2) updatedFaqData.answer = inputValue;
              
            }
          });
 

          $.ajax({
            url: '{{ route('faqs.update') }}',
              type: 'POST',
              data: {
                _method: "POST",
                id: faqId,
                question: updatedFaqData.question,
                answer: updatedFaqData.answer,
                
                _token: "{{ csrf_token() }}"
              },
                    success: function(response) {
                        if (response.status === 'success') {
                            table.ajax.reload(null,
                            false); // Reload table without resetting pagination
                            table.rowReorder.enable(); // Re-enable rowReorder
                            alert('Faq updated successfully!');
                        } else {
                            alert(response.message || 'Failed to update faq.');
                        }
                    },
                    error: function(error) {
                        console.error(error);
                        alert('Error occurred while updating the faq.');
                    }
                });

                // Reset the row regardless of success or failure
                resetEditableRow(currentRow);
                currentEditableRow = null;
            });
    });
    
  </script> 
@endsection