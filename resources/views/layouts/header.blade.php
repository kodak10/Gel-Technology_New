<header class="header header-1 header-3">
    <div class="top-header d-none d-xl-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-4">
                    <div class="header-right-socail d-flex align-items-center">
                        <h6 class="font-la color-white fw-normal">Suivez-nous sur:</h6>
                        <div class="social-profile">
                            <ul>
                                <li><a href="https://www.facebook.com/people/GEL-Technology-Energy-Ci/61587648462749/#"><i class="fab fa-facebook-f"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-8">
                    <div class="header-cta d-flex justify-content-end">
                        <ul>
                            <li><a href="tel:+2252720270752"><i class="fas fa-phone-alt"></i> (+225) 27 20 27 07 52</a></li>
                            <li><a href="mailto:contacts@geltechnology-ci.com"><i class="fas fa-envelope"></i> Contacts@geltechnology-ci.com</a></li>
                            <li> <a href="https://www.google.com/maps?q=%2B225+Plateau,+Abidjan,+C%C3%B4te+d%27Ivoire&hl=fr"><i class="fas fa-map-marker-alt"></i> Côte d’Ivoire, Abidjan-Adjamé</a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-header-wraper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="header-logo">
                            <div class="logo">
                                <a href="/">
                                    <img src="{{ asset('assets/img/logo/01.svg') }}" style="height: 100px !important;" alt="logo">
                                </a>
                            </div>
                        </div>

                        <div class="header-menu d-none d-xl-block">
                            <div class="main-menu">
                                <ul>
                                    <li class="active">
                                        <a href="{{ route('accueil') }}">Accueil</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('about') }}">A Propos</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('services') }}">Nos Services</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('realisations') }}">Réalisations</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('administration.dashboard') }}">Administration</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="header-right d-flex align-items-center">
                            <a href="{{ route('contact') }}" class="header-btn">Contactez-Nous <i class="fas fa-chevron-double-right"></i></a>
                            <div class="mobile-nav-bar d-block ml-3 ml-sm-5 d-xl-none">
                                <div class="mobile-nav-wrap">
                                    <div id="hamburger">
                                        <i class="fas fa-bars"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>