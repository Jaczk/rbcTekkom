@extends('mahasiswa.layouts.detail-base')

@section('title', 'Detail Capstone')

@section('content')
    <div class="col-xl-8 row mx-auto">
        <div id="theses-title">
            <div class="mt-4 title fs-3">
                Detail Capstone
            </div>
            <div class="mt-2 fs-6">
                <a class="link-underline link-underline-opacity-0" href="{{ route('user.capstone.gallery') }}">Home</a> >
                Detail Dokumen Capstone
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
        <!-- Nav pills -->
        <div class="mt-2 col-md-6">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                        type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Deskripsi</button>
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
                            {{ $capstone->summary }}
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                    tabindex="0">
                    <div class="mt-2 mb-4">
                        <div class="mt-3">
                            <div>
                                <a class="link-underline link-underline-opacity-0"
                                    href="{{ asset('store/c100/' . $capstone->c100) }}" target="_blank"><i
                                        class="fa-regular fa-file me-2 mt-2"></i>Dokumen C100</a>
                            </div>
                            <div>
                                <a class="link-underline link-underline-opacity-0"
                                    href="{{ asset('store/c200/' . $capstone->c200) }}" target="_blank"><i
                                        class="fa-regular fa-file me-2 mt-2"></i>Dokumen C200</a>
                            </div>
                            @if (Auth::check() && Auth::user()->role_id == 3)
                                <div>
                                    <a class="link-underline link-underline-opacity-0"
                                        href="{{ asset('store/c300/' . $capstone->c300) }}" target="_blank"><i
                                            class="fa-regular fa-file me-2"></i>Dokumen C300</a>
                                </div>
                                <div>
                                    <a class="link-underline link-underline-opacity-0"
                                        href="{{ asset('store/c400/' . $capstone->c400) }}" target="_blank"><i
                                            class="fa-regular fa-file me-2"></i>Dokumen C400</a>
                                </div>
                                <div>
                                    <a class="link-underline link-underline-opacity-0"
                                        href="{{ asset('store/c500/' . $capstone->c500) }}" target="_blank"><i
                                            class="fa-regular fa-file me-2"></i>Dokumen C500</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
