@extends('mahasiswa.layouts.base')

@section('title', 'Detail Capstone')

@section('content')
    <div class="p-2 row ms-4">
        <div id="theses-title">
            <div class="mt-4 title fs-3">
                Katalog Capstone
            </div>
            <div class="mt-2 fs-6">
                <a href="{{ route('user.capstone.gallery') }}">Home</a> > Detail Dokumen Capstone
            </div>
        </div>
        <div class="mt-4 ">
            <div class="fs-2">
                {{ $capstone->capstone_title }}
            </div>
            <div class="mt-2">
                <span class="fw-semibold">Spesialisasi</span> : {{ $capstone->spec->desc }}
            </div>
            <div class="mt-2">
                <span class="fw-semibold">Anggota</span> : {{ $capstone->member1->full_name }} |
                {{ $capstone->member2->full_name }} |
                {{ $capstone->member3->full_name }}
            </div>
            <div class="mt-2">
                <span class="fw-semibold">Dosen Pembimbing</span> : {{ $capstone->lec1->name }} |
                {{ $capstone->lec2->name }}
            </div>
            <div class="mt-2">
                <span class="fw-semibold">Kelompok</span> : {{ $capstone->team_name }} Capstone | S1 Teknik Komputer
            </div>
        </div>
        <div class="mt-3">
            <div class="fw-semibold">File PDF</div>
            <div>
                <a href="{{ asset('storage/c100/' . $capstone->c100) }}" target="_blank"><i
                        class="fa-regular fa-file me-2 mt-2"></i>Dokumen C100</a>
            </div>
            <div>
                <a href="{{ asset('storage/c200/' . $capstone->c200) }}" target="_blank"><i
                        class="fa-regular fa-file me-2 mt-2"></i>Dokumen C200</a>
            </div>
            @if (Auth::check() && Auth::user()->role_id == 3)
                <div>
                    <a href="{{ asset('storage/c300/' . $capstone->c300) }}" target="_blank"><i
                            class="fa-regular fa-file me-2"></i>Dokumen C300</a>
                </div>
                <div>
                    <a href="{{ asset('storage/c400/' . $capstone->c400) }}" target="_blank"><i
                            class="fa-regular fa-file me-2"></i>Dokumen C400</a>
                </div>
                <div>
                    <a href="{{ asset('storage/c500/' . $capstone->c500) }}" target="_blank"><i
                            class="fa-regular fa-file me-2"></i>Dokumen C500</a>
                </div>
            @endif
        </div>
    </div>
@endsection
