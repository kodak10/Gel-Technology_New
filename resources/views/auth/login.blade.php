@extends('layouts.master')

@section('content')
<section class="about__wrapper section-padding overflow-hidden bg-dark_white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">
                <div class="testimonial__item border--secondary wow fadeInUp" data-wow-delay=".3s">
                    <div class="testimonial__item-header text-center mb-35">
                        <div class="left d-block">
                            <div class="meta">
                                <h3 class="name fw-500 text-uppercase color-d_black mb-10">Connexion</h3>
                                <span class="position font-la fw-500 color-d_black">Accédez à votre espace personnel</span>
                            </div>
                        </div>
                    </div>

                    <div class="description font-la">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-20">
                                <div class="col-12">
                                    <label for="email" class="form-label color-d_black mb-10">Adresse email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                           placeholder="exemple@email.com">
                                    @error('email')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-20">
                                <div class="col-12">
                                    <label for="password" class="form-label color-d_black mb-10">Mot de passe</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                           name="password" required autocomplete="current-password"
                                           placeholder="Votre mot de passe">
                                    @error('password')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-30">
                                <div class="col-12 text-center">
                                    <button type="submit" class="theme-btn btn-sm btn__2 w-100">
                                        Se connecter <i class="fas fa-long-arrow-alt-right"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 text-center">
                                    @if (Route::has('password.request'))
                                        <a class="forgot-password color-primary" href="{{ route('password.request') }}">
                                            <i class="fas fa-key me-1"></i> Mot de passe oublié ?
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection