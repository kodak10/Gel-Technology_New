@extends('layouts.master')

@section('content')
<!-- page-banner start -->
<section class="page-banner pt-xs-80 pt-sm-80 overflow-hidden">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-banner__content mb-xs-10 mb-sm-15 mb-md-15 mb-20">
                    <div class="transparent-text">Details</div>
                    <div class="page-title">
                        <h1><span>{{ $service->categorie->name ?? 'Service' }}</span> - {{ $service->title }}</h1>
                    </div>
                </div>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('accueil') }}">Accueil</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('services') }}">Services</a></li>
                        <li class="breadcrumb-item"><a href="#">{{ $service->categorie->name ?? 'Service' }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $service->title }}</li>
                    </ol>
                </nav>
            </div>

            <div class="col-md-6">
                <div class="page-banner__media mt-xs-30 mt-sm-40">
                    <img src="{{ asset('assets/img/page-banner/page-banner-start.svg') }}" class="img-fluid start" alt="">
                    <img src="{{ $service->image_url ?: asset('assets/img/page-banner/page-banner.jpg') }}" class="img-fluid" alt="{{ $service->title }}">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- page-banner end -->

<!-- services-details start -->
<section class="services-details pb-xs-80 pt-xs-80 pt-sm-100 pb-sm-100 pt-md-100 pb-md-100 pt-120 pb-115 overflow-hidden">
    <div class="container">
        <div class="row" data-sticky_parent>
            <div class="col-xl-8" data-sticky_column>
                <div class="media mb-40 mb-md-35 mb-sm-30 mb-xs-25">
                    <img src="{{ $service->image_url ?: asset('assets/img/project-details/project-details.png') }}" alt="{{ $service->title }}" class="img-fluid w-100" style="border-radius: 10px;">
                </div>

                <div class="services-details__content">
                    <h2>{{ $service->title }}</h2>

                    @if($service->short_description)
                        <p class="lead">{{ $service->short_description }}</p>
                    @endif

                    {!! $service->full_description !!}

                    @if($service->features)
                        <ul>
                            @foreach(json_decode($service->features, true) ?? [] as $feature)
                                <li><i class="fas fa-check-circle text-success me-2"></i> {{ $feature }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="col-xl-4">
                <div class="main-sidebar" data-sticky_column>
                    <!-- Services de la même catégorie -->
                    <div class="single-sidebar-widget mb-40 pt-30 pr-30 pb-40 pl-30 pl-xs-20 pr-xs-20">
                        <h4 class="wid-title mb-30 mb-xs-20 color-d_black text-capitalize">Services de la même catégorie</h4>

                        <div class="widget_categories">
                            <ul>
                                @foreach($sameCategoryServices as $sameService)
                                <li>
                                    <a href="{{ route('service.details', $sameService->slug) }}">
                                        {{ $sameService->title }} 
                                        <i class="fas fa-long-arrow-alt-right"></i>
                                    </a>
                                </li>
                                @endforeach
                                
                                @if($sameCategoryServices->isEmpty())
                                    <li>Aucun autre service dans cette catégorie</li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <!-- Contact Widget -->
                    <div class="single-sidebar-widget have-any mb-40 pt-30 pr-30 pb-40 pl-30 pl-xs-20 pr-xs-20">
                        <div class="media">
                            <img src="{{ asset('assets/img/services-details/have-any.png') }}" alt="">
                        </div>

                        <div class="have-any__item text-center" style="background-image: url({{ asset('assets/img/services-details/have-any-bottom.png') }});">
                            <h4 class="wid-title mb-20 mb-xs-15 color-white text-capitalize">Vous avez des questions ?</h4>

                            <a href="{{ route('contact') }}" class="theme-btn">Contactez-Nous <i class="fab fa-telegram-plane"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- services-details end -->

<!-- Nos Réalisations -->
<section class="our-team our-porfolio pb-xs-80 pt-xs-80 pt-sm-100 pb-sm-100 pt-md-100 pb-md-100 pt-70 pb-60 overflow-hidden">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="our-team__content mb-65 mb-md-50 mb-sm-40 mb-xs-30 text-center mx-auto wow fadeInUp" data-wow-delay=".3s">
                    <span class="sub-title fw-500 text-uppercase mb-sm-10 mb-xs-5 mb-15 d-block color-red">
                        <img src="{{ asset('assets/img/home/line.svg') }}" class="img-fluid mr-10" alt=""> Nos Réalisations
                    </span>
                    <h2 class="title">Découvrez nos projets récents</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="our-porfolio__slider wow fadeInUp" data-wow-delay=".5s">
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

                    <a href="{{ route('realisation.details', $project->id) }}" class="theme-btn">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Nos Solutions -->
<section class="our-portfolio-home pb-xs-80 pt-xs-80 pt-sm-100 pb-sm-100 pt-md-100 pb-md-100 pt-60 pb-60 overflow-hidden bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="our-portfolio-home__content text-center mb-60 mb-sm-50 mb-xs-40 wow fadeInUp" data-wow-delay=".3s">
                    <span class="sub-title fw-500 text-uppercase mb-sm-10 mb-xs-5 mb-15 d-block color-red">
                        <img src="{{ asset('assets/img/home/line.svg') }}" class="img-fluid mr-10" alt=""> Autres Solutions
                    </span>
                    <h2 class="title">Découvrez nos autres services</h2>
                </div>
            </div>
        </div>

        <div class="row mb-minus-30">
            @foreach($sameCategoryServices->take(4) as $otherService)
            <div class="col-xl-3 col-md-4 col-12">
                <div class="our-portfolio-home__item mb-30 wow fadeInUp" data-wow-delay=".3s">
                    <div class="featured-thumb">
                        <div class="media overflow-hidden">
                            <div style="position: relative; width: 100%; height: 200px; overflow: hidden;">
                                @if($otherService->image_url)
                                    <img src="{{ $otherService->image_url }}" class="img-fluid" alt="{{ $otherService->title }}" 
                                        style="width: 100% !important; height: 200px; object-fit: cover;">
                                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.4);"></div>
                                @else
                                    <img src="{{ asset('assets/img/home/our-portfolio-home__item-1.png') }}" class="img-fluid" alt="">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="content d-flex flex-row">
                        <div class="left">
                            <div class="post-author mb-5 mb-xs-5 text-uppercase">
                                <a href="#">{{ $otherService->categorie->name ?? 'Solution' }}</a>
                            </div>

                            <h5 class="color-pd_black mb-15 mb-xs-10">
                                <a href="{{ route('service.details', $otherService->slug) }}">{{ $otherService->title }}</a>
                            </h5>
                        </div>

                        <div class="btn-link-share">
                            <a href="{{ route('service.details', $otherService->slug) }}" class="theme-btn color-pd_black" style="background-image: url({{ asset('assets/img/home/theme-btn-overly.png') }})">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-12">
                <div class="our-portfolio-home__read-more text-center mt-50 mt-md-40 mt-sm-35 mt-xs-30 wow fadeInUp" data-wow-delay=".3s">
                    <a href="{{ route('services') }}" class="theme-btn btn-border">Tous Nos Services <i class="fas fa-chevron-double-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection