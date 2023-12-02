@extends('admin.layouts.base')

@section('title', 'Edit Tugas Akhir')

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
                    <h3 class="card-title">Edit Buku</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" method="POST" action="{{ route('admin.theses.update', $theses->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class=" mb-1" for="thesis_name">Judul Laporan Tugas Akhir</label>
                                    <input class="form-control" id="thesis_name" type="text"
                                        placeholder="Masukkan Judul Tugas Akhir anda " name="thesis_name"
                                        value="{{ $theses->thesis_name }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="spec" class="mb-1">Peminatan</label>
                                    <select class="selectpicker" name="spec_id" data-live-search="true" data-width="100%"
                                        data-size="6">
                                        @foreach ($spec as $l)
                                            <option value="{{ $l->id }}" class="text-black filt-drop"
                                                {{ $theses->spec_id == $l->id ? 'selected' : '' }}>
                                                {{ $l->desc }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
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
                                            {{ $theses->lec1_id == $l->id ? 'selected' : '' }}>
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
                                            {{ $theses->lec2_id == $l->id ? 'selected' : '' }}>
                                            {{ $l->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                        </div>

                        <div class="form-row mt-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="mb-1" for="abstract">Abstrak</label>
                                    <textarea class="form-control" id="abstract" rows="5" name="abstract">
                                  {!! $theses->abstract !!}
                            </textarea>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="mb-1" for="abs_keyword">Kata Kunci Abstrak (Tulis akhir kalimat
                                        dengan
                                        , )</label>
                                    <input class="form-control" id="abs_keyword" type="text" name="abs_keyword"
                                        value="{!! $theses->abs_keyword !!}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="mb-1" for="year">Tahun Tugas Akhir</label>
                                    <input class="form-control" id="year" type="number"
                                        placeholder="Masukkan Tahun Tugas Akhir " name="year"
                                        value="{{ $theses->year }}">
                                </div>
                            </div>

                        </div>


                        <div class="form-row mt-3">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="mb-1" for="file_1">File Tugas Akhir (PDF) (Cover, Daftar, Bab 1 ,
                                        dan
                                        Bab
                                        2)</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file_1" name="file_1"
                                            value="{{ old('file_1') }}">
                                        <label class="custom-file-label" for="file">Choose file...</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-1">
                                    <label class="mb-1" for="file_2">File Tugas Akhir (PDF) (Cover, Daftar, Bab 1
                                        hingga Bab
                                        5 atau 6, beserta lampiran)</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file_2" name="file_2"
                                            value="{{ old('file_2') }}">
                                        <label class="custom-file-label" for="file">Choose file...</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" onclick="confirmEditForm(event)">Simpan</button>
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
        updateLabel('file_1');

        // Call the function for file_2
        updateLabel('file_2');


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
