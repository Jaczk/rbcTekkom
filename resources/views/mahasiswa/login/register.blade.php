<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet" />
    <style>
        .bg-image-vertical {
            position: relative;
            overflow: hidden;
            background-repeat: no-repeat;
            background-position: right center;
            background-size: auto 100%;
        }

        @media (min-width: 1025px) {
            .h-custom-2 {
                height: 100%;
            }
        }

        @media (min-width: 1000px) {
            .h-custom-2 {
                height: 60%;
            }
        }

        .password-meter {
            display: flex;
            height: 5px;
            margin-top: 10px;
        }

        .meter-section {
            flex: 1;
            background-color: #ddd;
        }

        .weak {
            background-color: #ff4d4d;
        }

        .medium {
            background-color: #ffd633;
        }

        .strong {
            background-color: #00b300;
        }

        .very-strong {
            background-color: #009900;
        }
    </style>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'>
    <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js'></script>
</head>

<body>
    <section class="vh-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <img src="https://images.unsplash.com/photo-1585779034823-7e9ac8faec70?auto=format&fit=crop&q=80&w=1935&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
                </div>                

                <div class="col-md-6">
                    <div class="px-5 mt-5 d-flex justify-content-center align-items-center">
                        <img src="{{ asset('assets/images/himaskom.png') }}" class="mx-4" alt="logo ndip" style="max-width: 100px">
                        <div>
                            <h3 class="mb-0">Ruang Baca Departemen Teknik Komputer</h3>
                            <h5 class="mb-0">Universitas Diponegoro</h5>
                        </div>
                    </div>

                    <div class="px-5 mt-5 d-flex justify-content-center h-custom-2">
                        <form style="width: 23rem;" action="{{ route('register.store') }}" method="post">
                            @csrf
                            <h3 class="pb-3 mb-3 fw-normal" style="letter-spacing: 1px;">Register</h3>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="mb-4 form-outline">
                                <input name="name" type="text" class="form-control form-control-lg"
                                    value="{{ old('name') }}" placeholder="Masukkan nama lengkap anda" />
                                <label class="form-label">Nama</label>
                            </div>
                            <div class="mb-4 form-outline">
                                <input name="email" type="email" class="form-control form-control-lg"
                                    value="{{ old('email') }}" placeholder="Masukkan email yang ingin didaftarkan" />
                                <label class="form-label">Email</label>
                            </div>
                            <div class="mb-4 form-outline">
                                <input name="nim" type="text" class="form-control form-control-lg"
                                    value="{{ old('nim') }}" placeholder="Masukkan NIM/NIP anda" />
                                <label class="form-label">NIM/NIP</label>
                            </div>

                            <div class="mb-4 form-outline">
                                <input name="phone" type="text" class="form-control form-control-lg"
                                    value="{{ old('phone') }}" placeholder="+628123456789" />
                                <label class="form-label">Nomor Telepon</label>
                            </div>

                            <div class="form-outline">
                                <input name="password" type="password" id="password-input"
                                    class="form-control form-control-lg" value="{{ old('password') }}"
                                    placeholder="Masukkan kata sandi" autocomplete="off" aria-autocomplete="list"
                                    aria-label="Password" aria-describedby="passwordHelp" />
                                <label class="form-label">Password</label>
                            </div>
                            <div class="password-meter">
                                <div class="rounded meter-section me-2"></div>
                                <div class="rounded meter-section me-2"></div>
                                <div class="rounded meter-section me-2"></div>
                                <div class="rounded meter-section"></div>
                            </div>
                            <div id="passwordHelp" class="form-text text-muted">Use 8 or more characters with a mix of
                                letters, numbers &
                                symbols.
                            </div>
                            <div class="pt-1 mb-4">
                                <button class="btn btn-dark btn-lg btn-block" type="submit">register</button>
                            </div>
                            {{-- <p class="mb-5 small pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a></p> --}}
                            <a href="{{ route('login') }}" class="link-dark">Kembali ke halaman login</a>

                        </form>

                    </div>

                </div>
            </div>
        </div>
    </section>
</body>

</html>

<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>

<script>
    const passwordInput = document.getElementById('password-input');
    const meterSections = document.querySelectorAll('.meter-section');

    passwordInput.addEventListener('input', updateMeter);

    function updateMeter() {
        const password = passwordInput.value;
        let strength = calculatePasswordStrength(password);

        // Remove all strength classes
        meterSections.forEach((section) => {
            section.classList.remove('weak', 'medium', 'strong', 'very-strong');
        });

        // Add the appropriate strength class based on the strength value
        if (strength >= 1) {
            meterSections[0].classList.add('weak');
        }
        if (strength >= 2) {
            meterSections[1].classList.add('medium');
        }
        if (strength >= 3) {
            meterSections[2].classList.add('strong');
        }
        if (strength >= 4) {
            meterSections[3].classList.add('very-strong');
        }
    }

    function calculatePasswordStrength(password) {
        const length = password.length;

        // Initialize the strength as 0
        let strength = 0;

        // Define rules for a stronger password based on your requirements
        if (length >= 8) {
            strength++;
        }
        if (length >= 12) {
            strength++;
        }
        if (/[A-Z]/.test(password) && /[a-z]/.test(password)) {
            strength++;
        }
        if (/\d/.test(password)) {
            strength++;
        }
        if (/[^A-Za-z0-9]/.test(password)) {
            strength++;
        }

        return strength;
    }
</script>
