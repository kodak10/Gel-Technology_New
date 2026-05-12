@extends('layouts.master')
@section('content')
<!-- page-banner start -->
<section class="page-banner pt-xs-60 pt-sm-80 overflow-hidden">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-banner__content mb-xs-10 mb-sm-15 mb-md-15 mb-20">
                    <div class="transparent-text">Contact</div>
                    <div class="page-title">
                        <h1>Contactez-<span>Nous</span></h1>
                    </div>
                </div>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('accueil') }}">Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact</li>
                    </ol>
                </nav>
            </div>

            <div class="col-md-6">
                <div class="page-banner__media mt-xs-30 mt-sm-40">
                    <img src="{{ asset('assets/img/page-banner/page-banner-start.svg') }}" class="img-fluid start" alt="">
                    <img src="{{ asset('assets/img/page-banner/page-banner-1.jpg') }}" class="img-fluid" alt="Contact">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- page-banner end -->

<!-- contact-us start -->
<section class="contact-us pb-xs-80 pt-xs-80 pt-sm-100 pb-sm-100 pt-md-100 pb-md-100 pt-120 pb-120 overflow-hidden">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="contact-us__content wow fadeInUp" data-wow-delay=".3s">
                    <h6 class="sub-title fw-500 color-primary text-uppercase mb-sm-15 mb-xs-10 mb-20">
                        <img src="{{ asset('assets/img/team-details/badge-line.svg') }}" class="img-fluid mr-10" alt=""> Contactez-nous facilement
                    </h6>
                    <h2 class="title color-d_black mb-sm-15 mb-xs-10 mb-20">Restons en contact</h2>

                    <div class="description font-la">
                        <p>Vous avez un projet ? Une question ? N'hésitez pas à nous contacter. Notre équipe est à votre disposition pour vous accompagner dans vos besoins technologiques.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="row contact-us__item-wrapper mt-xs-35 mt-sm-40 mt-md-45">
                    <div class="col-sm-6">
                        <div class="contact-us__item mb-40 wow fadeInUp" data-wow-delay=".3s">
                            <div class="contact-us__item-header mb-25 mb-md-20 mb-sm-15 mb-xs-10 d-flex align-items-center">
                                <div class="icon mr-10 color-primary">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <h5 class="title color-d_black">Notre Adresse</h5>
                            </div>
                            <div class="contact-us__item-body font-la">
                                <a href="https://www.google.com/maps?q=Abidjan-Adjam%C3%A9,+C%C3%B4te+d%27Ivoire" target="_blank">
                                    Côte d'Ivoire, Abidjan-Adjamé
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="contact-us__item mb-40 wow fadeInUp" data-wow-delay=".5s">
                            <div class="contact-us__item-header mb-25 mb-md-20 mb-sm-15 mb-xs-10 d-flex align-items-center">
                                <div class="icon mr-10 color-primary">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <h5 class="title color-d_black">Téléphone</h5>
                            </div>
                            <div class="contact-us__item-body font-la">
                                <ul>
                                    <li><a href="tel:+2252720270752">(+225) 27 20 27 07 52</a></li>
                                    <li><a href="tel:+2250707016362">(+225) 07 07 01 63 62</a></li>
                                    <li><a href="tel:+2250707016153">(+225) 07 07 01 61 53</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="contact-us__item mb-40 wow fadeInUp" data-wow-delay=".7s">
                            <div class="contact-us__item-header mb-25 mb-md-20 mb-sm-15 mb-xs-10 d-flex align-items-center">
                                <div class="icon mr-10 color-primary">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <h5 class="title color-d_black">Email</h5>
                            </div>
                            <div class="contact-us__item-body font-la">
                                <ul>
                                    <li><a href="mailto:contacts@geltechnology-ci.com">contacts@geltechnology-ci.com</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="contact-us__item mb-40 wow fadeInUp" data-wow-delay=".9s">
                            <div class="contact-us__item-header mb-25 mb-md-20 mb-sm-15 mb-xs-10 d-flex align-items-center">
                                <div class="icon mr-10 color-primary">
                                    <i class="fab fa-facebook-f"></i>
                                </div>
                                <h5 class="title color-d_black">Réseaux sociaux</h5>
                            </div>
                            <div class="contact-us__item-body font-la">
                                <ul>
                                    <li>
                                        <a href="https://www.facebook.com/people/GEL-Technology-Energy-Ci/61587648462749/" target="_blank">
                                            Facebook
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <hr class="mt-md-45 mt-sm-30 mt-xs-30 mt-60">
            </div>
        </div>
    </div>
</section>
<!-- contact-us end -->

<!-- contact-us form start -->
<section class="contact-form mb-xs-80 mb-sm-100 mb-md-100 mb-120 overflow-hidden">
    <div id="contact-map" class="mb-sm-30 mb-xs-25">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.761586235674!2d-4.028730985243563!3d5.322769136354266!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfc1f7f2a5b7b8b7f%3A0x7b7b7b7b7b7b7b7b!2sAbidjan%2C%20C%C3%B4te%20d%27Ivoire!5e0!3m2!1sfr!2sci!4v1707636832892!5m2!1sfr!2sci" 
            style="width: 100%; height: 400px; border: 0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="contact-form pt-md-30 pt-sm-25 pt-xs-20 pb-md-40 pb-sm-35 pb-xs-30 pt-xl-30 pb-xl-50 pt-45 pr-xl-50 pl-md-40 pl-sm-30 pl-xs-25 pr-md-40 pr-sm-30 pr-xs-25 pl-xl-50 pr-85 pb-60 pl-85 wow fadeInUp" data-wow-delay=".3s">
                    <div class="contact-form__header mb-sm-35 mb-xs-30 mb-40">
                        <h6 class="sub-title fw-500 color-primary text-uppercase mb-15">
                            <img src="{{ asset('assets/img/team-details/badge-line.svg') }}" class="img-fluid mr-10" alt=""> Besoin d'aide ?
                        </h6>
                        <h3 class="title color-d_black">Envoyez-nous un message</h3>
                    </div>

                    <form action="{{ route('contact.send') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="single-personal-info mb-20">
                                    <input type="text" name="name" id="name" placeholder="Votre nom" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="single-personal-info mb-20">
                                    <input type="email" name="email" id="email" placeholder="Votre e-mail" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="single-personal-info mb-20">
                                    <input type="text" name="subject" id="subject" placeholder="Sujet" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="single-personal-info mb-30">
                                    <textarea name="message" id="message" placeholder="Votre message" rows="6" required class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="theme-btn btn-sm">Envoyer le message <i class="fas fa-chevron-double-right"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- contact-us form end -->

<!-- Témoignages -->
@if(isset($temoignages) && $temoignages->count() > 0)
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
@if(isset($partenaires) && $partenaires->count() > 0)
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