@extends('admin.layouts.base')

@section('title', 'Edit Buku')

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

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Buku</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" method="POST" action="{{ route('admin.book.update', $books->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nama Buku</label>
                            <input type="text" class="form-control" id="book_name" name="book_name"
                                placeholder="Python For Beginner" value="{{ $books->book_name }}">
                        </div>
                        <div class="form-group">
                            <label for="publisher">Penerbit</label>
                            <input type="text" class="form-control" id="publisher" name="publisher"
                                placeholder="PT. Elex Media Komputindo" value="{{ $books->publisher }}">
                        </div>
                        <div class="form-group">
                            <label for="author">Penulis</label>
                            <input type="text" class="form-control" id="author" name="author" placeholder="Suryadi"
                                value="{{ $books->author }}">
                        </div>
                        <div class="mb-3">
                            <label for="specialization" class="form-label">Peminatan</label>
                            <select class="custom-select" name="spec_id">
                                @foreach ($specialization as $special)
                                    <option value="{{ $special->id }}"
                                        {{ $books->spec_id == $special->id ? 'selected' : '' }}>
                                        {{ $special->desc }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="specDetail" class="form-label">Detail Peminatan</label>
                            <select class="custom-select" name="spec_detail_id">
                                @foreach ($specDetails as $specDetail)
                                    <option value="{{ $specDetail->id }}"
                                        {{ $books->spec_detail_id == $specDetail->id ? 'selected' : '' }}>
                                        {{ $specDetail->desc }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="year_entry">Tahun Masuk</label>
                            <input type="number" class="form-control" id="year_entry" name="year_entry" placeholder="2023"
                                value="{{ $books->year_entry }}">
                        </div>
                        <div class="form-group">
                            <label for="isbn_issn">ISBN / ISSN</label>
                            <input type="varchar" class="form-control" id="isbn_issn" name="isbn_issn"
                                placeholder="978-602-8758-52-9" value="{{ $books->isbn_issn }}">
                        </div>
                        <div class="mb-3">
                            <label for="condition" class="form-label">Kondisi Buku</label>
                            <select class="custom-select" name="condition">
                                <option value="">Pilih Kondisi</option>
                                <option value="new" @selected($books->condition == 'new') @class(['bg-warning text-white' => $books->condition == 'new'])>BARU
                                </option>
                                <option value="used" @selected($books->condition == 'used') @class(['bg-warning text-white' => $books->condition == 'used'])>NORMAL
                                </option>
                                <option value="broken" @selected($books->condition == 'broken') @class(['bg-warning text-white' => $books->condition == 'broken'])>RUSAK
                                </option>
                            </select>
                        </div>
                        <div class="mb-2 form-check">
                            <input class="form-check-input" type="checkbox" id="is_recommended" name="is_recommended" value="1" 
                                @if ($books->is_recommended == 1) checked @endif>
                            <label class="form-check-label font-weight-bold" for="is_recommended">
                                Rekomendasi
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Ketersediaan</label>
                            <select class="custom-select" name="is_available">
                                <option value="1" {{ old('is_available') === '1' ? 'selected' : '' }}>Tersedia
                                </option>
                                <option value="0" {{ old('is_available') === '0' ? 'selected' : '' }}>Tidak Tersedia
                                </option>
                            </select>
                        </div>
                        <label for="image">Gambar</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image">
                            <label class="custom-file-label" for="image">Choose file...</label>
                        </div>
                        <!-- /.card-body -->
                    </div>
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

        document.getElementById('is_recommended').addEventListener('change', function() {
            // If the checkbox is checked, set the hidden input value to 1
            if (this.checked) {
                document.getElementById('is_recommended').value = 1;
            } else {
                document.getElementById('is_recommended').value = 0;
            }
        });
    </script>
@endsection
