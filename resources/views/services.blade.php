<div class="row mb-minus-30">
    @forelse($solutions as $solution)
    <div class="col-xl-3 col-md-4 col-12">
        <div class="our-portfolio-home__item mb-30 wow fadeInUp" data-wow-delay=".3s">
            <div class="featured-thumb">
                <div class="media overflow-hidden">
                    <div style="position: relative; width: 100%; height: 220px; overflow: hidden;">
                        @if($solution->image_url)
                            <img src="{{ $solution->image_url }}" 
                                 class="img-fluid" 
                                 alt="{{ $solution->title }}"
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

                    <h5 class="color-pd_black mb-15 mb-xs-10" style="min-height: calc(1.4em * 2);">
                        <a href="/service/{{ $solution->slug }}">{{ $solution->title }}</a>
                    </h5>
                </div>

                <div class="btn-link-share" style="width:40% !important">
                    <a href="/service/{{ $solution->slug }}" class="theme-btn color-pd_black" style="background-image: url({{ asset('assets/img/home/theme-btn-overly.png') }})">
                        Détails <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="text-center">
            <p>Aucune solution disponible pour le moment.</p>
        </div>
    </div>
    @endforelse
</div>