@extends('mahasiswa.layouts.base')

@section('title', 'Dasbor')

@section('content')
    <div class="container-xl p-4 mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <a class="nav-link active ms-0" href="{{ route('user.profile', ['id' => Auth::id()]) }}"
                target="__blank">Profile</a>
            <a class="nav-link" href="#" target="__blank">Upload Tugas Akhir</a>
            <a class="nav-link" href="#" target="__blank">Upload Capstone</a>
        </nav>
        <hr class="mt-0 mb-4">

        <form enctype="multipart/form-data" method="POST" action="{{ route('user.profile.update', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Profile Picture</div>
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            @if ($user->profile_image)
                                <img class="img-account-profile rounded-2 mb-2" style="width: 100%"
                                    src="{{ asset('storage/profile/' . $user->profile_image) }}" alt=""
                                    id="profile_image">
                            @else
                                <img class="img-account-profile rounded-2 mb-2" style="width: 100%"
                                    src="{{ asset('assets/images/profile.png') }}" alt="" id="profile_image">
                            @endif
                            <!-- Profile picture help block-->
                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                            <!-- Profile picture upload button-->
                            <input type="file" class="btn btn-primary" id="profileImageInput" name="profile_image" onchange="previewImage(event)">
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Account Details</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="small mb-1" for="name">Nama Lengkap</label>
                                <input class="form-control" id="name" type="text" placeholder="Masukkan nama anda! "
                                    name="name" value="{{ $user->name }}">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="nim">NIM</label>
                                <input class="form-control" id="nim" type="text" placeholder="Masukkan nim anda"
                                    name="nim" value="{{ $user->nim }}">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="email">Email address</label>
                                <input class="form-control" id="email" type="email"
                                    placeholder="Masukkan email aktif anda" name="email" value="{{ $user->email }}">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="phone">Nomor Telepon (Whatsapp aktif)</label>
                                <input class="form-control" id="phone" type="text"
                                    placeholder="Masukkan no handphone (Whatsapp)" name="phone"
                                    value="{{ $user->phone }}">
                            </div>
                            <div class="mb-3 form-row">
                                <button class="btn btn-primary" type="submit" onclick="confirmEditForm(event)">Save
                                    changes</button>
                                <button class="btn btn-danger" type="button">Reset Password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection



@section('js')
    <script>
        function confirmEditForm(event) {
            event.preventDefault(); // Prevent default form submission

            Swal.fire({
                title: 'Simpan perubahan?',
                text: 'Data Buku akan diperbarui.',
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
        function previewImage() {
            const image = document.getElementById('profile_image');
            image.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>

@endsection
