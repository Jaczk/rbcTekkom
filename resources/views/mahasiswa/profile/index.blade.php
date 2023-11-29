@extends('mahasiswa.layouts.base')

@section('title', 'Profil')

@section('content')
    <div class="container-xl p-4 mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <a class="nav-link active ms-0" href="{{ route('user.profile') }}" target="__blank">Profile</a>
            <a class="nav-link" href="{{ route('user.profile.theses') }}" target="__blank">
                Upload Tugas Akhir</a>
            <a class="nav-link" href="{{ route('user.profile.capstone') }}" target="__blank">Upload Capstone</a>
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
                                <input class="form-control" id="name" type="text"
                                    placeholder="Masukkan username anda " name="name" value="{{ $user->name }}">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="full_name">Nama Lengkap</label>
                                <input class="form-control" id="full_name" type="text"
                                    placeholder="Masukkan nama lengkap anda! " name="full_name"
                                    value="{{ $user->full_name }}">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="nim">NIM</label>
                                <input class="form-control" id="nim" type="text" placeholder="Masukkan nim anda"
                                    name="nim" value="{{ $user->nim }}">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="email">Email</label>
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
        {{-- Alert w/ session --}}
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
        @endif
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
                                    <th>Aksi</th>
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
                                            <a href="{{ asset('storage/pdf-1/' . $t->file_1) }}" target="_blank"><i
                                                    class="fa-regular fa-file"></i></a>
                                        </td>

                                        <td><a href="{{ asset('storage/pdf-2/' . $t->file_2) }}" target="_blank"><i
                                                    class="fa-regular fa-file"></i></a>
                                        </td>
                                        <td>
                                            <div class="flex-row d-flex">
                                                <a href="{{ route('user.profile.theses.edit', Crypt::encryptString($t->id)) }}"
                                                    class="btn btn-secondary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form method="post"
                                                    action="{{ route('user.profile.theses.destroy', $t->id) }}">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="mx-1 btn btn-danger delete-btn">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <hr class="mt-4 mb-4">
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-info">
                    <div class="card-header">Riwayat Upload Capstone</div>
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
                        <table class="table table-striped table-hover" id="capstone">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Judul Capstone</th>
                                    <th>Kelompok</th>
                                    <th>Pembimbing 1</th>
                                    <th>Pembimbing 2</th>
                                    <th>Tahun</th>
                                    <th>c100</th>
                                    <th>c200</th>
                                    <th>c300</th>
                                    <th>c400</th>
                                    <th>c500</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($capstone as $t)
                                    <tr>
                                        <td>
                                        </td>
                                        <td>{{ $t->capstone_title }}</td>
                                        <td>{{ $t->team_name }}</td>
                                        <td>{{ $t->lecturer_1 }}</td>
                                        <td>{{ $t->lecturer_2 }}</td>
                                        <td>{{ $t->year }}</td>
                                        <td><a href="{{ asset('storage/c100/' . $t->c100) }}" target="_blank"><i
                                                    class="fa-regular fa-file"></i></a>
                                        </td>
                                        <td><a href="{{ asset('storage/c200/' . $t->c200) }}" target="_blank"><i
                                                    class="fa-regular fa-file"></i>
                                        </td>
                                        <td><a href="{{ asset('storage/c300/' . $t->c300) }}" target="_blank"><i
                                                    class="fa-regular fa-file"></i>
                                        </td>
                                        <td><a href="{{ asset('storage/c400/' . $t->c400) }}" target="_blank"><i
                                                    class="fa-regular fa-file"></i>
                                        </td>
                                        <td><a href="{{ asset('storage/c500/' . $t->c500) }}" target="_blank"><i
                                                    class="fa-regular fa-file"></i>
                                        </td>
                                        <td>
                                            <div class="flex-row d-flex">
                                                <a href="{{ route('user.profile.capstone.edit', Crypt::encryptString($t->id)) }}"
                                                    class="btn btn-secondary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form method="post"
                                                    action="{{ route('user.profile.capstone.destroy', $t->id) }}">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="mx-1 btn btn-danger delete-btn">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
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
        $('textarea').val($('textarea').val().trim());
    </script>
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#theses').DataTable();
            table
                .on('order.dt search.dt', function() {
                    var i = 1;

                    table
                        .cells(null, 0, {
                            search: 'applied',
                            order: 'applied'
                        })
                        .every(function(cell) {
                            this.data(i++);
                        });
                })
                .draw();


            // Apply event listener to all delete buttons
            $('#theses').on('click', '.delete-btn', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');

                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: 'Data TA akan dihapus dari tabel!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e31231',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus item!',
                    cancelButtonText: 'Kembali'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form after confirmation
                        form.submit();
                    }
                });
            });
        });
        //-------------
    </script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable for #theses
            var tableTheses = $('#theses').DataTable();
            tableTheses
                .on('order.dt search.dt', function() {
                    var i = 1;

                    tableTheses
                        .cells(null, 0, {
                            search: 'applied',
                            order: 'applied'
                        })
                        .every(function(cell) {
                            this.data(i++);
                        });
                })
                .draw();

            // Initialize DataTable for #capstone
            var tableCapstone = $('#capstone').DataTable();
            tableCapstone
                .on('order.dt search.dt', function() {
                    var i = 1;

                    tableCapstone
                        .cells(null, 0, {
                            search: 'applied',
                            order: 'applied'
                        })
                        .every(function(cell) {
                            this.data(i++);
                        });
                })
                .draw();

            // Apply event listener to delete buttons for both tables
            $('#theses, #capstone').on('click', '.delete-btn', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');

                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: 'Data Tugas Akhir akan dihapus dari tabel!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e31231',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus item!',
                    cancelButtonText: 'Kembali'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form after confirmation
                        form.submit();
                    }
                });
            });
        });
    </script>

    <script>
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
    </script>

@endsection
