@extends('mahasiswa.layouts.detail-base')

@section('title', 'Tugas Akhir')

@section('content')
    <div class="p-2 row col-xl-8 mx-auto">
        <div id="theses-title">
            <div class="mt-4 title fs-3">
                Detail Tugas Akhir
            </div>
            <div class="mt-2 fs-6">
                <a class="link-underline link-underline-opacity-0" href="{{ route('user.theses.gallery') }}">Home</a> > Detail Tugas Akhir
            </div>
        </div>
        <div class="mt-4 ">
            <div class="fs-3">
                {{ $theses->thesis_name }}
            </div>
            <div class="mt-2">
                <span class="fw-semibold">Spesialisasi</span> : {{ $theses->spec->desc }}
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
        <!-- Nav pills -->
        <div class="mt-2 col-md-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                        type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Abstrak</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                        type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">File
                        PDF</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                    tabindex="0">
                    <div class="mt-3 mb-4">
                        <div class="fs-6 text-justify">
                            {{ $theses->abstract }}
                        </div>
                    </div>
                    <div class="mt-2 fw-semibold">
                        <span >Kata Kunci: </span>
                        <span>{{ $theses->abs_keyword }}</span>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                    tabindex="0">
                    <div class="mt-2 mb-4">
                        @if (Auth::check() && Auth::user()->role_id == 3)
                        <div>
                            <a class="link-underline link-underline-opacity-0" href="{{ asset('store/pdf-2/' . $theses->file_2) }}" target="_blank"><i
                                    class="fa-regular fa-file me-2"></i>Cover, Bab 1 hingga Bab 5 atau 6</a>
                        </div>
                        @else
                        <div>
                            <a class="link-underline link-underline-opacity-0" href="{{ asset('store/pdf-1/' . $theses->file_1) }}" target="_blank"><i
                                    class="fa-regular fa-file me-2"></i>Cover, Bab 1, dan Bab 2</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
