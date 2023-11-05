@extends('mahasiswa.layouts.base')

@section('title', 'Dasbor')

@section('content')

    <div class="content poppins-text">
        {{-- <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="input-group position-absolute z-1" style="width: 30%; top: 55%; left: 35%;">
                <input type="search" class="rounded form-control" style="height: 50px;" placeholder="Search"
                    aria-label="Search" aria-describedby="search-addon" />
                <button type="button" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>

            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&q=80&w=1770&h=600&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="d-block w-100 object-fit-contain" alt="Slide 1">
                </div>
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1532274402911-5a369e4c4bb5?auto=format&fit=crop&q=80&w=1770&h=600&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="d-block w-100 object-fit-contain" alt="Slide 2">
                </div>
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1434725039720-aaad6dd32dfe?auto=format&fit=crop&q=80&w=1942&h=600&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="d-block w-100 object-fit-contain" alt="Slide 3">
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div> --}}

        <div class="hero" style="background-image: linear-gradient(45deg, #F9FACB, #63A4E0); height: 800px">
            <img src="{{ asset('assets/images/hero.png') }}" class="position-absolute" style="top: 15%; right: 0"
                alt="hero">
            <img src="{{ asset('assets/images/hero2.png') }}" class="position-absolute" style="top: 17%; left: 0"
                alt="hero2">
            <div class="input-group position-absolute z-1 search-div" style="width: 35%; top: 67%; left: 7%;">
                <input type="search" class="rounded form-control"
                    placeholder="Enter book title, ISBN, author or publishers" aria-label="Search"
                    aria-describedby="search-addon" style="height: 60px;" />
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <div class="bg-image" style="height: 400px; position: relative;">
            <style>
                .bg-image::before {
                    content: "";
                    background-image: url('{{ asset('assets/images/BGlibrary.jpg') }}');
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    opacity: 0.3;
                    /* Adjust the opacity as needed (0.3 = 30% opacity) */
                    background-size: cover;
                }
            </style>
            <div class="p-4 row" style="height: 400px; width: 100%;">
                <div class="text-center col-sm-4 d-flex align-items-center justify-content-center">
                    <p class="text-black fs-1 fw-bold">
                        Browse to Experience <br>
                        Find Your Book
                    </p>
                </div>
                <div class="col-sm-8 d-flex align-items-center">
                    <div class="card-container">
                        @foreach ($specializations as $specBook)
                            <a href="{{ route('user.specBook', ['id' => $specBook->id]) }}" class="mx-2 card"
                                style="width: 18rem;">
                                <img src="https://source.unsplash.com/1200x800?computer" class="card-img-top"
                                    alt="...">
                                <div class="card-body">
                                    <p class="text-center card-text">{{ $specBook->desc }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="reccomended" style="height: 580px">
            <div class="p-4">
                <h2 class="mx-1 my-3 text-black m fw-semibold">Reccomended By Our Staff</h2>
                <div class="mx-2 my-5 card-container">
                    @foreach ($books as $book)
                    <div class="mx-3 text-black card bg-light" style="height: 400px; width:300px">
                        <img src="{{ asset('storage/images/' . $book->image) }}" class="card-img" style="height: 250px" alt="bookImage">
                        <div class="bg-transparent card-footer">
                            <p class="fw-semibold fs-5">
                                {{ $book->book_name }}
                            </p>
                            <p class="fs-6">
                                {{ $book->author }}
                            </p>
                        </div>
                      </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

@endsection


@section('js')
    {{-- <script>
        // JavaScript to control the visibility of the search-div based on screen width
        function toggleSearchVisibility() {
            var searchDiv = document.querySelector('.search-div');
            var inputGroup = document.querySelector('.input-group');
            if (window.innerWidth > 1500) {
                searchDiv.style.display = 'block';
                inputGroup.classList.remove('flex-column');
            } else {
                searchDiv.style.display = 'none';
                inputGroup.classList.add('flex-column');
            }
        }

        // Initial check on page load
        toggleSearchVisibility();

        // Listen for the window's resize event
        window.addEventListener('resize', toggleSearchVisibility);
    </script> --}}

@endsection
