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

    <div class="container p-4">
        <div class="my-4 title fs-2 ">
            Galeri Ruang Baca
        </div>
        <div class="portfolio-item row">
            @foreach ($photos1 as $p)
            <div class="item selfie col-lg-3 col-md-4 col-6 col-sm">
                <a href="{{ asset('storage/facility/' . $p->image) }}"
                    class="fancylight popup-btn" data-fancybox-group="light">
                    <img class="img-fluid"
                        src="{{ asset('storage/facility/' . $p->image) }}"
                        alt="">
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
