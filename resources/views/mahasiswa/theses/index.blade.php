@extends('mahasiswa.layouts.base')

@section('title', 'Tugas Akhir')

@section('content')
    <div class="row p-2 ms-4">
        <div id="theses-title">
            <div class="mt-4 title fs-3">
                Katalog Tugas Akhir
            </div>
            <div class="mt-2 fs-6">
                <a href="{{ route('user.theses.gallery') }}">Home</a>
            </div>
            <!-- Search form -->
            <div class="active-cyan-4 mb-4 mt-3 w-75">
                <input class="form-control" type="text" placeholder="Cari Judul Tugas Akhir" aria-label="Search">
            </div>
        </div>
        <div class="col-xl-3">
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
            <div class="btn btn-primary my-3">
                Terapkan Filter
            </div>

        </div>
        <div class="col-xl-8 ms-5">
            <div class="row">
                @if (empty($theses))
                    <h2>Tidak ada Tugas Akhir</h2>
                @else
                    @foreach ($theses as $t)
                        <div class="col-md-10 mb-3">
                            <div class="border-bottom border-dark">
                                <a href="{{ route('user.theses.detail', Crypt::encryptString($t->id)) }}">
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
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
