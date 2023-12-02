@extends('mahasiswa.layouts.base')

@section('title', 'Tugas Akhir')

@section('content')
    <div class="p-2 row ms-4">
        <div id="theses-title">
            <div class="mt-4 title fs-3">
                Katalog Tugas Akhir
            </div>
            <div class="mt-2 fs-6">
                <a href="{{ route('user.theses.gallery') }}">Home</a> > Detail Tugas Akhir
            </div>
        </div>
        <div class="mt-4 ">
            <div class="fs-3">
                {{ $theses->thesis_name }}
            </div>
            <div class="mt-2">
                <span class="fw-semibold">Penulis</span> : {{ $theses->author }}
            </div>
            <div class="mt-2">
                <span class="fw-semibold">Dosen Pembimbing</span> : {{ $theses->lec1->name }} & {{ $theses->lec2->name }}
            </div>
            <div class="mt-2">
                {{ $theses->year }} | Tugas Akhir | S1 Teknik Komputer
            </div>
        </div>
        <div class="mt-3">
            <div class="fs-5 fw-semibold">Abstrak</div>
            <div class="fs-6">
                {{ $theses->abstract }}
            </div>
        </div>
        <div class="mt-2">
            <span class="fw-semibold">Kata Kunci: </span>
            <span>{{ $theses->abs_keyword }}</span>
        </div>
        <div class="mt-2">
            <div class="mb-2">File PDF</div>
            @if (Auth::check() && Auth::user()->role_id == 3)
                <a href="{{ asset('storage/pdf-2/' . $theses->file_2) }}" target="_blank"><i
                        class="fa-regular fa-file me-2"></i>Cover, Bab 1 hingga Bab 5 atau 6</a>
            @else
                <a href="{{ asset('storage/pdf-1/' . $theses->file_1) }}" target="_blank"><i
                        class="fa-regular fa-file me-2"></i>Cover, Bab 1, dan Bab 2</a>
            @endif
        </div>
    </div>
@endsection
