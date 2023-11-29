@extends('admin.layouts.base')

@section('title', 'Edit Buku Sumbangan')

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
                    <h3 class="card-title">Edit Buku Sumbangan</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" method="POST" action="{{ route('admin.donate.update', $donate->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="book_name">Nama Buku</label>
                                    <input type="text" class="form-control" id="book_name" name="book_name"
                                        placeholder="Python For Beginner" value="{{ $donate->book_name }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="title">Harga</label>
                                    <input type="number" class="form-control" id="price" name="price"
                                        placeholder="Harga buku dalam satuan ribuan rupiah. (contoh: 5000)"
                                        value="{{ $donate->price }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="publisher">Penerbit</label>
                                    <input type="text" class="form-control" id="publisher" name="publisher"
                                        placeholder="PT. Elex Media Komputindo" value="{{ $donate->publisher }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="author">Penulis</label>
                                    <input type="text" class="form-control" id="author" name="author"
                                        placeholder="Suryadi" value="{{ $donate->author }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2 form-check mt-4 form-group">
                                    <input type="hidden" name="is_fav" id="is_fav_hidden" value="{{ $donate->is_fav }}">
                                    <input class="form-check-input" type="checkbox" id="is_fav" name="is_fav" value="1"
                                           @if ($donate->is_fav == 1) checked @endif>
                                    <label class="form-check-label font-weight-bold" for="is_fav">
                                        Apakah Favorit?
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="image">Gambar</label>
                                <img class="img-fluid mb-2 d-flex" id="img-preview" style="max-width: 200px">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image"
                                        onchange="previewImage()">
                                    <label class="custom-file-label" for="image">Choose file...</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="isbn_issn">Deskripsi</label>
                                    <textarea class="form-control" name="desc" id="desc" rows="3" placeholder="Buku ini membahas...">{{ $donate->desc }}</textarea>
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
        // Preview Image
        function previewImage() {
            const image = document.getElementById('img-preview');
            image.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        document.getElementById('is_fav').addEventListener('change', function() {
            // If the checkbox is checked, set the hidden input value to 1
            if (this.checked) {
                document.getElementById('is_fav_hidden').value = 1;
            } else {
                document.getElementById('is_fav_hidden').value = 0;
            }
        });
    </script>
    
@endsection
