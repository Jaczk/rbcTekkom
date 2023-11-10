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
            <img src="{{ asset('assets/images/hero2.png') }}" style="top: 17%; left: 0" alt="hero2">
            <img src="{{ asset('assets/images/hero.png') }}" class="position-absolute" style="top: 15%; right: 0"
                alt="hero">
            <div class="input-group position-absolute z-1 search-div" style="width: 35%; top: 70%; left: 7%;">
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
                        Browse to <span style="color: #2A07FF">Experience</span> <br>
                        Find Your <span style="color:#FF0000">Best</span> Book
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
        <div class="reccomended" style="overflow: hidden;">
            <div class="p-4">
                <h2 class="my-3 text-black m fw-semibold">Recommended By Our Staff</h2>
                <div class="container-fluid mx-2 mt-4 row d-flex flex-nowrap" style="overflow-x: auto;">
                    @foreach ($books as $book)
                    <a href="javascript:void(0)" class="" id="show-detail"
                        data-url="{{ route('book.show', $book->id) }}" style="width: 18rem; color: inherit;">
                        <div class="mx-3" style="width: 250px; height: 420px;">
                            <img src="{{ asset('storage/images/' . $book->image) }}" class="card-img rounded-4"
                            style="height: 300px; width: 100%;" alt="bookImage">
                            <div class="bg-transparent">
                                <p class="fw-semibold">
                                    {{ $book->book_name }} <br>
                                    <span class="mt-1 fw-light">
                                        {{ $book->author }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="userShowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <img alt="book" class="card-img rounded-4 mb-3" 
                            style="width: 250px; height: 300px;" id="book-image">
                        </div>
                        <div class="">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>Buku</th>
                                            <td><span id="book-name"></span></td>
                                        </tr>
                                        <tr>
                                            <th>Peminatan</th>
                                            <td><span id="book-spec"></span></td>
                                        </tr>
                                        <tr>
                                            <th>Detail Minat</th>
                                            <td><span id="book-spec_detail"></span></td>
                                        </tr>
                                        <tr>
                                            <th>Kode Perpus</th>
                                            <td><span id="book-lib"></span></td>
                                        </tr>
                                        <tr>
                                            <th>Penerbit</th>
                                            <td><span id="book-publisher"></span></td>
                                        </tr>
                                        <tr>
                                            <th>Penulis</th>
                                            <td><span id="book-author"></span></td>
                                        </tr>
                                        <tr>
                                            <th>ISBN-ISSN</th>
                                            <td><span id="book-isbn_issn"></span></td>
                                        </tr>
                                        <tr>
                                            <th>Tahun Masuk</th>
                                            <td><span id="book-year"></span></td>
                                        </tr>
                                        <tr>
                                            <th>Kondisi</th>
                                            <td><span id="book-condition"></span></td>
                                        </tr>
                                        <tr>
                                            <th>Deskripsi</th>
                                            <td><span id="book-desc"></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection


@section('js')
    <script>
        //Modal dialog
        $('body').on('click', '#show-detail', function() {
            var userURL = $(this).data('url');
            $.get(userURL, function(data) {
                // var img = text("/storage/app/public/images/") + text(data.image);
                $('#userShowModal').modal('show');
                $('#book-name').text(data.book_name);
                $('#book-publisher').text(data.publisher);
                $('#book-author').text(data.author);
                $('#book-isbn_issn').text(data.isbn_issn);
                $('#book-condition').text(data.condition);
                $('#book-year').text(data.year_entry);
                $('#book-desc').text(data.desc);
                $('#book-spec').text(data.specialization.desc);
                $('#book-lib').text(data.lib_book_code);
                $('#book-spec_detail').text(data.spec_detail.desc);
                $('#book-image').attr("src", img);
            })
        });
    </script>
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
