@extends('layouts.manageadminlayout')

@section('title')
Manage Contact
@endsection

@section('activecontact')
active
@endsection

@section('content')
<div id="confirmationModal" class="modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.6); z-index: 9999;">
    <div class="modal-content">
        <h5 class="modal-title" style="color: #333;">Confirm Deletion</h5>
        <p style="color: #666;">Are you sure you want to delete this contact?</p>
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
                    <h4>Manage Contact</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Manage Contact</a></li>
                    </ul>
                </div>
            </div>
            <!-- Page-header end -->

            <!-- Page-body start -->
            <div class="page-body">
                <div class="row">
                    <div class="col-lg-12">
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
                                        <!-- Card Title -->
                                        <h5 class="mb-0">Manage Contact</h5>
                                        <div class="row">
                                        <!-- Button Container (for Add Contact and Import Contacts) -->
                                            <div class="col-6">
                                                <!-- Add Contact Button -->
                                                <a href="{{ route('contact.create') }}" class="btn btn-primary d-flex align-items-center text-decoration-none">
                                                    <span class="pcoded-micon me-2"><i class="icofont icofont-people"></i></span>
                                                    <span class="pcoded-mtext">Add Contact</span>
                                                </a>
                                            </div>
                                            <div class="col-6"> 
                                                <!-- Import Contacts Button -->
                                                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#importModal">Import Contacts</button>
                                            </div>
                                        </div>
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
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Contact</th>
                                                <th>Secondary Contact</th>
                                                <th>Email</th>
                                                <th>Date of Birth</th>
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

<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="importModalLabel">Import Contacts</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- CSV Upload Form -->
          <form action="{{ route('contacts.import') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                  <label for="csv_file">Upload CSV file:</label>
                  <input type="file" name="csv_file" id="csv_file" required class="form-control">
              </div>
              <button type="submit" class="btn btn-success mt-2">Import Contacts</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Bootstrap 5 JS (for modal functionality) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        let table = $('.datatable').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: '{{ route("contacts.index") }}',
                type: 'GET'
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'fname', name: 'fname' },
                { data: 'lname', name: 'lname' },
                { data: 'contact', name: 'contact' },
                { data: 'secondary_contact', name: 'secondary_contact' },
                { data: 'email', name: 'email' },
                { data: 'dob', name: 'dob' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        //delete contact
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

        // Handling the contact deletion
        $('.datatable').on('click', '.delete-contact', function() {
            const contactId = $(this).data('id');
            
            if (contactId) {
                // Show the custom confirmation modal
                $('#confirmationModal').fadeIn();

                // Confirm the deletion
                $('#confirmDelete').on('click', function() {
                    $.ajax({
                        url: `{{ url('contacts') }}/${contactId}`,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                $('.datatable').DataTable().ajax.reload(null, false);
                                showToast("Contact deleted successfully!", "#28a745");
                            } else {
                                showToast("Error deleting contact.", "#dc3545");
                            }
                            $('#confirmationModal').fadeOut(); // Hide modal after action
                        },
                        error: function() {
                            showToast("Error deleting contact.", "#dc3545");
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

        //edit contact
        $('.datatable').on('click', '.edit-contact', function() {
            const contactId = $(this).data('id');
            
            // Redirect to the edit page with the contact's ID
            if (contactId) {
                window.location.href = `{{ url('contacts') }}/${contactId}/edit`;
            }
        });
    });
</script>
@endsection
