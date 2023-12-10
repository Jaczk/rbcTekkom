@extends('admin.layouts.base')

@section('title', 'Shift')

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

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card card-primary">
                <div class="card-header" style="background-color: #6998AB">
                    <h3 class="card-title">Perbarui Jam Layanan</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" method="POST" action="{{ route('admin.shift.updateTime') }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="title">Hari</label>
                                    <input type="text" class="form-control" id="day" name="day"
                                        placeholder="Senin" value="{{ $shift->day }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="title">Jam Layanan Shift 1</label>
                                    <input type="text" class="form-control" id="s1" name="s1"
                                        placeholder="Jam Layanan Pustakawan Shift 1" value="{{ $shift->s1 }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="title">Jam Layanan Shift 2</label>
                                    <input type="text" class="form-control" id="s2" name="s2"
                                        placeholder="Jam Layanan Shift 2" value="{{ $shift->s2 }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="title">Jam Layanan Shift 3</label>
                                    <input type="text" class="form-control" id="s3" name="s3"
                                        placeholder="Jam Layanan Shift 3" value="{{ $shift->s3 }}">
                                </div>
                            </div>
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
                text: 'Jam Layanan akan diperbarui.',
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
