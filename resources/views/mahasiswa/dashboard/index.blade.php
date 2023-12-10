@extends('mahasiswa.layouts.base')

@section('title', 'Dasbor')

@section('content')

    <div class="content poppins-text">

        <div id="carouselVideoExample" class="carousel carousel-fade" data-mdb-ride="carousel" >
            <!-- Inner -->
            <div class="carousel-inner">

                <!-- Single item -->
                <div class="carousel-item active">
                    <div style="position: relative; overflow: hidden;">
                        <video class="img-fluid" autoplay loop muted style="width:100%; object-fit: contain;">
                            <source src="{{ asset('video/video.mp4') }}" type="video/mp4" />
                        </video>
                    </div>
                    <div class="carousel-caption d-none d-md-block"
                        style="top: 50%;
                    transform: translateY(-50%);
                    bottom: initial;">
                        <h3>Ruang Baca</h3>
                        <h5>
                            Departemen Teknik Komputer
                        </h5>
                    </div>
                </div>
            </div>
            <!-- Inner -->
        </div>
    </div>

@endsection


