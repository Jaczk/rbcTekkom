@extends('mahasiswa.layouts.base')

@section('title', 'Capstone')

@section('content')
    <div class="row p-4 ms-4">
        <div id="theses-title">
            <div class="mt-4 title fs-3">
                Katalog Capstone
            </div>
            <div class="mt-2 fs-6">
                <a href="{{ route('user.capstone.gallery') }}">Home</a>
            </div>
            <!-- Search form -->
            <div class="active-cyan-4 mb-4 mt-3 w-25">
                <input class="form-control" type="text" placeholder="Search" aria-label="Search">
            </div>
        </div>
        <div class="col-xl-4">
            <div class="fs-5 ">
                Filter
            </div>
            <div class="flex-row d-flex mt-2">
                <div class=" me-2">
                    sort
                </div>
                <div>
                    <select name="sorted" id="sorted">
                        <option selected value="1">Terbaru</option>
                        <option value="2">Terlama</option>
                    </select>
                </div>
            </div>
            <div class="d-flex flex-row mt-2">
                <div class="me-5">
                    Dari Tahun
                </div>
                <div class="ms-4">
                    Hingga
                </div>
            </div>
            <div class="d-flex flex-row mt-2">
                <select name="startYear" id="startYear" class="me-4">
                    <option value="" disabled selected>Tahun Awal</option>
                    @foreach ($years as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
                <select name="endYear" id="endYear" class="ms-4">
                    <option value="" disabled selected>Tahun Akhir</option>
                    @foreach ($years as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>
            <div class="me-5 mt-2">
                Sort Dosen
            </div>
            <div>
                <select name="sortLecturer" id="sortLecturer" class="me-4">
                    <option value="" disabled selected>Nama Dosen</option>
                    @foreach ($lecturers as $lect)
                        <option value="{{ $lect->id }}">{{ $lect->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="me-5 mt-2">
                Sort Spesialisasi
            </div>
            <div>
                <select name="sortSpec" id="sortSpec" class="me-4">
                    <option value="" disabled selected>Jenis Spesialisasi</option>
                    @foreach ($specs as $spec)
                        <option value="{{ $spec->id }}">{{ $spec->desc }}</option>
                    @endforeach
                </select>
            </div>
            <div class="btn btn-primary mt-3">
                Terapkan Filter
            </div>

        </div>
        <div class="col-xl-8">
            <div class="row">
                @if (empty($capstones))
                    <h2>Tidak ada Capstone</h2>
                @else
                    @foreach ($capstones as $c)
                        <div class="col-md-10 mb-5">
                            <div class="border-bottom border-dark">
                                {{ $c->thesis_name }}
                            </div>
                            <div class="mt-2 d-flex flex-row">
                                <i class="fa-solid fa-user mt-1"></i>
                                <div class="ms-2">
                                    {{ $c->author }}, {{ $c->lec1->name }}, {{ $c->lec2->name }}
                                </div>
                            </div>
                            <div class="mt-2 d-flex flex-row">
                                <i class="fa-regular fa-file mt-1"></i>
                                <div class="ms-2">
                                    {{ $c->year }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
