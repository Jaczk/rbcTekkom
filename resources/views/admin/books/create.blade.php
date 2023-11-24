@extends('admin.layouts.base')

@section('title', 'Tambah Buku')

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
                    <h3 class="card-title">Tambah Buku</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" method="POST" action="{{ route('admin.book.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="book_name">Nama Buku</label>
                                    <input type="text" class="form-control" id="book_name" name="book_name"
                                        placeholder="Python For Beginner" value="{{ old('book_name') }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="publisher">Penerbit</label>
                                    <input type="text" class="form-control" id="publisher" name="publisher"
                                        placeholder="PT. Elex Media Komputindo" value="{{ old('publisher') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stok Buku</label>
                                    <input type="number" class="form-control" id="stock" name="stock" placeholder="1"
                                        value="{{ old('stock') }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="author">Penulis</label>
                                    <input type="text" class="form-control" id="author" name="author"
                                        placeholder="Suryadi" value="{{ old('author') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="lib_book_code">Kode Perpustakaan</label>
                                    <input type="varchar" class="form-control" id="lib_book_code" name="lib_book_code"
                                        placeholder="P.21.22.001" value="{{ old('lib_book_code') }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="isbn_issn">ISBN / ISSN</label>
                                    <input type="varchar" class="form-control" id="isbn_issn" name="isbn_issn"
                                        placeholder="978-602-8758-52-9" value="{{ old('isbn_issn') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="specialization" class="form-label">Peminatan</label> <br>
                                    <select class="selectpicker" name="spec_id" data-live-search="true" data-width="100%"
                                        data-size="6">
                                        @foreach ($specialization as $special)
                                            <option value="{{ $special->id }}"
                                                {{ old('spec_id') == $special->id ? 'selected' : '' }}>
                                                {{ $special->desc }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="specDetail" class="form-label">Detail Peminatan</label> <br>
                                    <select class="selectpicker" name="spec_detail_id" data-live-search="true"
                                        data-width="100%" data-size="6">
                                        @foreach ($specDetail as $s)
                                            <option value="{{ $s->id }}"
                                                {{ old('spec_detail_id') == $s->id ? 'selected' : '' }}>
                                                {{ $s->desc }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <label for="image">Gambar</label>
                                <img class="mb-2 img-fluid d-flex" id="img-preview" style="max-width: 200px">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image"
                                        onchange="previewImage()">
                                    <label class="custom-file-label" for="image">Choose file...</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="desc">Deskripsi</label>
                                    <textarea class="form-control" name="desc" id="desc" rows="3" placeholder="Buku ini membahas..."></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.getElementById('is_recommended').addEventListener('change', function() {
            // If the checkbox is checked, set the hidden input value to 1
            if (this.checked) {
                document.getElementById('is_recommended').value = 1;
            } else {
                document.getElementById('is_recommended').value = 0;
            }
        });

        // Get the custom file input element
        const customFileInput = document.getElementById('image');
        // Add event listener to update the label text with the selected file name
        customFileInput.addEventListener('change', function() {
            // Get the file name from the input value
            const fileName = this.value.split('\\').pop();
            // Update the label text with the file name
            const labelElement = this.nextElementSibling;
            labelElement.innerText = fileName;
        });

        function previewImage() {
            const image = document.getElementById('img-preview');
            image.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
@endsection
