<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="GEL Technology est spécialisée en réseaux informatiques, télécommunications, sécurité électronique, domotique, électricité générale et fibre optique. Des solutions fiables et innovantes pour les entreprises et particuliers.">
    <meta name="keywords" content="réseaux informatiques, télécommunications, sécurité électronique, vidéosurveillance, domotique, électricité générale, fibre optique, installation réseau, GEL Technology">
    <meta name="author" content="GEL Technology">

    <title>GEL Technology | Réseaux, Sécurité Électronique, Domotique & Fibre Optique</title>

    <link rel="shortcut icon" href="{{ asset('assets/img/logo/favicon.png') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/slick.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/animate.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    <style>
        /* Augmenter la largeur de l'image dans la lightbox */
.lightbox .lb-image {
    max-width: 90vw !important;
    max-height: 90vh !important;
    width: auto !important;
    height: auto !important;
}

/* Optionnel : Agrandir le conteneur */
.lb-outerContainer {
    max-width: 90vw !important;
    background-color: transparent !important;
}

/* Optionnel : Centrer parfaitement */
.lb-dataContainer {
    max-width: 90vw !important;
}
    </style>

</head>

<body class="body-wrapper">

    <!-- preloader -->
    <div id="preloader">
        <div class="preloader-close">x</div>
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

    @include('layouts.header')

    @include('layouts.header-mobile')

    <div class="offcanvas-overlay"></div>

    <div class="header-gutter home"></div>

    @yield('content')

    @include('layouts.footer')


    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.easing.js')}}"></script>
    <script src="{{asset('assets/js/slick.min.js')}}"></script>
    <script src="{{asset('assets/js/scrollUp.min.js')}}"></script>
    <script src="{{asset('assets/js/counterup.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.sticky-kit.js')}}"></script>
    <script src="{{asset('assets/js/magnific-popup.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.easypiechart.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('assets/js/wow.min.js')}}"></script>
    <script src="{{asset('assets/js/active.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

    <script>
        // Garder la flèche mais ouvrir la galerie quand même
        $(document).ready(function() {
            $('.our-project__item').each(function() {
                var imgSrc = $(this).find('img').attr('src');
                var imgTitle = $(this).find('.title').text();
                
                // Image cliquable
                $(this).find('img').wrap('<a href="' + imgSrc + '" data-lightbox="realisations" data-title="' + imgTitle + '"></a>');
                
                // Bouton flèche aussi cliquable
                $(this).find('.theme-btn').attr('href', imgSrc);
                $(this).find('.theme-btn').attr('data-lightbox', 'realisations');
                $(this).find('.theme-btn').attr('data-title', imgTitle);
            });
        });
    </script>
</body>

</html>