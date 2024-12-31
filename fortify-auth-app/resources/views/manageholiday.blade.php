@extends('layouts.manageadminlayout')

@section('title')
Holidays for {{ \Carbon\Carbon::now()->year }}
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
                    <h4>Holidays for {{ \Carbon\Carbon::now()->year }}</h4>
                </div>
                <div id="toast" style="position: fixed; top: 20px; right: 20px; z-index: 9999; display: none;">
                    <div id="toast-message" class="toast-message" style="background-color: #28a745; color: white; padding: 10px 20px; border-radius: 5px; min-width: 400px; box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);">
                        <!-- Message will be inserted here -->
                    </div>
                    </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Holidays</a></li>
                    </ul>
                </div>
            </div>

            <div class="page-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Holiday List</h5>
                                <!-- Add Role Button -->
                                <a href="{{ route('holiday.create') }}" class="btn btn-primary d-flex align-items-center text-white text-decoration-none">
                                    <span class="pcoded-micon me-2"><i class="icofont icofont-people"></i></span>
                                    <span class="pcoded-mtext">Add Holiday</span>
                                </a>
                            </div>
                            <div class="card-body">
                                @if ($holidays->isEmpty())
                                    <p>No holidays available for this year.</p>
                                @else
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Day</th>
                                                <th>Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($holidays as $holiday)
                                                <tr class="{{ $holiday['description'] != 'Weekend' ? 'text-danger' : '' }}">
                                                    <td>{{ $holiday['holiday_date'] }}</td>
                                                    <td>{{ $holiday['day'] }}</td>
                                                    <td>{{ $holiday['description'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
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

</script>
@endsection