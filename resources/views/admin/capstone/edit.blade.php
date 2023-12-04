@extends('admin.layouts.base')

@section('title', 'Edit Capstone')

@section('content')
    <div class="row">
        <div class="col-md-12">

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

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Capstone</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" method="POST" action="#"> {{-- {{ route('admin.casptone.update', $casptone->id) }} --}}
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="mb-1" for="capstone_title">Judul Capstone</label>
                                    <input class="form-control" id="capstone_title" type="text"
                                        placeholder="Masukkan Judul Capstone anda " name="capstone_title"
                                        value="{{ $capstone->capstone_title }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="spec" class="mb-1">Kategori Peminatan</label>
                                    <select name="spec_id" class="selectpicker" data-live-search="true" id="spec_id"
                                        data-size="5" data-width="100%" title="Pilih Kategori Capstone">
                                        @foreach ($spec as $l)
                                            <option value="{{ $l->id }}" class="text-black filt-drop"
                                                {{ $capstone->spec_id == $l->id ? 'selected' : '' }}>
                                                {{ $l->desc }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="mb-1" for="team_name">Kelompok</label>
                                    <input class="form-control" id="team_name" type="text" placeholder="S1T22K13"
                                        name="team_name" value="{{ $capstone->team_name }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="mb-1" for="year">Tahun Capstone</label>
                                    <input class="form-control" id="year" type="number" placeholder="2023"
                                        name="year" value="{{ $capstone->year }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-row mb-3">
                            <div class="col">
                                @if ($capstone->member1->id == auth()->user()->id)
                                    <input type="hidden" name="member1_id" value="{{ auth()->user()->id }}">
                                    <label class="mb-1" for="team_name">Anggota 1</label>
                                    <select name="member1_id" class="selectpicker filt" data-live-search="true"
                                        id="member1_id" data-size="5" data-width="100%" title="Anggota 1" disabled>
                                        <option value="{{ auth()->user()->id }}" class="text-black filt-drop" selected>
                                            {{ auth()->user()->name }}
                                        </option>
                                    </select>
                                @else
                                    <label class="mb-1" for="team_name">Anggota 2</label>
                                    <select name="member1_id" class="selectpicker filt" data-live-search="true"
                                        id="member1_id" data-size="5" data-width="100%" title="Anggota 1">
                                        @foreach ($users as $user)
                                            @if ($user->id != auth()->user()->id)
                                                <option value="{{ $user->id }}" class="text-black filt-drop"
                                                    {{ $capstone->member1->id == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            <div class="col">
                                @if ($capstone->member2->id == auth()->user()->id)
                                    <label class="mb-1" for="team_name">Anggota 2</label>
                                    <input type="hidden" name="member2_id" value="{{ auth()->user()->id }}">
                                    <select name="member2_id" class="selectpicker filt" data-live-search="true"
                                        id="member2_id" data-size="5" data-width="100%" title="Anggota 2" disabled>
                                        <option value="{{ auth()->user()->id }}" class="text-black filt-drop" selected>
                                            {{ auth()->user()->name }}
                                        </option>
                                    </select>
                                @else
                                    <label class="mb-1" for="team_name">Anggota 2</label>
                                    <select name="member2_id" class="selectpicker filt" data-live-search="true"
                                        id="member2_id" data-size="5" data-width="100%" title="Anggota 2">
                                        @foreach ($users as $user)
                                            @if ($user->id != auth()->user()->id)
                                                <option value="{{ $user->id }}" class="text-black filt-drop"
                                                    {{ $capstone->member2->id == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            <div class="col">
                                @if ($capstone->member3->id == auth()->user()->id)
                                    <label class="mb-1" for="team_name">Anggota 3</label>
                                    <input type="hidden" name="member3_id" value="{{ auth()->user()->id }}">
                                    <select name="member3_id" class="selectpicker filt" data-live-search="true"
                                        id="member3_id" data-size="5" data-width="100%" title="Anggota 3" disabled>
                                        <option value="{{ auth()->user()->id }}" class="text-black filt-drop" selected>
                                            {{ auth()->user()->name }}
                                        </option>
                                    </select>
                                @else
                                    <label class="mb-1" for="team_name">Anggota 3</label>
                                    <select name="member3_id" class="selectpicker filt" data-live-search="true"
                                        id="member3_id" data-size="5" data-width="100%" title="Anggota 3">
                                        @foreach ($users as $user)
                                            @if ($user->id != auth()->user()->id)
                                                <option value="{{ $user->id }}" class="text-black filt-drop"
                                                    {{ $capstone->member3->id == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <label class="mb-1" for="team_name">Dosen Pembimbing 1</label>
                                <select name="lec1_id" class="selectpicker" data-live-search="true" id="lec1_id"
                                    data-size="5" title="Dospem 1" data-width="100%">
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
                                            {{ $capstone->lec1_id == $l->id ? 'selected' : '' }}>
                                            {{ $l->name }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>
                            <div class="col">
                                <label class="mb-1" for="team_name">Dosen Pembimbing 2</label>
                                <select name="lec2_id" class="selectpicker" data-live-search="true" id="lec2_id"
                                    data-size="5" title="Dospem 2" data-width="100%">
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
                                            {{ $capstone->lec2_id == $l->id ? 'selected' : '' }}>
                                            {{ $l->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                        </div>

                        <div class="form-row mt-3">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="mb-1" for="c100">File C100 (PDF)</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="c100" name="c100"
                                            value="{{ $capstone->c100 }}">
                                        <label class="custom-file-label" for="file">Choose file...</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label class="mb-1" for="c200">File C200 (PDF)</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="c200" name="c200"
                                            value="{{ $capstone->c200 }}">
                                        <label class="custom-file-label" for="file">Choose file...</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <label class="mb-1" for="c300">File C300 (PDF)</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="c300" name="c300"
                                        value="{{ $capstone->c300 }}">
                                    <label class="custom-file-label" for="file">Choose file...</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label class="mb-1" for="c400">File C400 (PDF)</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="c400" name="c400"
                                            value="{{ $capstone->c400 }}">
                                        <label class="custom-file-label" for="file">Choose file...</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label class="mb-1" for="c500">File C500 (PDF)</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="c500" name="c500"
                                            value="{{ $capstone->c500 }}">
                                        <label class="custom-file-label" for="file">Choose file...</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"
                                onclick="confirmEditForm(event)">Simpan</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('textarea').val($('textarea').val().trim());
    </script>
    <script>
        function confirmEditForm(event) {
            event.preventDefault(); // Prevent default form submission

            Swal.fire({
                title: 'Simpan perubahan?',
                text: 'Data Buku akan diperbarui.',
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
        // Function to update label text with the selected file name
        function updateLabel(inputId) {
            const fileInput = document.getElementById(inputId);

            // Add event listener to update the label text with the selected file name
            fileInput.addEventListener('change', function() {
                // Get the file name from the input value
                const fileName = this.value.split('\\').pop();
                // Update the label text with the file name
                const labelElement = this.nextElementSibling;
                labelElement.innerText = fileName;
            });
        }

        // Call the function for file_1
        updateLabel('c100');

        // Call the function for file_2
        updateLabel('c200');


        document.getElementById('is_recommended').addEventListener('change', function() {
            // If the checkbox is checked, set the hidden input value to 1
            if (this.checked) {
                document.getElementById('is_recommended').value = 1;
            } else {
                document.getElementById('is_recommended').value = 0;
            }
        });

        function previewImage() {
            const image = document.getElementById('img-preview');
            image.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
@endsection
