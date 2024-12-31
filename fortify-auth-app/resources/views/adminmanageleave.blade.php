@extends('layouts.manageadminlayout')

@section('title')
Leave
 @endsection

 @section('activemanageleave')
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
                   <h4>Manage Leave</h4>
               </div>
               <div class="page-header-breadcrumb">
                   <ul class="breadcrumb-title">
                       <li class="breadcrumb-item">
                           <a href="{{ route('dashboard') }}">
                               <i class="icofont icofont-home"></i>
                           </a>
                       </li>
                       <li class="breadcrumb-item"><a href="#!">Manage leave</a></li>
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
                                        <h5 class="mb-0">Manage Leave</h5>
                                        <!-- Add leave Button -->
                                        {{-- <a href="{{ route('leave.create') }}" class="btn btn-primary d-flex align-items-center text-white text-decoration-none">
                                            <span class="pcoded-micon me-2"><i class="icofont icofont-people"></i></span>
                                            <span class="pcoded-mtext">Add Cms</span>
                                        </a> --}}
                                        
                                        <a href="{{ route('download.csv') }}" class="btn btn-primary d-flex align-items-center text-white text-decoration-none">
                                            <span class="pcoded-micon me-2"><i class="icofont icofont-people"></i></span>
                                            <span class="pcoded-mtext">download csv</span>
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
                                               <th>User Name</th>
                                               <th>Start date</th>
                                               <th>Type</th>
                                               <th>End date</th>
                                               <th>Type</th>
                                               <th>Reason</th>
                                               <th>Status</th>  
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
            url: '{{ route("leaves.adminIndex") }}',
            type: 'GET',
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'user_name', name: 'user_name' }, // User ID (or replace with username if available)
            { data: 'start_date', name: 'start_date' },
            { data: 'start_date_type', name: 'start_date_type' },
            { data: 'end_date', name: 'end_date' },
            { data: 'end_date_type', name: 'end_date_type' },
            { data: 'reason', name: 'reason' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
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

    // Handle approve button click
    $('.datatable').on('click', '.approve-leave', function() {
        const leaveId = $(this).data('id');
        $.ajax({
            url: `/leaves/${leaveId}/approve`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                if (response.status === 'success') {
                    table.ajax.reload(null, false);
                    showToast("leave approved successfully!", "#28a745");
                }
            },
            error: function() {
                alert('Failed to approve leave.');
            },
        });
    });

    // Handle reject button click
    $('.datatable').on('click', '.reject-leave', function() {
        const leaveId = $(this).data('id');
        $.ajax({
            url: `/leaves/${leaveId}/reject`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                if (response.status === 'success') {
                    table.ajax.reload(null, false);
                    showToast("leave Rejected.", "#dc3545");
                }
            },
            error: function() {
                alert('Failed to reject leave.');
            },
        });
    });
});


    
  </script>
@endsection