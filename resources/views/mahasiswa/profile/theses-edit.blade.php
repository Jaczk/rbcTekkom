@extends('mahasiswa.layouts.base')

@section('title', 'Edit Tugas Akhir')

@section('content')
    <div class="container-xl p-4 mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <a class="nav-link active ms-0" href="{{ route('user.profile') }}" target="__blank">Profile</a>
            <a class="nav-link" href="{{ route('user.profile.theses') }}" target="__blank">
                Upload Tugas Akhir</a>
            <a class="nav-link" href="{{ route('user.profile.capstone') }}" target="__blank">Upload Capstone</a>
        </nav>
        <hr class="mt-0 mb-4">
        <form enctype="multipart/form-data" method="POST" action="{{ route('user.profile.theses.update', $theses->id) }}">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-xl-8">
                    <div class="card mb-4">
                        <div class="card-header">Edit Tugas Akhir</div>
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
                                <label class="small mb-1" for="thesis_name">Judul Laporan Tugas Akhir</label>
                                <input class="form-control" id="thesis_name" type="text"
                                    placeholder="Masukkan Judul Tugas Akhir anda " name="thesis_name"
                                    value="{{ $theses->thesis_name }}">
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
                                                {{ $theses->spec_id == $l->id ? 'selected' : '' }}>
                                                {{ $l->desc }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                            </div>

                            <div class="mb-3">
                                <label class="small mb-1" for="author">Nama Penulis</label>
                                <!-- Visible input field -->
                                <input class="form-control" id="author" type="text" disabled
                                    placeholder="Masukkan nama penulis " name="author" value="{{ $theses->user->name }}">
                                <!-- Hidden input field -->
                                <input type="hidden" name="hidden_author" value="{{ $theses->user->name }}">
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
                                                {{ $theses->lec1_id == $l->id ? 'selected' : '' }}>
                                                {{ $l->name }}
                                            </option>
                                        @endforeach

                                    </select>

                                    <select name="lec2_id" class="selectpicker filt " data-live-search="true" id="lec2_id"
                                        data-size="5" data-width="48%" title="Dospem 2">
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
                                                {{ $theses->lec2_id == $l->id ? 'selected' : '' }}>
                                                {{ $l->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                            </div>

                            <div class="mb-3">
                                <label class="small mb-1" for="year">Tahun Tugas Akhir</label>
                                <input class="form-control" id="year" type="number"
                                    placeholder="Masukkan Tahun Tugas Akhir " name="year" value="{{ $theses->year }}">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="abstract">Abstrak</label>
                                <textarea class="form-control" id="abstract" rows="5" name="abstract">
                                  {!! $theses->abstract !!}
                            </textarea>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="abs_keyword">Kata Kunci Abstrak (Tulis akhir kalimat dengan
                                    , )</label>
                                <input class="form-control" id="abs_keyword" type="text" name="abs_keyword"
                                    value="{!! $theses->abs_keyword !!}">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="file_1">File Tugas Akhir (PDF) (Cover, Daftar, Bab 1 ,
                                    dan
                                    Bab
                                    2)</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file_1" name="file_1"
                                        value="{{ old('file_1') }}">
                                </div>
                            </div>
                            <div class="mb-1">
                                <label class="small mb-1" for="file_2">File Tugas Akhir (PDF) (Cover, Daftar, Bab 1
                                    hingga Bab
                                    5 atau 6, beserta lampiran)</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file_2" name="file_2"
                                        value="{{ old('file_2') }}">
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
                title: 'Perbarui Data Tugas Akhir?',
                text: 'Data Tugas Akhir akan diperbarui, harap perhatikan bahwa dokumen telah di ttd',
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
