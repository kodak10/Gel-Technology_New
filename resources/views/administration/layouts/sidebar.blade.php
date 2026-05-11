<div class="main-nav">
    <!-- Sidebar Logo -->
    <div class="logo-box">
         <a href="/" class="logo-dark">
              <img src="{{ asset('assets/img/logo/01.svg')}}" class="logo-sm" alt="logo sm" style="height: 80px">
              <img src="{{ asset('assets/img/logo/01.svg') }}" class="logo-lg" alt="logo dark" style="height: 80px">
         </a>

         <a href="/" class="logo-light">
              <img src="{{ asset('assets/img/logo/01.svg') }}" class="logo-sm" alt="logo sm" style="height: 80px">
              <img src="{{ asset('assets/img/logo/01.svg') }}" class="logo-lg" alt="logo light" style="height: 80px">
         </a>
    </div>

    <!-- Menu Toggle Button (sm-hover) -->
    <button type="button" class="button-sm-hover" aria-label="Show Full Sidebar">
         <iconify-icon icon="solar:double-alt-arrow-right-bold-duotone" class="button-sm-hover-icon"></iconify-icon>
    </button>

    <div class="scrollbar" data-simplebar>
         <ul class="navbar-nav" id="navbar-nav">

            <li class="menu-title">Général</li>

            <!-- Tableau de bord -->
            <li class="nav-item {{ request()->is('administration') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/administration') }}">
                    <span class="nav-icon">
                        <i class="fas fa-tachometer-alt"></i>
                    </span>
                    <span class="nav-text">Tableau de bord</span>
                </a>
            </li>

            <!-- Bannières -->
            <li class="nav-item {{ request()->is('administration/banners*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/administration/banners') }}">
                    <span class="nav-icon">
                        <i class="fas fa-images"></i>
                    </span>
                    <span class="nav-text">Bannières</span>
                </a>
            </li>

            <!-- Catégories de Solutions -->
            <li class="nav-item {{ request()->is('administration/categories*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/administration/categories') }}">
                    <span class="nav-icon">
                        <i class="fas fa-folder-tree"></i>
                    </span>
                    <span class="nav-text">Catégories de Solutions</span>
                </a>
            </li>

            <!-- Solutions -->
            <li class="nav-item {{ request()->is('administration/solutions*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/administration/solutions') }}">
                    <span class="nav-icon">
                        <i class="fas fa-lightbulb"></i>
                    </span>
                    <span class="nav-text">Solutions</span>
                </a>
            </li>

            <!-- Réalisations -->
            <li class="nav-item {{ request()->is('administration/projects*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/administration/projects') }}">
                    <span class="nav-icon">
                        <i class="fas fa-briefcase"></i>
                    </span>
                    <span class="nav-text">Réalisations</span>
                </a>
            </li>

            <!-- Partenaires -->
            <li class="nav-item {{ request()->is('administration/partenaires*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/administration/partenaires') }}">
                    <span class="nav-icon">
                        <i class="fas fa-handshake"></i>
                    </span>
                    <span class="nav-text">Partenaires</span>
                </a>
            </li>

            <!-- Témoignages -->
            <li class="nav-item {{ request()->is('administration/temoignages*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/administration/temoignages') }}">
                    <span class="nav-icon">
                        <i class="fas fa-star"></i>
                    </span>
                    <span class="nav-text">Témoignages</span>
                </a>
            </li>
            <!-- Déconnexion -->
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span class="nav-icon">
                        <i class="fas fa-sign-out-alt"></i>
                    </span>
                    <span class="nav-text">Déconnexion</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>