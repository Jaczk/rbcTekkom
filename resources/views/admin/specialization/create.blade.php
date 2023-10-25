@extends('admin.layouts.base')

@section('title', 'Tambah Peminatan')

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
                <h3 class="card-title">Tambah Peminatan</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form enctype="multipart/form-data" method="POST" action="{{ route('admin.special.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Kode Peminatan</label>
                        <input type="text" class="form-control" id="spec_char" name="spec_char"
                            placeholder="P" value="{{ old('spec_char') }}">
                    </div>
                    <div class="form-group">
                        <label for="title">Deskripsi Peminatan</label>
                        <input type="text" class="form-control" id="desc" name="desc"
                            placeholder="Pemrograman" value="{{ old('desc') }}">
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
