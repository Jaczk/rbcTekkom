@extends('mahasiswa.layouts.base')

@section('title', 'Profil')

@section('content')
    <div class="container-xl p-4 mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <a class="nav-link active ms-0" href="{{ route('user.profile', ['id' => Auth::id()]) }}"
                target="__blank">Profile</a>
            <a class="nav-link" href="{{ route('user.profile.theses', ['id' => Auth::id()]) }}" target="__blank">
                Upload Tugas Akhir</a>
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
                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 2 MB</div>
                            <!-- Profile picture upload button-->
                            <input type="file" class="btn btn-primary" id="profileImageInput" name="profile_image"
                                onchange="previewImage(event)">
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Detail Akun</div>
                        <div class="card-body">
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

                            @if (session()->has('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="mb-3">
                                <label class="small mb-1" for="name">Username</label>
                                <input class="form-control" id="name" type="text" placeholder="Masukkan username anda "
                                    name="name" value="{{ $user->name }}">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="full_name">Nama Lengkap</label>
                                <input class="form-control" id="full_name" type="text" placeholder="Masukkan nama lengkap anda! "
                                    name="full_name" value="{{ $user->full_name }}">
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
                            <div class="mb-3">
                                <label for="ktm_image">Upload Foto KTM</label>
                                <img src="{{ asset('storage/ktm/' . $user->ktm_image) }}" id="ktm-image" alt=""
                                    class="mb-2 img-fluid d-flex" style="width: 250px">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="" name="ktm_image"
                                        onchange="previewktm_image()">
                                    {{-- <label class="custom-file-label" for="ktm_image"></label> --}}
                                </div>
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
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-info">
                    <div class="card-header">Riwayat Upload Tugas Akhir</div>
                    <div class="card-body">
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

                        @if (session()->has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <table class="table table-striped table-hover" id="theses">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Judul Tugas Akhir</th>
                                    <th>Nama Penulis</th>
                                    <th>Pembimbing 1</th>
                                    <th>Pembimbing 2</th>
                                    <th>Tahun</th>
                                    <th>File 1</th>
                                    <th>File 2</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($theses as $t)
                                    <tr>
                                        <td>
                                        </td>
                                        <td>{{ $t->thesis_name }}</td>
                                        <td>{{ $t->user->full_name }}</td>
                                        <td>{{ $t->lecturer_1 }}</td>
                                        <td>{{ $t->lecturer_2 }}</td>
                                        <td>{{ $t->year }}</td>
                                        <td>
                                            <a href="{{ asset('storage/pdf-1/' . $t->file_1) }}"
                                                target="_blank">{{ $t->file_1 }}</a>
                                        </td>

                                        <td><a href="{{ asset('storage/pdf-2/' . $t->file_2) }}"
                                            target="_blank">{{ $t->file_2 }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
                text: 'Profil akan diperbarui.',
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

        // Get the custom file input element
        const customFileInput = document.getElementById('ktm_image');
        // Add event listener to update the label text with the selected file name
        customFileInput.addEventListener('change', function() {
            // Get the file name from the input value
            const fileName = this.value.split('\\').pop();
            // Update the label text with the file name
            const labelElement = this.nextElementSibling;
            labelElement.innerText = fileName;
        });

        function previewktm_image() {
            const image = document.getElementById('ktm-image');
            image.src = URL.createObjectURL(event.target.files[0]);
        }

        $(document).ready(function() {
            var table = $('#theses').DataTable();
        });
    </script>

@endsection
