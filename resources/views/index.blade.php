@extends('layouts.master')
@section('content')
  
<!-- Banner -->
<section class="banner-slider__wrapper banner-slider__wrapper_2 overflow-hidden">
    <div class="slider-controls slider-controls-2">
        <div class="banner-slider-arrows d-flex flex-column"></div>
    </div>

    <div class="banner-slider_2">
        @foreach($banners as $banner)
        <div class="slider-item" style="background-image: linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)), url({{ $banner->background_image ? asset($banner->background_image) : '' }}); background-size: cover; background-position: center;">            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="banner__content">
                            @if($banner->sub_title)
                            <h6 class="sub-title color-white mb-15 mb-sm-15 mb-xs-10" data-animation="fadeInUp" data-delay="0.5s">
                                {{ $banner->sub_title }}
                            </h6>
                            @endif
                            
                            <h1 class="title color-white mb-sm-30 mb-xs-20 mb-40" data-animation="fadeInUp" data-delay="1s">
                                {!! nl2br(e($banner->title)) !!}
                            </h1>
                            
                            @if($banner->description)
                            <p class="sub-title color-white mb-15 mb-sm-15 mb-xs-10">
                                {{ $banner->description }}
                            </p>
                            @endif

                            <div class="theme-btn__wrapper mt-30">
                                <a href="{{ $banner->button_link }}" class="theme-btn btn-sm btn__2" data-animation="fadeInUp" data-delay="1.3s">
                                    {{ $banner->button_text }} <i class="fas fa-long-arrow-alt-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Trois Cards -->
<section class="competitive-edge competitive-edge_2 overflow-hidden">
    <div class="container">
        <div class="fauture__element bg-center bg-cover ">
            <div class="row">
                <div class="col-lg-4 col-md-12 mt-30">
                    <div class="fauture__widget wow fadeInUp" data-wow-delay=".3s">
                        <div class="fauture__icons">
                            <div class="icon"><i class="fas fa-chart-line"></i></div>
                        </div>
                        <div class="fauture__content">
                            <h4>Professionnalisme</h4>
                            <p>Un travail de qualité basé sur la rigueur et l’expertise.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 mt-30">
                    <div class="fauture__widget wow fadeInUp" data-wow-delay=".5s">
                        <div class="fauture__icons">
                            <div class="icon">
                                <i class="fas fa-comments"></i>
                            </div>
                        </div>
                        <div class="fauture__content">
                            <h4>Proximité & Engagement</h4>
                            <p>À l’écoute, disponibles et engagés auprès de nos clients.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 mt-30">
                    <div class="fauture__widget wow fadeInUp" data-wow-delay=".7s">
                        <div class="fauture__icons">
                            <div class="icon">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                        </div>
                        <div class="fauture__content">
                            <h4>Innovation</h4>
                            <p>Des solutions modernes adaptées aux besoins d’aujourd’hui.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- A Propos -->
<section class="about__wrapper section-padding overflow-hidden">
    <div class="container" id="about">
        <div class="row">
            <div class="col-lg-4 col-md-7 col-sm-6">
                <div class="about_img wow fadeInUp" style="height: 100%;" data-wow-delay=".3s">
                    <img src="{{ asset('assets/img/services/img1.jpg') }}" class="img-fluid" style="height: 100% !important" alt>
                </div>
            </div>
            <div class="col-lg-3 col-md-5 col-sm-6">
                <div class="about_widget wow fadeInUp" style="" data-wow-delay=".5s">
                    <img src="{{ asset('assets/img/services/img2.jpg') }}" class="img-fluid" style="height: 444px" alt>
                    <div class="d-flex align-items-center years-experience years-experience_tow overflow-hidden mt-20 mt-sm-10 mt-xs-10">
                        <div class="icons color-secondary">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="number">
                            <span class="counter mb-3">10</span><sup>+</sup>
                            <h5 class="title">Années d'expérience</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-12">
                <div class="section-title section-title_2 wow fadeInUp" data-wow-delay=".7s">
                    <h5> <img src="{{ asset('assets/img/home/line.svg') }}" class="img-fluid mr-10" alt=""> À Propos</h5>

                    <h2 class="mb-20" style="line-height: 55px">Une <span>expertise</span> alliant stratégie, innovation et maîtrise technique</h2>
                    <p>GEL TECHNOLOGY développe dans ses milieux une expertise pointue alliant stratégie, connaissance du métier et maîtrise technique.</p>
                </div>
                <div class="about_content wow fadeInUp" data-wow-delay=".9s">
                    <div class="row mb-20">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="icons">
                                    <i class="fas fa-network-wired"></i>
                                </div>
                                <h5>Réseaux & Télécommunications</h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="icons">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <h5>Sécurité électronique</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-30">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="icons">
                                    <i class="fas fa-bolt"></i>
                                </div>
                                <h5>Électricité générale</h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="icons">
                                    <i class="fas fa-microchip"></i>
                                </div>
                                <h5>Domotique & Automatisation</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <p>Nous accompagnons nos partenaires avec des solutions fiables et adaptées aux défis technologiques et énergétiques actuels.</p>
                <a href="/services" class="theme-btn btn__2 wow fadeInUp" data-wow-delay=".3s">Nos Services <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<!--  -->
<section class="planning-success pb-xs-80 pt-xs-80 pt-sm-100 pb-sm-100 pt-md-100 pb-md-100 pt-120 pb-130 overflow-hidden" style="background-image: url({{ asset('assets/img/home/planning-success-bg.png') }});">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm-9">
                <div class="planning-success__content mb-xs-35 wow fadeInUp" data-wow-delay=".3s">
                    <h2 class="title mb-20 mb-sm-15 mb-xs-10 color-white">Des solutions bien pensées pour des résultats efficaces</h2>

                    <div class="description font-la color-white mb-40 mb-sm-30 mb-xs-20">
                        <p>Nous concevons et réalisons des projets en alliant stratégie, innovation et expertise pour assurer performance et fiabilité.</p>
                    </div>

                    <a href="/services" class="theme-btn btn-sm btn-red">Découvrir nos services <i class="fas fa-chevron-double-right"></i></a>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="planning-success__video wow fadeInUp" data-wow-delay=".5s">
                    <a href="https://www.youtube.com/watch?v=9xwazD5SyVg" class="popup-video mx-auto" data-effect="mfp-move-from-top">
                        <i class="fas fa-play"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Nos Services -->
<section class="our-portfolio-home pb-xs-80 pt-xs-80 pt-sm-100 pb-sm-100 pt-md-100 pb-md-100 pt-60 pb-60 overflow-hidden">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="our-portfolio-home__content text-center mb-60 mb-sm-50 mb-xs-40 wow fadeInUp" data-wow-delay=".3s">
                    <span class="sub-title fw-500 text-uppercase mb-sm-10 mb-xs-5 mb-15 d-block color-red">
                        <img src="{{ asset('assets/img/home/line.svg') }}" class="img-fluid mr-10" alt=""> Nos Solutions
                    </span>
                </div>
            </div>
        </div>

        <div class="row mb-minus-30">
            @foreach($solutions as $solution)
            <div class="col-lg-3 col-md-12">
                <div class="our-portfolio-home__item mb-30 wow fadeInUp" data-wow-delay=".3s">
                    <div class="featured-thumb">
                        <div class="media overflow-hidden">
                            <div style="position: relative; width: 100%; height: 220px; overflow: hidden;">
                                @if($solution->image_url)
                                    <img src="{{ $solution->image_url }}" class="img-fluid" alt="{{ $solution->title }}" 
                                        style="width: 100% !important; height: 220px; object-fit: cover;">
                                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.4);"></div>
                                @else
                                    <img src="{{ asset('assets/img/home/our-portfolio-home__item-1.png') }}" class="img-fluid" alt="">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="content d-flex flex-row">
                        <div class="left" style="width:60% !important">
                            <div class="post-author mb-5 mb-xs-5 text-uppercase">
                                <a href="#">{{ $solution->categorie->name ?? 'Solution' }}</a>
                            </div>

                            <h5 class="color-pd_black mb-15 mb-xs-10 text-uppercase" style="min-height: calc(1.4em * 2);">
                                <a href="/service/{{ $solution->slug }}">{{ $solution->title }}</a>
                            </h5>
                        </div>

                        <div class="btn-link-share" style="width:40% !important">
                            <a href="/service/{{ $solution->slug }}" class="theme-btn color-pd_black" style="background-image: url({{ asset('assets/img/home/theme-btn-overly.png') }})">
                                {{ $solution->button_text ?? 'View Details' }} <i class="fas fa-arrow-right"></i>
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
                    <a href="/services" class="theme-btn btn-border">Tous Nos Services <i class="fas fa-chevron-double-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Réalisations -->
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

<!-- Comment nous intervenons -->
<section class="work-process pb-xs-80 pt-xs-80 pt-sm-100 pb-sm-100 pt-md-100 pb-md-100 pt-60 pb-100 overflow-hidden">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="pricing__content mb-60 mb-sm-40 mb-xs-30 text-center wow fadeInUp" data-wow-delay=".3s">
                    <span class="sub-title fw-500 text-uppercase mb-sm-10 mb-xs-5 mb-15 d-block color-red">
                        <img src="{{ asset('assets/img/home/line.svg') }}" class="img-fluid mr-10" alt=""> Comment nous intervenons ?
                    </span>
                </div>
            </div>
        </div>

        <div class="row mb-minus-30">
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="work-process__item mb-70 text-center wow fadeInUp" data-wow-delay=".3s">
                    <div class="icon mx-auto">
                        <i class="fas fa-search"></i>
                    </div>

                    <div class="text">
                        <h6 class="title color-secondary mb-15 mb-sm-10 mb-xs-5">Analyse des besoins</h6>

                        <div class="description font-la">
                            <p>Nous étudions votre projet afin de comprendre vos attentes et contraintes.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="work-process__item mb-70 text-center wow fadeInUp" data-wow-delay=".5s">
                    <div class="icon mx-auto">
                        <i class="fas fa-drafting-compass"></i>
                    </div>

                    <div class="text">
                        <h6 class="title color-secondary mb-15 mb-sm-10 mb-xs-5">Étude & conception</h6>

                        <div class="description font-la">
                            <p>Nous définissons les solutions techniques adaptées à votre environnement.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="work-process__item mb-70 text-center wow fadeInUp" data-wow-delay=".7s">
                    <div class="icon mx-auto">
                        <i class="fas fa-tools"></i>
                    </div>

                    <div class="text">
                        <h6 class="title color-secondary mb-15 mb-sm-10 mb-xs-5">Mise en œuvre</h6>

                        <div class="description font-la">
                            <p>Nos équipes réalisent les installations avec rigueur et professionnalisme.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="work-process__item mb-70 text-center wow fadeInUp" data-wow-delay=".9s">
                    <div class="icon mx-auto">
                        <i class="fas fa-chart-line"></i>
                    </div>

                    <div class="text">
                        <h6 class="title color-secondary mb-15 mb-sm-10 mb-xs-5">Suivi & maintenance</h6>

                        <div class="description font-la">
                            <p>Nous assurons un accompagnement pour garantir la performance et la durabilité.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Témoignages -->
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
                        <div class="testimonial__item border--{{ $temoignage->border_color }}">
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
                                <p>{{ $temoignage->message }}</p>
                            </div>
                            <div class="testimonial__item-footer d-flex justify-content-between">
                                <div class="socail-link">
                                    <ul>
                                        @if($temoignage->social_links)
                                            @foreach($temoignage->social_links as $social)
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

<!-- Partenaires -->
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


@endsection