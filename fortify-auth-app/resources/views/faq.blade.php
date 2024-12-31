@extends('layouts.faqlayout')

@section('title')
FAQ
@endsection

@section('activefaq')
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
                    <h4>FAQ</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">FAQ</a></li>
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
                                <h5 class="card-header-text">Frequently Asked Questions</h5>
                            </div>
                            
                            <div class="card-body">
                                <div class="faq-accordion">
                                    @foreach($faqs as $faq)
                                    <div class="faq-item">
                                        <div class="faq-question">
                                            <h4>{{ $faq->question }}</h4>
                                            <span class="toggle-icon">+</span>
                                        </div>
                                        <div class="faq-answer">
                                            <p>{{ $faq->answer }}</p>
                                        </div>
                                    </div>
                                    @endforeach
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