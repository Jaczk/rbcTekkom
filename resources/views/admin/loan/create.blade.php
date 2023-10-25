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
                <form enctype="multipart/form-data" method="POST" action="{{ route('admin.loans.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="book_name">Nama Buku</label> <br>
                            <select name="book_id" class="selectpicker" id="book_id" data-live-search="true"
                                data-width="75%" data-size="6">
                                @foreach ($bookDrops as $book)
                                    <option value="{{ $book->id }}">
                                        {{ old('book_id') == $book->id ? 'selected' : '' }}
                                        {{ $book->book_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="publisher">Nama Peminjam</label> <br>
                            <select name="user_id" class="selectpicker" id="user_id" data-live-search="true"
                                data-width="75%" data-size="6">
                                @foreach ($userDrops as $user)
                                    <option value="{{ $user->id }}">
                                        {{ old('user_id') == $user->id ? 'selected' : '' }}
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
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

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
@endsection
