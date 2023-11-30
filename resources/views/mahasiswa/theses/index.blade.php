@extends('mahasiswa.layouts.base')

@section('title', 'Tugas Akhir')

@section('content')
    <div class="row p-4 ms-4">
        <div id="theses-title">
            <div class="mt-4 title fs-3">
                Katalog Tugas Akhir
            </div>
            <div class="mt-2 fs-6">
                <a href="{{ route('user.theses.gallery') }}">Home</a>
            </div>
            <!-- Search form -->
            <div class="active-cyan-4 mb-4 mt-3 w-25">
                <input class="form-control" type="text" placeholder="Search" aria-label="Search">
            </div>
        </div>
        <div class="col-xl-3">
            <div class="fs-5">
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
            <div class="btn btn-primary mt-3">
                Terapkan Tahun
            </div>
            
        </div>
        <div class="col-xl-9">
            <h1>hello</h1>
        </div>
    </div>
@endsection
