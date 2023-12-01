@extends('admin.layouts.base')

@section('title', 'Edit Peminatan')

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
                    <h3 class="card-title">Edit Data Dosen</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" method="POST"
                    action="{{ route('admin.lecturer.update', $lecturer->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Nama Dosen</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="{{ old('name') }}" value="{{ $lecturer->name }}">
                        </div>
                        <div class="form-group">
                            <label for="title">NIP</label>
                            <input type="number" class="form-control" id="nip" name="nip"
                                placeholder="{{ old('nip') }}" value="{{ $lecturer->nip }}">
                        </div>
                        <div class="form-group">
                            <label for="title">URL Profil Dosen</label>
                            <input type="text" class="form-control" id="image" name="image"
                                placeholder="{{ old('image') }}" value="{{ $lecturer->image }}">
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
        function confirmEditForm(event) {
            event.preventDefault(); // Prevent default form submission

            Swal.fire({
                title: 'Simpan perubahan?',
                text: 'Data Dosen akan diperbarui.',
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
@endsection
