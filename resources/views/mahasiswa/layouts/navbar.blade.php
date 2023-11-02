<nav class="p-3 navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #001349;">
    <div class="container-fluid">
        <img src="{{ asset('assets/images/logo.png') }}" height="45px" alt="">
        {{-- <a class="navbar-brand fw-bold" href="#">RBC Tekkom</a> --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class=" collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto ">
                <li class="nav-item dropdown">
                    <a class="mx-2 text-uppercase nav-link dropdown-toggle active fw-bold" href="#"
                        id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Profil
                    </a>
                    <ul class="mt-3 border-top border-info dropdown-menu border-3 rounded-0"
                        style="background-color: #001349;" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="fw-bold dropdown-item text-uppercase rounded-0" href="#">Pustakawan</a></li>
                        <li><a class="fw-bold dropdown-item text-uppercase rounded-0 " href="#">Visi Misi</a></li>
                        <li><a class="fw-bold dropdown-item text-uppercase rounded-0 " href="#">Jam Layanan</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="mx-2 text-uppercase nav-link dropdown-toggle active fw-bold rounded-0" href="#"
                        id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Koleksi
                    </a>
                    <ul class="mt-3 border-top border-info dropdown-menu border-3 rounded-0"
                        style="background-color: #001349;" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="fw-bold dropdown-item text-uppercase rounded-0 " href="#">Tugas Akhir Digital</a>
                        </li>
                        <li><a class="fw-bold dropdown-item text-uppercase rounded-0 " href="#">Kerja Praktek Digital</a>
                        </li>
                        <li><a class="fw-bold dropdown-item text-uppercase rounded-0 " href="#">Karya Dosen Terindeks
                                Scopus</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="mx-2 text-uppercase nav-link dropdown-toggle active fw-bold rounded-0" href="#"
                        id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Fasilitas
                    </a>
                    <ul class="mt-3 border-top border-info dropdown-menu border-3 rounded-0"
                        style="background-color: #001349;" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="fw-bold dropdown-item text-uppercase rounded-0 " href="#">Ruang Baca</a></li>
                        <li><a class="fw-bold dropdown-item text-uppercase rounded-0 " href="#">Tata Tertib</a></li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a class="mx-2 text-uppercase nav-link active fw-bold" href="#">FAQ</a>
                </li>

            </ul>
            <ul class="navbar-nav ms-auto d-none d-lg-inline-flex">
                <li class="mx-3 nav-item">
                    <a class="mx-2 text-uppercase nav-link active fw-bold" href="/login">Login</a>
                </li>
                <li class="nav-item">
                    <button type="button" class=" rounded-pill btn btn-light fw-bold fs-7">Get Started</button>
                </li>

            </ul>
        </div>
    </div>
</nav>
