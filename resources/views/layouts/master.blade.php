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

        .lb-outerContainer {
            max-width: 90vw !important;
            background-color: transparent !important;
        }

        .lb-dataContainer {
            max-width: 90vw !important;
        }

        /* ---- Bouton WhatsApp flottant (simple et fiable) ---- */
        .whatsapp-float {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background-color: #25d366;
            color: #fff;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
            z-index: 9999;
            text-decoration: none;
            transition: transform 0.2s ease, background-color 0.2s ease;
        }
        .whatsapp-float:hover {
            transform: scale(1.1);
            background-color: #128C7E;
            color: #fff;
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

    <!-- WhatsApp Floating Button (avec tooltip natif) -->
    <a href="https://wa.me/2250720687826" 
       class="whatsapp-float" 
       target="_blank" 
       rel="noopener noreferrer"
       title="Contactez-nous">
        <i class="fab fa-whatsapp"></i>
    </a>

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