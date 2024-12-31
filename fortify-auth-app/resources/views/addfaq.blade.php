@extends('layout')

@section('title')
Add FAQ
 @endsection

 @section('activemanagefaq')
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
                    <h4>Add FAQ</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Add FAQ</a></li>
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
                            <h5 class="card-header-text">Add FAQ</h5>
                            </div>
                            
                            <div class="card-body">
                                <form action="{{ route('faq.store') }}" method="POST" id="faq-form"  class="m-2">
                                    @csrf
                                    <!--quetion-->
                                    <div class="mb-3 col-lg-6 input-group">
                                        <span class="input-group-addon"><i class="ti-info"></i></span>
                                        <input type="text" name="question" id="question" class="form-control" placeholder="Enter your question" >
                                        @error('question')
                                            {{$message}}
                                        @enderror
                                    </div>
                                    <div>
                                        <span class="text-danger" id="questionError"></span>
                                    </div>

                                    <div class="mb-3 col-lg-6 input-group">
                                        <span class="input-group-addon"><i class="ti-comment-alt"></i></span>
                                        <textarea name="answer" id="answer" class="form-control" placeholder="Enter your answer" rows="5"></textarea>
                                    </div>
                                    <div>
                                        <span class="text-danger" id="answerError"></span>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Faq</button>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('#faq-form').on('submit', function (e) {
            e.preventDefault();  // Prevent the default form submission

            // Clear previous errors
            $('#Error').text('');

            var question = $('#question').val().trim();
            var answer = $('#answer').val().trim();

            var isValid = true;

            // Title Validation
            if (question === '') {
                $('#questionError').text('Please enter question.');
                isValid = false;
            }

            if (answer === '') {
                $('#answerError').text('Please enter answer.');
                isValid = false;
            }

            // If validation passed, submit the form
            if (isValid) {
                // Submit the form manually
                this.submit(); 
            }
        });
    });
</script>
@endsection
