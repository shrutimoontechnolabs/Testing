@extends('layout')

@section('title')
CMS
@endsection

@section('link')
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.0.0/ckeditor5.css" />

@endsection

@section('activecms')
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
                    <h4>CMS</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">CMS</a></li>
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
                                <h5 class="card-header-text">CMS</h5>
                            </div>
                            
                            <div class="card-body">
                                <form action="{{ route('cms.store') }}" method="POST" id="faq-form"  class="m-2">
                                    @csrf
                                    <!--quetion-->
                                    <div class="mb-3 input-group">
                                        <span class="input-group-addon"><i class="ti-info"></i></span>
                                        <input type="text" name="title" id="title" class="form-control" placeholder="Enter your title" >
                                    </div>
                                    <div>
                                        <span class="text-danger" id="titleError"></span>
                                    </div>

                                    <div class="mb-3 input-group">
                                        <span class="input-group-addon"><i class="ti-comment-alt"></i></span>
                                        <textarea name="description" id="description" class="form-control" placeholder="Enter your Description" rows="5"></textarea>
                                    </div>
                                    <div>
                                        <span class="text-danger" id="answerError"></span>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Cms</button>
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

@endsection

@section('script')
<script src="https://cdn.ckeditor.com/4.20.2/full/ckeditor.js"></script>
<script>
    // Initialize CKEditor for the description field
    CKEDITOR.replace('description');
</script>
@endsection