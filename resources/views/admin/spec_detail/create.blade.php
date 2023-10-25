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
                <h3 class="card-title">Tambah Detail Peminatan</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form enctype="multipart/form-data" method="POST" action="{{ route('admin.specDetail.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Kode Detail Peminatan</label>
                        <input type="text" class="form-control" id="spec_detail_id" name="spec_detail_id"
                            placeholder="01" value="{{ old('spec_detail_id') }}">
                    </div>
                    <div class="form-group">
                        <label for="title">Deskripsi Detail Peminatan</label>
                        <input type="text" class="form-control" id="desc" name="desc"
                            placeholder="Linux" value="{{ old('desc') }}">
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
