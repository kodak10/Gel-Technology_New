<footer class="footer-1 footer-3 overflow-hidden">
    <div class="overly">
        <div class="container"></div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-4 col-xl-4">
                <div class="single-footer-wid widget-description">
                    <a href="{{ route('accueil') }}" class="d-block mb-30 mb-xs-20">
                        <img src="{{ asset('assets/img/logo/01.svg') }}" style="height:150px" alt="Logo GEL TECHNOLOGY">
                    </a>

                    <div class="description font-la color-white mb-40 mb-sm-30 mb-xs-25">
                        <p>
                            Nous proposons des services de qualité, alliant professionnalisme, proximité et innovation, afin de répondre efficacement à vos besoins au quotidien.
                        </p>
                    </div>

                    <a href="#" class="theme-btn btn-red btn-md fw-600">Contactez-Nous <i class="fas fa-chevron-double-right"></i></a>
                </div>
            </div>

            <div class="col-md-12 col-lg-3 col-xl-2">
                <div class="single-footer-wid">
                    <h4 class="wid-title mb-30 color-white">Navigation</h4>

                    <ul>
                        <li><a href="{{ route('accueil') }}">Accueil</a></li>
                        <li><a href="{{ route('about') }}">À Propos</a></li>
                        <li><a href="{{ route('services') }}">Nos Services</a></li>
                        <li><a href="{{ route('realisations') }}">Réalisations</a></li>
                        <li><a href="{{ route('contact') }}">Contacts</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-12 col-lg-5 col-xl-6">
                <div class="single-footer-wid">
                    <h4 class="wid-title mb-30 color-white">Localisation</h4>
                    <div class="footer-map">
                        <div class="container mb-3">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <ul>
                                        <li><a href="tel:+2252720270752"><i class="fas fa-phone-alt"></i> (+225) 27 20 27 07 52</a></li>
                                        <li><a href="tel:+2250707016362"><i class="fas fa-phone-alt"></i> (+225) 07 07 01 63 62</a></li>
                                        <li><a href="tel:+2250707016153"><i class="fas fa-phone-alt"></i> (+225) 07 07 01 61 53</a></li>
                                    </ul>
                                </div>
                                <div class="col-4">
                                    <ul>
                                        <li><a href="mailto:contacts@geltechnology-ci.com"><i class="fas fa-envelope"></i> Contacts@geltechnology-ci.com</a></li>
                                    </ul>
                                </div>
                                <div class="col-4">
                                    <ul>
                                        <li> <a href="https://www.google.com/maps?q=%2B225+Plateau,+Abidjan,+C%C3%B4te+d%27Ivoire&hl=fr"><i class="fas fa-map-marker-alt"></i> Côte d’Ivoire, Abidjan-Adjamé</a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <iframe 
                            src="https://www.google.com/maps?q=Plateau,Abidjan,Cote d'Ivoire&output=embed" 
                            style="width: 100%; height: 250px; border: 0; border-radius: 10px;" 
                            allowfullscreen 
                            loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom overflow-hidden">
            <div class="container">
                <div class="footer-bottom-content d-flex flex-column flex-md-row justify-content-between align-items-center">
                    <div class="coppyright text-center text-md-start">
                        © 2026 <a href="{{ route('accueil') }}">GEL TECHNOLOGY</a>
                    </div>
                </div>
            </div>
        </div>
</footer>