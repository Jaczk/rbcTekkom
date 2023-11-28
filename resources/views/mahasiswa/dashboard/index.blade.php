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
                            <source src="{{ asset('video/jalan.mp4') }}" type="video/mp4" />
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


        <!-- Carousel wrapper -->
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
                            <a href="{{ route('user.book.spec', $specBook->id) }}" class="mx-2 card" style="width: 18rem;">
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
                <a href="{{ route('user.donate') }}" style="color: inherit;">
                    <h2 class="my-3 text-black m fw-semibold">Coming Soon...</h2>
                </a>
                <div class="mx-2 mt-4 container-fluid row d-flex flex-nowrap" style="overflow-x: auto;">
                    @foreach ($books as $book)
                        <a href="javascript:void(0)" class="" id="show-detail"
                            data-url="{{ route('user.donate.show', $book->id) }}" style="width: 18rem; color: inherit;">
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
                            <img alt="book" class="mb-3 card-img rounded-4" style="width: 250px; height: 300px;"
                                id="book-image">
                        </div>
                        <div class="">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Buku</th>
                                        <td><span id="book-name"></span></td>
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
                $('#book-desc').text(data.desc);
                // Set the image source
                var imagePath = "{{ asset('storage/images/') }}/" + data.image;
                $('#book-image').attr("src", imagePath);
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
