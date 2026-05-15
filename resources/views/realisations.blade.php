@extends('layouts.master')
@section('content')
<!-- page-banner start -->
<section class="page-banner pt-xs-80 pt-sm-80 overflow-hidden">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-banner__content mb-xs-10 mb-sm-15 mb-md-15 mb-20">
                    <div class="transparent-text">Réalisations</div>
                    <div class="page-title">
                        <h1>Nos <span>Réalisations</span></h1>
                    </div>
                </div>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Réalisations</li>
                    </ol>
                </nav>
            </div>

            <div class="col-md-6">
                <div class="page-banner__media mt-xs-30 mt-sm-40">
                    <img src="{{ asset('assets/img/page-banner/page-banner-start.svg') }}" class="img-fluid start" alt="">
                    <img src="{{ asset('assets/img/page-banner/page-banner.jpg') }}" class="img-fluid" alt="Nos réalisations">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- page-banner end -->

<section class="our-team our-porfolio pb-xs-80 pt-xs-80 pt-sm-100 pb-sm-100 pt-md-100 pb-md-100 pt-70 pb-60 overflow-hidden">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="our-team__content mb-65 mb-md-50 mb-sm-40 mb-xs-30 text-center mx-auto wow fadeInUp" data-wow-delay=".3s">
                    <span class="sub-title fw-500 text-uppercase mb-sm-10 mb-xs-5 mb-15 d-block color-red">
                        <img src="{{ asset('assets/img/home/line.svg') }}" class="img-fluid mr-10" alt=""> Nos Réalisations
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="our-porfolio__slider wow fadeInUp" data-wow-delay="2.5s">
        @foreach($projects as $project)
        <div class="slider-item">
            <div class="our-project__item overflow-hidden">
                <img src="{{ $project->image_url ?: asset('assets/img/portfolio/portfolio-1.png') }}" alt="{{ $project->title }}">

                <div class="content d-flex align-items-center justify-content-between">
                    <div class="text">
                        <span class="fw-500 color-yellow d-block mb-10 text-uppercase">{{ $project->category ?: 'Réalisation' }}</span>
                        <h5 class="title color-secondary">{{ $project->title }}</h5>
                        @if($project->description)
                            <p class="small text-white mt-2">{{ Str::limit($project->description, 80) }}</p>
                        @endif
                    </div>

                    <a href="#" class="theme-btn">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>



@endsection