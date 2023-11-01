{{-- Navbar --}}
<nav class="navbar sticky-top navbar-expand-lg  navbar-light nav">
    <a class="navbar-brand" href="/">
        <img src="{{ asset('/assets/images/logo.png') }}">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"
        style="background-color: #FDFDFF">
        <span class="navbar-toggler-icon "></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <div class="dropdown">
                <li class="nav-item dropdown"><button class="dropbtn"> <span style="white-space:nowrap"> PROFIL <label
                                class="arrow_down"></label></span></button></li>
                <div class="dropdown-content">
                    <a class="nav-link" href="#">Pustakawan</a>
                    <a class="nav-link" href="#">Visi & Misi</a>
                    <a class="nav-link" href="#">Jam Layanan </a>
                </div>
            </div>
            <div class="dropdown">
                <li class="nav-item dropdown"> <button class="dropbtn"><span style="white-space:nowrap">KOLEKSI <label
                                class="arrow_down"></label></span></button> </li>
                <div class="dropdown-content">
                    <a class="nav-link" aria-current="page" href="/buku">Koleksi Tercetak</a>
                    <a class="nav-link" href="#">Tugas Akhir Digital</a>
                    <a class="nav-link" href="#">Kerja Praktek Digital</a>
                    <a class="nav-link" href="#">Karya Dosen Terindeks Scopus</a>
                </div>
            </div>
            <div class="dropdown">
                <li class="nav-item dropdown"> <button class="dropbtn"><span style="white-space:nowrap">FASILITAS<label
                                class="arrow_down"></label></span></button> </li>
                <div class="dropdown-content">
                    <a class="nav-link" href="#">Ruang Baca</a>
                    <a class="nav-link" href="#">Mobile App</a>
                    <a class="nav-link" href="#">TaTa Tertib</a>
                </div>
            </div>
            <li class="nav-item dropbtn"> <a href="/faq">FAQ</a> </li>
            <button class="btn-primary float-right btn-login" type="submit" href="/">Login</button>
        </ul>

    </div>
</nav>
