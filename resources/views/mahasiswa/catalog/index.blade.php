@extends('mahasiswa.layouts.base')

@section('title', 'Dasbor')

@section('content')

    <div class="p-3 poppins-text container-fluid">
        <div class="d-flex justify-content-between">
            <div class="mt-4 title fs-2 ms-4">
                Katalog Buku
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
        <div class="filters">
            <div class="mt-2 title fs-6 ms-5">
                Filter Katalog
            </div>
            <div class="form-groups ms-3">
                <select name="spec_id" class="m-2 selectpicker filt " data-live-search="true" id="spec_id" data-size="5"
                    data-width="25%" title="Pilih Peminatan">
                    <style>
                        .filt-drop {
                            background-color: #FFFFFF;
                            color: black;
                        }

                        .filt-drop:hover {
                            background-color: #D8D8D8;
                            color: white;
                        }
                    </style>
                    
                    @foreach ($specs as $spec)
                        <option value="{{ $spec->id }}" class="text-black filt-drop">
                            {{ old('spec_id') == $spec->id ? 'selected' : '' }}
                            {{ $spec->desc }}
                        </option>
                    @endforeach
                </select>

                <select name="spec_detail_id" class="m-2 selectpicker filt " data-live-search="true" id="spec_detail_id"
                    data-size="5" data-width="25%" title="Pilih Detail Peminatan">
                    <style>
                        .filt-drop {
                            background-color: #FFFFFF;
                            color: black;
                        }

                        .filt-drop:hover {
                            background-color: #D8D8D8;
                            color: white;
                        }
                    </style>
                    <option value="">
                        Detail Peminatan
                    </option>
                    @foreach ($specDetails as $sd)
                        <option value="{{ $sd->id }}" class="text-black filt-drop">
                            {{ old('spec_detail_id') == $sd->id ? 'selected' : '' }}
                            {{ $sd->desc }}
                        </option>
                    @endforeach
                </select>
                <div class="mb-2 btn btn-primary" id="filterButton">
                    Filter
                </div>
            </div>
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
        // Add JavaScript to handle filter button click
        document.addEventListener('DOMContentLoaded', function() {
            const specSelect = document.getElementById('spec_id');
            const specDetailSelect = document.getElementById('spec_detail_id');
            const filterButton = document.getElementById('filterButton');

            // Disable the first option when the dropdown is opened
            specSelect.addEventListener('show.bs.select', function() {
                specSelect.options[0].disabled = true;
            });

            // Disable the first option when the dropdown is opened
            specDetailSelect.addEventListener('show.bs.select', function() {
                specDetailSelect.options[0].disabled = true;
            });

            filterButton.addEventListener('click', function() {
                // Get selected values from the dropdowns
                const specId = specSelect.value;
                const specDetailId = specDetailSelect.value;

                // Construct the URL with selected filter values
                const url = "{{ route('user.catalog') }}?spec=" + specId + "&spec_detail=" + specDetailId;

                // Perform a page reload with the updated URL
                window.location.href = url;
            });
        });
    </script>


@endsection
