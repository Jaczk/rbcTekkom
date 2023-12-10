@extends('admin.layouts.base')

@section('title', 'Buat Peminjaman')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Peminjaman Buku</h3>
                </div>
                @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" method="POST" action="{{ route('admin.loans.QRstore') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="book_name">Kode Perpus</label> <br>
                            <input type="text" name="lib_book_code" id="lib_book_code">
                        </div>
                        <div class="form-group">
                            <label for="publisher">Nama Peminjam</label> <br>
                            <select name="user_id" class="selectpicker" id="user_id" data-live-search="true"
                                data-width="50%" data-size="6">
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

    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("lib_book_code").focus();
        });
    </script> --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("lib_book_code").focus();
            var libBookCodeInput = document.getElementById("lib_book_code");
    
            libBookCodeInput.addEventListener("input", function () {
                // Disable the input field after 12 characters
                if (libBookCodeInput.value.trim().length >= 8) {
                    libBookCodeInput.readOnly = true;
                }
            });
    
            // Prevent form submission when Enter key is pressed
            $("#lib_book_code").keypress(function (e) {
                if (e.which === 13) {
                    e.preventDefault();
                }
            });
        });
    </script>


@endsection
