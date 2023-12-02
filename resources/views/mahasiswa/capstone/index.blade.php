@extends('mahasiswa.layouts.base')

@section('title', 'Capstone')

@section('content')
    <div class="p-4 row ms-4">
        <div id="theses-title">
            <div class="mt-4 title fs-3">
                Katalog Capstone
            </div>
            <div class="mt-2 fs-6">
                <a href="{{ route('user.capstone.gallery') }}">Home</a>
            </div>
            <!-- Search form -->
            <div class="mt-3 mb-4 active-cyan-4 w-75">
                <input class="form-control" type="text" placeholder="Cari Judul Proyek Capstone" aria-label="Search">
            </div>
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
            <div class="my-3 btn btn-primary">
                Terapkan Filter
            </div>
        </div>
        <div class="col-xl-9">
            <div class="row ms-2">
                @foreach ($capstones as $c)
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
                            <i class="nav-icon fas fa-user-graduate mt-1"></i>
                            <div class="ms-2">
                                {{ $c->lec1->name }} | {{ $c->lec2->name}}
                            </div>
                        </div>
                        <div class="flex-row mt-2 d-flex">
                            <i class="fa-solid fa-user-group mt-1"></i>
                            <div class="ms-2">
                                Kelompok {{ $c->team_name }} | {{ $c->year }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
