@extends('mahasiswa.layouts.base')

@section('title', 'Gallery')

@section('content')

    <style>
        .portfolio-item {
            /*width:100%;*/
        }

        .portfolio-item .item {
            /*width:303px;*/
            float: left;
            margin-bottom: 10px;
        }
    </style>

    <div class="">

        <div id="carouselExampleIndicators" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('assets/images/bg1.jpeg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block" style="top: 50%;
                    transform: translateY(-50%);
                    bottom: initial;">
                        <h1 style="opacity: 0.7">Galeri Ruang Baca Teknik Komputer</h1>
                        <h3 style="opacity: 0.7">Universitas Diponegoro</h3>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/images/bg2.jpeg') }}" class="d-block w-100" alt="...">
                    
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/images/bg1.jpeg') }}" class="d-block w-100" alt="...">
                    
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="portfolio-item row mt-5 p-4 ">
            @foreach ($photos1 as $p)
                <div class="item selfie col-lg-3 col-md-4 col-6 col-sm">
                    <a href="{{ asset('store/facility/' . $p->image) }}" class="fancylight popup-btn"
                        data-fancybox-group="light">
                        <img class="img-fluid" src="{{ asset('store/facility/' . $p->image) }}" alt="">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('js')

    <script>
        $('.portfolio-menu ul li').click(function() {
            $('.portfolio-menu ul li').removeClass('active');
            $(this).addClass('active');

            var selector = $(this).attr('data-filter');
            $('.portfolio-item').isotope({
                filter: selector
            });
            return false;
        });
        $(document).ready(function() {
            var popup_btn = $('.popup-btn');
            popup_btn.magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
        });
    </script>
@endsection
