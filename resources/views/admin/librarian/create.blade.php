@extends('admin.layouts.base')

@section('title', 'Tambah Pustakawan')

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
                    <h3 class="card-title">Tambah Pustakawan</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" method="POST" action="{{ route('admin.librarian.store') }}">
                    @csrf
                    <div class="card-body">

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Nama Pustakawan</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Dimas Kaiba" value="{{ old('name') }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="nim">NIM</label>
                                    <input type="text" class="form-control" id="nim" name="nim"
                                        placeholder="21120119130073" value="{{ old('nim') }}">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="year">Angkatan</label>
                                    <input type="number" class="form-control" id="year" name="year"
                                        placeholder="2021"
                                        value="{{ old('year') }}">
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
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
@endsection
