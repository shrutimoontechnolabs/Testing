@extends('layouts.fullcalenderlayout')

@section('title')
Calender
 @endsection
 <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet">

 @section('activecalender')
 active
 @endsection

 @section('content')
 <div id="confirmationModal" class="modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.6); z-index: 9999;">
    <div class="modal-content">
        <h5 class="modal-title" style="color: #333;">Confirm Deletion</h5>
        <p style="color: #666;">Are you sure you want to remove?</p>
        <div class="modal-actions" style="margin-top: 20px; text-align: center;">
            <button id="confirmDelete" class="btn btn-danger" style="padding: 10px 20px; border-radius: 5px; background-color: #dc3545; color: white; border: none;">Yes, Delete</button>
            <button id="cancelDelete" class="btn btn-secondary" style="padding: 10px 20px; border-radius: 5px; background-color: #6c757d; color: white; border: none;">Cancel</button>
        </div>
    </div>
</div>


<!-- Custom Prompt Modal HTML -->
<div id="customPromptModal" class="custom-prompt-modal" style="display:none;">
    <div class="custom-prompt-content">
        <h4 class="custom-prompt-title">Enter Event Title</h4>
        <input type="text" id="eventTitle" class="form-control" placeholder="Enter title here" />
        <div class="custom-prompt-actions">
            <button id="cancelPrompt" class="btn btn-secondary">Cancel</button>
            <button id="confirmPrompt" class="btn btn-primary">Create Event</button>
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
                    <h4>Calender</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Calender</a></li>
                    </ul>
                </div>
            </div>
            <!-- Page-header end -->
            <div id="toast" style="position: fixed; top: 20px; right: 20px; z-index: 9999; display: none;">
                <div id="toast-message" class="toast-message" style="background-color: #28a745; color: white; padding: 10px 20px; border-radius: 5px; min-width: 400px; box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);">
                    <!-- Message will be inserted here -->
                </div>
                </div>  
            <!-- Page-body start -->
            <div class="page-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-header-text">Calender</h5>
                            </div>

                            <div class="card-body m-2">
                                <div id="calender"></div>
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
 