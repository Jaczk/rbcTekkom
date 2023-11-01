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
                height: 70%;
            }
        }
    </style>
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
                            <h3 class="mb-0 text-dark">Ruang Baca Departemen Teknik Komputer</h3>
                            <h5 class="mb-0 text-dark">Universitas Diponegoro</h5>
                        </div>
                    </div>
                    <div class="px-5 mt-5 d-flex justify-content-center h-custom-2">
                        <form style="width: 23rem;" action="{{ route('login.auth') }}" method="post">
                            @csrf
                            <h3 class="pb-3 mb-3 fw-normal" style="letter-spacing: 1px;">Log in</h3>
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
                                <input name="email" type="email" class="form-control form-control-lg"
                                    value="{{ old('email') }}" />
                                <label class="form-label">Email address</label>
                            </div>
                            <div class="mb-4 form-outline">
                                <input name="password" type="password" class="form-control form-control-lg"
                                    value="{{ old('password') }}" />
                                <label class="form-label">Password</label>
                            </div>
                            <div class="pt-1 mb-4">
                                <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                            </div>
                            <p>Tidak memiliki akun ? <a href="{{ route('register') }}" class="link-secondary">Daftar
                                    disini</a></p>
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
