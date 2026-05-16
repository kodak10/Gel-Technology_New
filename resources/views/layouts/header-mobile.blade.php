<div class="mobile-nav mobile-nav-red">
    <button type="button" class="close-nav">
        <i class="fas fa-times-circle"></i>
    </button>

    <nav class="sidebar-nav">
        <div class="navigation">
            <div class="consulter-mobile-nav">
                <ul>
                    <li class="{{ request()->routeIs('accueil') ? 'active' : '' }}">
                        <a href="{{ route('accueil') }}">Accueil</a>
                    </li>
                    <li class="{{ request()->routeIs('about') ? 'active' : '' }}">
                        <a href="#about">A Propos</a>
                    </li>
                    <li class="{{ request()->routeIs('services') || request()->routeIs('service.details') || request()->routeIs('services.by.category') ? 'active' : '' }}">
                        <a href="{{ route('services') }}">Nos Services</a>
                    </li>
                    <li class="{{ request()->routeIs('realisations') || request()->routeIs('realisation.details') ? 'active' : '' }}">
                        <a href="{{ route('realisations') }}">Réalisations</a>
                    </li>
                </ul>
            </div>

            <div class="sidebar-nav__bottom mt-20">
                <div class="sidebar-nav__bottom-contact-infos mb-20">
                    <h6 class="color-black mb-5">Contact Info</h6>
                    <ul>
                        <li><a href="mailto:consulter@example.com"><i class="fas fa-envelope"></i> Contacts@geltechnology-ci.com</a></li>
                        <li>
                            <div class="header-contact d-flex align-items-center">
                                <div class="icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="text">
                                    <span class="font-la mb-5 d-block fw-500">Contact</span>
                                    <h5 class="fw-500">(+225) 27 20 27 07 52</h5>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="header-contact d-flex align-items-center">
                                <div class="icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="text">
                                    <span class="font-la mb-5 d-block fw-500">Adresse</span>
                                    <h5 class="fw-500">Abidjan-Adjamé, Côte d’Ivoire</h5>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="sidebar-nav__bottom-social">
                    <h6 class="color-black mb-5">Suivez-nous sur:</h6>
                    <ul>
                        <li><a href="https://www.facebook.com/people/GEL-Technology-Energy-Ci/61587648462749/#"><i class="fab fa-facebook-f"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>