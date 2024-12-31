@extends('layout')

@section('title')
Edit Cms
@endsection

@section('activemanagecms')
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
                    <h4>Edit cms</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Edit cms</a></li>
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
                                <h5 class="card-header-text">Edit cms</h5>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('cmss.update') }}" method="POST" class="m-2">
                                    @csrf
                                    @method('POST')

                                    <input type="hidden" name="id" value="{{ $cms->id }}">

                                    <!-- Title Field -->
                                    <div class="mb-3  input-group">
                                        <span class="input-group-addon"><i class="ti-info"></i></span>
                                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $cms->title) }}" placeholder="Enter title Name">
                                        @if ($errors->has('title'))
                                            <span class="text-danger">{{ $errors->first('title') }}</span>
                                        @endif
                                    </div>

                                    <!-- Description Field -->
                                    <div class="mb-3 input-group">
                                        <span class="input-group-addon"><i class="ti-comment-alt"></i></span>
                                        <textarea name="description" id="description" class="form-control" placeholder="Enter your Description" rows="5">{{ old('description', $cms->description) }}</textarea>
                                        @if ($errors->has('description'))
                                            <span class="text-danger">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>

                                    <!-- Submit Button -->
                                    <button id="updateBtn" type="submit" class="btn btn-primary">Update CMS</button>
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
