<header class="topbar">
    <div class="container-fluid">
         <div class="navbar-header">
              <div class="d-flex align-items-center">
                   <!-- Menu Toggle Button -->
                   <div class="topbar-item">
                        <button type="button" class="button-toggle-menu me-2">
                             <iconify-icxon icon="solar:hamburger-menu-broken" class="fs-24 align-middle"></iconify-icon>
                        </button>
                   </div>

                   <!-- Menu Toggle Button -->
                   <div class="topbar-item">
                         <h4 class="fw-bold topbar-button pe-none text-uppercase mb-0">
                              {{-- Bienvenue {{ Auth::user()->name }} ! --}}
                         </h4>
                    </div>
              </div>

              <div class="d-flex align-items-center gap-1">

                   <!-- Theme Color (Light/Dark) -->
                   {{-- <div class="topbar-item">
                        <button type="button" class="topbar-button" id="light-dark-mode">
                             <iconify-icon icon="solar:moon-bold-duotone" class="fs-24 align-middle"></iconify-icon>
                        </button>
                   </div> --}}

          
                   <!-- User -->
                   <div class="dropdown topbar-item">
                        <a type="button" class="topbar-button" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <span class="d-flex align-items-center">
                                   {{-- {{ Auth::user()->name }} --}}
                             </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                             <!-- item-->
                             {{-- <a class="dropdown-item" href="{{ route('profil.index') }}">
                                  <i class="bx bx-user-circle text-muted fs-18 align-middle me-1"></i><span class="align-middle">Mon Profil</span>
                             </a> --}}
                            

                             <div class="dropdown-divider my-1"></div>

                             {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                   @csrf
                              </form>
                              
                              <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                   <i class="bx bx-log-out fs-18 align-middle me-1"></i>
                                   <span class="align-middle">Se Déconnecter</span>
                              </a> --}}
                          
                        </div>
                   </div>

                  
              </div>
         </div>
    </div>
</header>