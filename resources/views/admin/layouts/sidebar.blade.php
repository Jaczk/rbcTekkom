<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #1A374D">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle"
            style="opacity: .8">
        <span class="brand-text font-weight-semibold" style="color: #ffffff">
            Ruang Baca
            {{-- <img class ="w-50" src="{{ asset("images/perkantas.png") }}" alt=""> --}}
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="pb-3 mt-3 mb-3 user-panel d-flex">
            <div class="image">
                <img src="{{ asset('adminlte/dist/img/admin.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            {{-- <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div> --}}
            <div class="info">
                <a href="#" class="d-block" style="color: #ffffff;">Admin</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item {{ Route::is('admin.dashboard*') ? 'menu-open':'' }}">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link" style="color: #ffffff;">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dasbor
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.special*', 'admin.book*', 'admin.loans*', 'admin.donate*') ? 'menu-open' : 'menu-close' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book" style="color: #ffffff;"></i>
                        <p style="color: #ffffff;">
                            Buku RBC
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.special') }}" class="nav-link" style="color: #ffffff;">
                                <i class="far nav-icon {{ Route::is('admin.special*') ? 'fa-dot-circle': 'fa-circle' }}"></i>
                                <p>
                                    Kategori Peminatan
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.book') }}" class="nav-link" style="color: #ffffff;">
                                <i class="far nav-icon {{ Route::is('admin.book*') ? 'fa-dot-circle': 'fa-circle' }}"></i>
                                <p>
                                    Buku
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.loans') }}" class="nav-link" style="color: #ffffff;">
                                <i class="far nav-icon {{ Route::is('admin.loans*') ? 'fa-dot-circle': 'fa-circle' }}"></i>
                                <p>
                                    Peminjaman Buku
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.donate') }}" class="nav-link" style="color: #ffffff;">
                                <i class="far nav-icon {{ Route::is('admin.donate*') ? 'fa-dot-circle': 'fa-circle' }}"></i>
                                <p>
                                    Buku Sumbangan
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ Route::is('admin.shift*', 'admin.text*', 'admin.librarian*', 'admin.facility*') ? 'menu-open' : 'menu-close' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-edit" style="color: #ffffff;"></i>
                        <p style="color: #ffffff;">
                            Konten Website
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.shift') }}" class="nav-link" style="color: #ffffff;">
                                <i class="far nav-icon {{ Route::is('admin.shift*') ? 'fa-dot-circle': 'fa-circle' }}"></i>
                                <p>
                                    Shift Layanan
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.text') }}" class="nav-link" style="color: #ffffff;">
                                <i class="far nav-icon {{ Route::is('admin.text*') ? 'fa-dot-circle': 'fa-circle' }}"></i>
                                <p>
                                    Edit FAQ | Fasilitas | etc
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.facility.gallery') }}" class="nav-link" style="color: #ffffff;">
                                <i class="far nav-icon {{ Route::is('admin.facility*') ? 'fa-dot-circle': 'fa-circle' }}"></i>
                                <p>
                                    Fasilitas | Foto Galeri
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.librarian') }}" class="nav-link" style="color: #ffffff;">
                                <i class="far nav-icon {{ Route::is('admin.librarian*') ? 'fa-dot-circle': 'fa-circle' }}"></i>
                                <p>
                                    Pustakawan
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ Route::is('admin.theses*', 'admin.capstone*', 'admin.lecturer*') ? 'menu-open' : 'menu-close' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-graduate" style="color: #ffffff;"></i>
                        <p style="color: #ffffff;">
                            Capstone & TA
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.lecturer') }}" class="nav-link" style="color: #ffffff;">
                                <i class="far nav-icon {{ Route::is('admin.lecturer*') ? 'fa-dot-circle': 'fa-circle' }}"></i>
                                <p>
                                    Dosen
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.theses') }}" class="nav-link" style="color: #ffffff;">
                                <i class="far nav-icon {{ Route::is('admin.theses*') ? 'fa-dot-circle': 'fa-circle' }}"></i>
                                <p>
                                    Tugas Akhir
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.capstone') }}" class="nav-link" style="color: #ffffff;">
                                <i class="far nav-icon {{ Route::is('admin.capstone*') ? 'fa-dot-circle': 'fa-circle' }}"></i>
                                <p>
                                    Capstone
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Add a style attribute to change the text color -->
                <li class="nav-item {{ Route::is('admin.user*') ? 'menu-open':'' }}">
                    <a href="{{ route('admin.user') }}" class="nav-link" style="color: #ffffff;">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>
                            Pengguna
                        </p>
                    </a>
                </li>

                <li class="nav-item {{ Route::is('admin.fine*') ? 'menu-open':'' }}">
                    <a href="{{ route('admin.fine.edit') }}" class="nav-link" style="color: #ffffff;">
                        <i class="nav-icon fas fa-file-excel"></i>
                        <p>
                            Denda
                        </p>
                    </a>
                </li>

                <li class="cursor-default disabled">
                    <a href="#" class="cursor-default nav-link disabled">
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link" style="color: #ffffff;"
                        onclick="confirmLogout(event)">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<script>
    function confirmLogout(event) {
        event.preventDefault(); // Prevent default link behavior

        Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Logout',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Kembali',
        }).then((result) => {
            if (result.isConfirmed) {
                // User confirmed, redirect to the logout route
                window.location.href = "{{ route('logout') }}";
            }
        });
    }
</script>
