@extends('mahasiswa.layouts.base')

@section('title', 'Tugas Akhir')

@section('content')

    <div class="col-xl-8 row mx-auto">
        <div id="theses-title">
            <div class="mt-4 title fs-3">
                Katalog Tugas Akhir
            </div>
            <div class="mt-2 fs-6">
                <a href="{{ route('user.theses.gallery') }}">Home</a>
            </div>
            <form action="" class="w-100 me-4">
                <div class="p-1 my-4 border input-group rounded-2 w-100">
                    <input type="search" placeholder="Masukkan Judul Tugas Akhir atau Nama Penulis"
                        aria-describedby="button-addon3" class="border-0 form-control bg-none" id="search">
                    <div class="border-0 input-group-append">
                        <button id="searchbtn" type="button" class="btn btn-link text-success"><i
                                class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Filter --}}
        <div class="col-xl-4">
            <div class="fs-4 ">
                Filter
            </div>
            <div class="d-flex mt-2 justify-content-between">
                <div>
                    <label for="" class="mb-2">Sort</label>
                    <select name="sorted" id="sorted" class="form-select me-2">
                        <option selected value="1">Terbaru</option>
                        <option value="2">Terlama</option>
                    </select>
                </div>
                <div>
                    <label for="" class="mb-2">Dari Tahun</label>
                    <select name="startYear" id="startYear" class="me-2 form-select">
                        <option value="" disabled selected>Tahun Awal</option>
                        @foreach ($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="" class="mb-2">Hingga</label>
                    <select name="endYear" id="endYear" class="form-select">
                        <option value="" disabled selected>Tahun Akhir</option>
                        @foreach ($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div>
                <label for="" class="my-2">Sort nama Dosen</label>
                <select name="sortLecturer" id="sortLecturer" class="me-4 form-control">
                    <option value="" disabled selected>Nama Dosen</option>
                    @foreach ($lecturers as $lect)
                        <option value="{{ $lect->id }}">{{ $lect->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="" class="my-2">Sort Spesialisasi</label>
                <select name="sortSpec" id="sortSpec" class="me-4 form-control">
                    <option value="" disabled selected>Jenis Spesialisasi</option>
                    @foreach ($specs as $spec)
                        <option value="{{ $spec->id }}">{{ $spec->desc }}</option>
                    @endforeach
                </select>
            </div>
            <div class="btn btn-primary my-3"id="filterButton">
                Terapkan Filter
            </div>

        </div>

        {{-- Theses Content --}}
        <div class="col-xl-8">
            <div class="ms-5">

                @forelse ($theses as $t)
                    <div class="col-md-12 mb-3">
                        <div class="border-bottom border-dark border-2">
                            <a href="{{ route('user.theses.detail', Crypt::encryptString($t->id)) }}" class="fs-5">
                                {{ $t->thesis_name }}
                            </a>
    
                        </div>
                        <div class="mt-2 d-flex flex-row">
                            <i class="fa-solid fa-user mt-1"></i>
                            <div class="ms-2" style="color: #071952">
                                {{ $t->author }} | {{ $t->lec1->name }} | {{ $t->lec2->name }}
                            </div>
                        </div>
                        <div class="mt-2 d-flex flex-row">
                            <i class="fa-regular fa-file mt-1"></i>
                            <div class="ms-2">
                                {{ $t->year }}
                            </div>
                        </div>
                    </div>
                @empty
                    <h2>Maaf Tugas Akhir yang anda cari tidak ada...</h2>
                @endforelse
    
                @if ($theses->hasPages())
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            @if ($theses->currentPage() > 1)
                                <li class="page-item"><a class="page-link" href="{{ $theses->previousPageUrl() }}">Previous</a>
                                </li>
                            @endif
    
                            @for ($i = max(1, $theses->currentPage() - 1); $i <= min($theses->lastPage(), $theses->currentPage() + 1); $i++)
                                <li class="page-item {{ $i == $theses->currentPage() ? 'active' : '' }}"><a class="page-link"
                                        href="{{ $theses->url($i) }}">{{ $i }}</a></li>
                            @endfor
    
                            @if ($theses->currentPage() < $theses->lastPage())
                                <li class="page-item"><a class="page-link" href="{{ $theses->nextPageUrl() }}">Next</a></li>
                            @endif
                        </ul>
                    </nav>
                @endif
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sortSelect = document.getElementById('sorted');
            const startYearSelect = document.getElementById('startYear');
            const endYearSelect = document.getElementById('endYear');
            const lecturerSelect = document.getElementById('sortLecturer');
            const specSelect = document.getElementById('sortSpec');
            const filterButton = document.getElementById('filterButton');
            const searchInput = document.getElementById('search');
            const searchButton = document.getElementById('searchbtn');

            filterButton.addEventListener('click', function() {
                // Get selected values from the dropdowns
                const specId = specSelect.value;
                const sort = sortSelect.value;
                const startYear = startYearSelect.value;
                const endYear = endYearSelect.value;
                const lecturerId = lecturerSelect.value;
                const searchValue = searchInput.value;

                // Construct the URL with selected filter values
                const url = "{{ route('user.theses.gallery') }}?sortSpec=" + specId +
                    "&sort=" + sort + "&sortLec=" + lecturerId + "&search=" + searchValue + "&startYear=" +
                    startYear + "&endYear=" + endYear;

                // Perform a page reload with the updated URL
                window.location.href = url;
            });
            // Add event listener for keypress events on the search input
            searchInput.addEventListener('keypress', function(event) {
                // Check if the pressed key is Enter (key code 13)
                if (event.key === 'Enter') {
                    // Prevent the default form submission behavior
                    event.preventDefault();

                    // Get the search input value
                    const searchValue = event.target.value;
                    const specId = specSelect.value;
                    const sort = sortSelect.value;
                    const startYear = startYearSelect.value;
                    const endYear = endYearSelect.value;
                    const lecturerId = lecturerSelect.value;

                    // Construct the URL with the search filter value
                    const url = "{{ route('user.theses.gallery') }}?search=" + searchValue +
                        "&sort=" + sort + "&sortLec=" + lecturerId + "&sortSpec=" + specId +
                        "&startYear=" + startYear + "&endYear=" + endYear;

                    // Perform a page reload with the updated URL
                    window.location.href = url;
                }
            });

            searchButton.addEventListener('click', function(event) {
                // Get the search input value
                const searchValue = searchInput.value;
                const specId = specSelect.value;
                const sort = sortSelect.value;
                const startYear = startYearSelect.value;
                const endYear = endYearSelect.value;
                const lecturerId = lecturerSelect.value;

                // Construct the URL with the search filter value
                const url = "{{ route('user.theses.gallery') }}?search=" + searchValue +
                    "&sort=" + sort + "&sortLec=" + lecturerId + "&sortSpec=" + specId +
                    "&startYear=" + startYear + "&endYear=" + endYear;

                // Perform a page reload with the updated URL
                window.location.href = url;
            });


        });
    </script>

@endsection
