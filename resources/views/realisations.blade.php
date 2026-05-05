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
                        <li class="breadcrumb-item"><a href="{{ route('accueil') }}">Accueil</a></li>
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

                    <a href="#" class="theme-btn">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Témoignages -->
@if($temoignages->count() > 0)
<section class="testimonial bg-dark_white pb-xs-80 pt-xs-80 pt-sm-100 pb-sm-100 pt-md-100 pb-md-100 pt-60 pb-50 overflow-hidden">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="testimonial__content mb-60 mb-md-50 mb-sm-40 mb-xs-30 text-center wow fadeInUp" data-wow-delay=".3s">
                    <span class="sub-title fw-500 text-uppercase mb-sm-10 mb-xs-5 mb-15 d-block color-red">
                        <img src="{{ asset('assets/img/home/line.svg') }}" class="img-fluid mr-10" alt=""> Témoignages
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="container container_testimonial">
        <div class="row">
            <div class="col-12">
                <div class="testimonial-slider wow fadeInUp" data-wow-delay=".5s">
                    @foreach($temoignages as $temoignage)
                    <div class="slider-item">
                        <div class="testimonial__item border--{{ $temoignage->border_color ?? 'primary' }}">
                            <div class="testimonial__item-header d-flex justify-content-between align-items-center mb-35">
                                <div class="left d-flex align-items-center">
                                    <div class="media overflow-hidden">
                                        <img src="{{ $temoignage->avatar_url ?: asset('assets/img/testimonial/testimonial-1.png') }}" 
                                             class="img-fluid" alt="{{ $temoignage->name }}">
                                    </div>
                                    <div class="meta">
                                        <h6 class="name fw-500 text-uppercase color-d_black">{{ $temoignage->name }}</h6>
                                        <span class="position font-la fw-500 color-d_black">{{ $temoignage->position }}</span>
                                    </div>
                                </div>
                                <div class="right">
                                    <div class="starts">
                                        <ul>
                                            @for($i = 1; $i <= 5; $i++)
                                                <li><span class="{{ $i <= $temoignage->rating ? 'filled' : '' }}"></span></li>
                                            @endfor
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="description font-la mb-40">
                                <p>"{{ $temoignage->message }}"</p>
                            </div>
                            <div class="testimonial__item-footer d-flex justify-content-between">
                                <div class="socail-link">
                                    <ul>
                                        @if($temoignage->social_links)
                                            @foreach(json_decode($temoignage->social_links, true) ?? [] as $social)
                                            <li>
                                                <a href="{{ $social['link'] ?? '#' }}" target="_blank">
                                                    <img src="{{ $social['icon'] ?? asset('assets/img/testimonial/discord.png') }}" alt="">
                                                </a>
                                            </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                                <div class="quote color-primary">
                                    <i class="fas fa-quote-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Partenaires -->
@if($partenaires->count() > 0)
<div class="client-brand bg-dark_white pb-xs-80 pb-sm-100 pb-md-100 pb-120 overflow-hidden">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="client-brand__slider wow fadeInUp" data-wow-delay=".5s" data-slick='{
                    "dots": false, 
                    "arrows": false,
                    "autoplay": true,
                    "slidesToShow": 6,
                    "infinite": true,
                    "slidesToScroll": 1,
                    "autoplaySpeed": 3000,
                    "responsive": [
                        {"breakpoint": 1300, "settings": {"slidesToShow": 5}},
                        {"breakpoint": 1200, "settings": {"slidesToShow": 4}},
                        {"breakpoint": 992, "settings": {"slidesToShow": 3}},
                        {"breakpoint": 768, "settings": {"slidesToShow": 2}},
                        {"breakpoint": 481, "settings": {"slidesToShow": 1}}
                    ]
                }'>
                    @foreach($partenaires as $partenaire)
                    <div class="slider-item">
                        <a href="{{ $partenaire->link ?: '#' }}" class="client-brand__item" target="{{ $partenaire->link ? '_blank' : '_self' }}">
                            <div class="client-brand__item-media">
                                <img src="{{ $partenaire->logo_url }}" class="img-fluid" alt="{{ $partenaire->name }}">
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection