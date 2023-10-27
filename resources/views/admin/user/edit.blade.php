@extends('admin.layouts.base')

@section('title', 'Pengguna')

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
                    <h3 class="card-title">Edit Pengguna</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" method="POST" action="{{ route('admin.user.update', $user->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="status" class="form-label">Tipe Pengguna</label>
                            <select class="custom-select" name="role_id">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                        {{ $role->role_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title">Nomor Telepon Pengguna</label>
                            <input type="text" class="form-control" id="phone" name="phone" maxlength="15"
                                placeholder="contoh : +6281322224545" value="{{ $user->phone }}" required>
                            <span id="phone-error" class="text-danger text-bold"></span>
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
        $(document).ready(function() {
            $('#phone').on('input', function() {
                var phone = $(this).val();
                var pattern = /^\+62\d{0,}$/;
                var isValid = pattern.test(phone);

                if (!isValid) {
                    $('#phone-error').text('Nomor telepon tidak valid');
                } else {
                    $('#phone-error').text('');
                }
            });
        });
    </script>
@endsection
