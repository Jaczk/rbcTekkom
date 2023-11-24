@extends('admin.layouts.base')

@section('title', 'Galeri')

@section('content')
    <div class="row">
        <div class="col-md-6">

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
                    <h3 class="card-title">Edit Galeri</h3>
                </div>
                <form enctype="multipart/form-data" method="POST" action="{{ route('admin.facility.gallery.update', $gallery->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Caption</label>
                            <input type="text" class="form-control" id="caption" name="caption"
                                placeholder="Ruang Baca" value="{{ $gallery->caption }}">
                        </div>
                        <div class="form-group">
                            <label for="title">Foto Galeri</label>
                            <img class="mb-2 img-fluid d-flex" id="img-preview" style="max-width: 200px">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image"
                                    onchange="previewImage()">
                                <label class="custom-file-label" for="image">Choose file...</label>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" onclick="confirmEditForm(event)" >Simpan</button>
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
                text: 'Data akan diperbarui.',
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

        function previewImage() {
            const image = document.getElementById('img-preview');
            image.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
