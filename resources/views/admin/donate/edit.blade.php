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

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tambah Buku</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" method="POST" action="{{ route('admin.donate.update', $donates->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="book_name">Nama Buku</label>
                            <input type="text" class="form-control" id="book_name" name="book_name"
                                placeholder="Python For Beginner" value="{{ $donates->book_name }}">
                        </div>
                        <div class="form-group">
                            <label for="title">Harga</label>
                            <input type="number" class="form-control" id="price" name="price"
                                placeholder="Harga buku" value="{{ $donates->price }}">
                            <p class="font-italic text-bold">
                                Harga buku dalam satuan ribuan rupiah. (contoh: 5000)
                            </p>
                        </div>
                        <div class="form-group">
                            <label for="publisher">Penerbit</label>
                            <input type="text" class="form-control" id="publisher" name="publisher"
                                placeholder="PT. Elex Media Komputindo" value="{{ $donates->publisher }}">
                        </div>
                        <div class="form-group">
                            <label for="author">Penulis</label>
                            <input type="text" class="form-control" id="author" name="author" placeholder="Suryadi"
                                value="{{ $donates->author }}">
                        </div>
                        <div class="form-group">
                            <label for="isbn_issn">Deskripsi</label>
                            <input type="varchar" class="form-control" id="desc" name="desc"
                                placeholder="Buku ini membahas..." value="{{ $donates->desc}}">
                        </div>
                        <label for="image">Gambar</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image">
                            <label class="custom-file-label" for="image">Choose file...</label>
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
    </script>
@endsection
