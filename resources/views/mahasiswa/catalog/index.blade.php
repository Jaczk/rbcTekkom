@extends('mahasiswa.layouts.base')

@section('title', 'Dasbor')

@section('content')

    <div class="p-3 poppins-text container-fluid">
        <div class="d-flex justify-content-between">
            <div class="mt-4 title fs-2 ms-4">
                Katalog Buku
            </div>
            
            <div class="form-groups">
                <select name="spec_id" class="mt-4 selectpicker" id="spec_id" data-size="4">
                    @foreach ($specs as $spec)
                        <option value="{{ $spec->id }}">
                            {{ old('spec_id') == $spec->id ? 'selected' : '' }}
                            {{ $spec->desc }}
                        </option>
                    @endforeach
                </select>

            </div>
            <form action="" class="w-25 me-4">
                <div class="p-1 my-4 border input-group rounded-2 w-100">
                    <input type="search" placeholder="What're you searching for?" aria-describedby="button-addon3"
                        class="border-0 form-control bg-none">
                    <div class="border-0 input-group-append">
                        <button id="button-addon3" type="button" class="btn btn-link text-success"><i
                                class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="catalog">
            <div class="mt-5 ms-3 container-fluid row d-flex">
                @foreach ($books as $book)
                    <div class="mx-3" style="width: 250px; height: 420px;">
                        <img src="{{ asset('storage/images/' . $book->image) }}" class="card-img rounded-4 object-fit-cover"
                            style="height: 300px; width: 100%;" alt="bookImage">
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
                @endforeach
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>
        // Add JavaScript to handle specialization link clicks
        document.addEventListener('DOMContentLoaded', function() {
            const specLinks = document.querySelectorAll('.specBook a');

            specLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const specId = link.getAttribute('href').split('/').pop();
                    reloadBooks(specId);
                });
            });

            function reloadBooks(specId) {
                // You can use AJAX to fetch books based on the selected specialization
                // Update the URL and use it in your controller to filter books by specialization
                const url = "{{ route('user.catalog') }}?spec=" + specId;

                // Perform AJAX request or navigate to the URL
                // For example, you can use fetch or jQuery.ajax
                // Update the displayed books after fetching data
                // ...

                // For demonstration purposes, let's simulate a page reload
                window.location.href = url;
            }
        });
    </script>




@endsection
