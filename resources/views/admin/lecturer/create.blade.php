@extends('admin.layouts.base')

@section('title', 'Tambah Dosen')

@section('content')
<div class="row">
    <div class="col-md-6">
        {{-- Alert Here --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error )
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tambah Dosen</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form enctype="multipart/form-data" method="POST" action="{{ route('admin.lecturer.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Nama Dosen</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Nama Dosen" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="title">NIP</label>
                        <input type="number" class="form-control" id="nip" name="nip"
                            placeholder="123456789" value="{{ old('nip') }}">
                    </div>
                    <div class="form-group">
                        <label for="title">Link Profil Dosen</label>
                        <input type="text" class="form-control" id="image" name="image"
                            placeholder="URL Profil Dosen" value="{{ old('image') }}">
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
