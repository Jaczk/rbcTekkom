@extends('mahasiswa.layouts.base')

@section('title', 'Capstone')

@section('content')
    <div class="p-2 row ms-4">
        <div id="theses-title">
            <div class="mt-4 title fs-3">
                Katalog Capstone
            </div>
            <div class="mt-2 fs-6">
                <a href="{{ route('user.capstone.gallery') }}">Home</a>
            </div>
            <form action="" class="w-75 me-4">
                <div class="p-1 my-4 border input-group rounded-2 w-100">
                    <input type="search" placeholder="Cari Judul Proyek Capstone atau kode Tim Capstone"
                        aria-describedby="button-addon3" class="border-0 form-control bg-none" id="search">
                    <div class="border-0 input-group-append">
                        <button id="searchbtn" type="button" class="btn btn-link text-success"><i
                                class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-xl-3">
            <div class="fs-5 ">
                Filter
            </div>
            <div class="mt-2 d-flex justify-content-between">
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
            <div class="my-3 btn btn-primary" id="filterButton">
                Terapkan Filter
            </div>
        </div>
        <div class="col-xl-9">
            <div class="row ms-2">
                @forelse ($capstones as $c)
                    <div class="mb-3 col-md-10">
                        <div class="border-bottom border-dark">
                            <a href="{{ route('user.capstone.detail', Crypt::encryptString($c->team_name)) }}">
                                {{ $c->capstone_title }}
                            </a>
                        </div>
                        <div class="flex-row mt-1 d-flex">
                            <i class="mt-1 fa-solid fa-user"></i>
                            <div class="ms-2">
                                {{ $c->member1->full_name }} | {{ $c->member2->full_name }} |
                                {{ $c->member3->full_name }}
                            </div>
                        </div>
                        <div class="flex-row mt-1 d-flex">
                            <i class="mt-1 nav-icon fas fa-user-graduate"></i>
                            <div class="ms-2">
                                {{ $c->lec1->name }} | {{ $c->lec2->name }}
                            </div>
                        </div>
                        <div class="flex-row mt-2 d-flex">
                            <i class="mt-1 fa-solid fa-user-group"></i>
                            <div class="ms-2">
                                Kelompok {{ $c->team_name }} | {{ $c->year }}
                            </div>
                        </div>
                    </div>
                @empty
                    <h2>Maaf Dokumen Capstone yang anda cari tidak ada...</h2>
                @endforelse
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
                const url = "{{ route('user.capstone.gallery') }}?sortSpec=" + specId +
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
                    const url = "{{ route('user.capstone.gallery') }}?search=" + searchValue +
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
                const url = "{{ route('user.capstone.gallery') }}?search=" + searchValue +
                    "&sort=" + sort + "&sortLec=" + lecturerId + "&sortSpec=" + specId +
                    "&startYear=" + startYear + "&endYear=" + endYear;

                // Perform a page reload with the updated URL
                window.location.href = url;
            });
        });
    </script>

@endsection
