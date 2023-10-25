@extends('admin.layouts.base')

@section('title', 'Buat Peminjaman')

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
                    <h3 class="card-title">Form Peminjaman Buku</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" method="POST" action="{{ route('admin.book.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="book_name">Nama Buku</label>
                            <input type="text" class="form-control" id="book_name" name="book_name"
                                placeholder="Python For Beginner" value="{{ old('book_name') }}">
                        </div>
                        <div class="form-group">
                            <label for="publisher">Nama Peminjam</label>
                            <input type="text" class="form-control" id="publisher" name="publisher"
                                placeholder="PT. Elex Media Komputindo" value="{{ old('publisher') }}">
                        </div>
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
    </script>
@endsection
