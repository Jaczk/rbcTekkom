<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #121F3E">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-normal" style="color: #f89223">
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
                <a href="#" class="d-block">Admin</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dasbor
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.book') }}" class="nav-link">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Buku
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.special') }}" class="nav-link">
                        <i class="nav-icon fas fa-laptop-house"></i>
                        <p>
                            Daftar Spesialisasi
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.specDetail') }}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Daftar Detail Spesialisasi
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.loans') }}" class="nav-link">
                        <i class="nav-icon fas fa-people-carry"></i>
                        <p>
                            Peminjaman
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.publisher') }}" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Daftar Penerbit
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.donate') }}" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Daftar Buku Sumbangan
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.user') }}" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Daftar Pengguna
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.fine.edit') }}" class="nav-link">
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
                    <a href="#" class="nav-link" onclick="confirmLogout(event)">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Keluar
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
            text: 'Keluar',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Keluar',
            cancelButtonText: 'Kembali',
        }).then((result) => {
            if (result.isConfirmed) {
                // User confirmed, redirect to the logout route
                window.location.href = "{{ route('admin.logout') }}";
            }
        });
    }
</script>