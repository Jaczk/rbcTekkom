@extends('mahasiswa.layouts.base')

@section('title', 'Coming Soon')

@section('content')

    <div class="p-3 poppins-text container-fluid">
        <div class="d-flex justify-content-between">
            <div class="mt-4 title fs-2 ms-4">
                Katalog Buku Sumbangan
            </div>

            <form action="" class="w-25 me-4">
                <div class="p-1 my-4 border input-group rounded-2 w-100">
                    <input type="search" placeholder="Enter book title, author or publishers"
                        aria-describedby="button-addon3" class="border-0 form-control bg-none" id="search">
                    <div class="border-0 input-group-append">
                        <button id="searchbtn" type="button" class="btn btn-link text-success"><i
                                class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>

        <div class="catalog">
            <div class="mt-5 ms-3 container-fluid row d-flex">
                @forelse ($books as $book)
                    <a href="javascript:void(0)" class="" id="show-detail"
                        data-url="{{ route('user.donate.show', $book->id) }}" style="width: 18rem; color: inherit;">
                        <div class="mx-3" style="width: 250px; height: 420px;">
                            <img src="{{ asset('store/images/' . $book->image) }}"
                                class="card-img rounded-4 object-fit-cover" style="height: 300px; width: 100%;"
                                alt="bookImage">
                            <div class="bg-transparent">
                                <p class="mt-2 fw-medium">
                                    @if (Str::length($book->book_name) < 35)
                                        {{ $book->book_name }} <br>
                                        <span class="mt-1 fw-light">
                                            {{ $book->author }}
                                        </span>
                                    @elseif(Str::length($book->book_name) >= 35)
                                        {{ Str::limit($book->book_name, 35) . '...' }} <br>
                                        <span class="mt-1 fw-light">
                                            {{ $book->author }}
                                        </span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </a>
                @empty
                    <h2>Maaf Buku yang anda cari tidak ada...</h2>
                @endforelse
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
                                    <tr>
                                      <th>Harga</th>
                                      <td><span id="book-price"></span></td>
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
        // Add JavaScript to handle filter button click
        document.addEventListener('DOMContentLoaded', function() {
            const specSelect = document.getElementById('spec_id');
            const specDetailSelect = document.getElementById('spec_detail_id');
            const filterButton = document.getElementById('filterButton');
            const searchInput = document.getElementById('search');
            const searchButton = document.getElementById('searchbtn');

            // Add event listener for keypress events on the search input
            searchInput.addEventListener('keypress', function(event) {
                // Check if the pressed key is Enter (key code 13)
                if (event.key === 'Enter') {
                    // Prevent the default form submission behavior
                    event.preventDefault();

                    // Get the search input value
                    const searchValue = event.target.value;

                    // Construct the URL with the search filter value
                    const url = "{{ route('user.donate') }}?search=" + searchValue;

                    // Perform a page reload with the updated URL
                    window.location.href = url;
                }
            });

            searchButton.addEventListener('click', function() {
                //get search input value
                const searchVal = searchInput.value;
                // Construct the URL with selected filter values
                const url = "{{ route('user.donate') }}?search=" + searchVal;

                // Perform a page reload with the updated URL
                window.location.href = url;
            })

        });
    </script>

    <script>
        //Modal dialog
        $('body').on('click', '#show-detail', function() {
            var userURL = $(this).data('url');
            $.get(userURL, function(data) {
                // var img = text("/store/app/public/images/") + text(data.image);
                $('#userShowModal').modal('show');
                $('#book-name').text(data.book_name);
                $('#book-publisher').text(data.publisher);
                $('#book-author').text(data.author);
                $('#book-desc').text(data.desc);
                $('#book-price').text(data.price);
                // Set the image source
                var imagePath = "{{ asset('store/images/') }}/" + data.image;
                $('#book-image').attr("src", imagePath);
            })
        });
    </script>

@endsection
