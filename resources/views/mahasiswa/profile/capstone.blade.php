@extends('mahasiswa.layouts.base')

@section('title', 'Tugas Akhir')

@section('content')
    <div class="container-xl p-4 mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <a class="nav-link active ms-0" href="{{ route('user.profile') }}" target="__blank">Profile</a>
            <a class="nav-link" href="{{ route('user.profile.theses') }}" target="__blank">
                Upload Tugas Akhir</a>
            <a class="nav-link" href="#" target="__blank">Upload Capstone</a>
        </nav>
        <hr class="mt-0 mb-4">
        <form enctype="multipart/form-data" method="POST" action="{{ route('user.profile.capstone.create') }}">
            @csrf
            <div class="row">
                <div class="col-xl-8">
                    <div class="card mb-4">
                        <div class="card-header">Capstone</div>
                        <div class="card-body">
                            {{-- Alert Here --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (session()->has('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="mb-3">
                                <label class="small mb-1" for="capstone_title">Judul Capstone</label>
                                <input class="form-control" id="capstone_title" type="text"
                                    placeholder="Masukkan Judul Capstone anda " name="capstone_title"
                                    value="{{ old('capstone_title') }}">
                            </div>

                            <label class="small mb-1" for="team_name">Pilih Kategori</label>
                            <div class="form-row">
                                <div class="mb-3 d-flex justify-content-between">
                                    <select name="spec_id" class="selectpicker filt" data-live-search="true" id="spec_id"
                                        data-size="5" data-width="100%" title="Pilih Kategori Capstone">
                                        <style>
                                            .filt-drop {
                                                background-color: #FFFFFF;
                                                color: black;
                                            }

                                            .filt-drop:hover {
                                                background-color: #D8D8D8;
                                                color: white;
                                            }
                                        </style>

                                        @foreach ($spec as $l)
                                            <option value="{{ $l->id }}" class="text-black filt-drop"
                                                {{ old('spec_id') == $l->id ? 'selected' : '' }}>
                                                {{ $l->desc }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                            </div>

                            <div class="mb-3">
                                <label class="small mb-1" for="team_name">Kelompok</label>
                                <input class="form-control" id="team_name" type="text" placeholder="S1T22K13"
                                    name="team_name" value="{{ old('team_name') }}">
                            </div>
                            <label class="small mb-1" for="team_name">Anggota Kelompok</label>
                            <div class="form-row">
                                <div class="mb-3 d-flex justify-content-between">
                                    <select name="member1_id" class="selectpicker filt" data-live-search="true"
                                        id="member1" data-size="5" data-width="32%" title="Anggota 1" disabled>
                                        <style>
                                            .filt-drop {
                                                background-color: #FFFFFF;
                                                color: black;
                                            }

                                            .filt-drop:hover {
                                                background-color: #D8D8D8;
                                                color: white;
                                            }
                                        </style>
                                        {{-- <input type="hidden" name="user_id" value="{{ auth()->user()->id }}"> --}}
                                        <option value="{{ auth()->user()->id }}" class="text-black filt-drop" selected>
                                            {{ auth()->user()->name }}
                                        </option>

                                    </select>
                                    <input type="hidden" name="member1_id" value="{{ auth()->user()->id }}">

                                    <select name="member2_id" class="selectpicker filt" data-live-search="true"
                                        id="member2" data-size="5" data-width="32%" title="Anggota 2">
                                        <style>
                                            .filt-drop {
                                                background-color: #FFFFFF;
                                                color: black;
                                            }

                                            .filt-drop:hover {
                                                background-color: #D8D8D8;
                                                color: white;
                                            }
                                        </style>

                                        @foreach ($users as $user)
                                            @if ($user->id != auth()->user()->id)
                                                <option value="{{ $user->id }}" class="text-black filt-drop"
                                                    {{ old('member2') == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endif
                                        @endforeach

                                    </select>

                                    <select name="member3_id" class="selectpicker filt " data-live-search="true"
                                        id="member3" data-size="5" data-width="32%" title="Anggota 3">
                                        <style>
                                            .filt-drop {
                                                background-color: #FFFFFF;
                                                color: black;
                                            }

                                            .filt-drop:hover {
                                                background-color: #D8D8D8;
                                                color: white;
                                            }
                                        </style>

                                        @foreach ($users as $user)
                                            @if ($user->id != auth()->user()->id)
                                                <option value="{{ $user->id }}" class="text-black filt-drop"
                                                    {{ old('member2') == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>

                            </div>

                            <label class="small mb-1" for="team_name">Dosen Pembimbing</label>
                            <div class="form-row">
                                <div class="mb-3 d-flex justify-content-between">
                                    <select name="lec1_id" class="selectpicker filt" data-live-search="true" id="lec1_id"
                                        data-size="5" data-width="48%" title="Dospem 1">
                                        <style>
                                            .filt-drop {
                                                background-color: #FFFFFF;
                                                color: black;
                                            }

                                            .filt-drop:hover {
                                                background-color: #D8D8D8;
                                                color: white;
                                            }
                                        </style>

                                        @foreach ($lecturer as $l)
                                            <option value="{{ $l->id }}" class="text-black filt-drop"
                                                {{ old('lec1_id') == $l->id ? 'selected' : '' }}>
                                                {{ $l->name }}
                                            </option>
                                        @endforeach

                                    </select>

                                    <select name="lec2_id" class="selectpicker filt " data-live-search="true"
                                        id="lec2_id" data-size="5" data-width="48%" title="Dospem 2">
                                        <style>
                                            .filt-drop {
                                                background-color: #FFFFFF;
                                                color: black;
                                            }

                                            .filt-drop:hover {
                                                background-color: #D8D8D8;
                                                color: white;
                                            }
                                        </style>

                                        @foreach ($lecturer as $l)
                                            <option value="{{ $l->id }}" class="text-black filt-drop"
                                                {{ old('lec2_id') == $l->id ? 'selected' : '' }}>
                                                {{ $l->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                            </div>

                            <div class="mb-3">
                                <label class="small mb-1" for="year">Tahun Capstone</label>
                                <input class="form-control" id="year" type="number" placeholder="2023"
                                    name="year" value="{{ old('year') }}">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="summary">Ringkasan Proyek Capstone</label>
                                <textarea class="form-control" id="summary" rows="5" name="summary" value="{{ old('summary') }}">
                            </textarea>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="c100">File C100 (PDF)</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="c100" name="c100"
                                        value="{{ old('c100') }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="c200">File C200 (PDF)</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="c200" name="c200"
                                        value="{{ old('c200') }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="c300">File C300 (PDF)</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="c300" name="c300"
                                        value="{{ old('c300') }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="c400">File C400 (PDF)</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="c400" name="c400"
                                        value="{{ old('c400') }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="c500">File C500 (PDF)</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="c500" name="c500"
                                        value="{{ old('c500') }}">
                                </div>
                            </div>

                        </div>
                        <div class="mb-4 ms-4 form-row">
                            <button class="btn btn-primary" type="submit" onclick="confirmCreateForm(event)">Save
                                changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')

    <script>
        function confirmCreateForm(event) {
            event.preventDefault(); // Prevent default form submission

            Swal.fire({
                title: 'Upload Capstone?',
                text: 'Data Capstone akan dibuat, harap perhatikan bahwa dokumen telah di ttd',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Simpan',
                cancelButtonText: 'Kembali',
            }).then((result) => {
                if (result.isConfirmed) {
                    // User confirmed, submit the form
                    event.target.form.submit();
                }
            });
        }
    </script>

    <script>
        $('textarea').val($('textarea').val().trim());
    </script>

@endsection
