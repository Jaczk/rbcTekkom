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
    </style>
</head>

<body>
    <section class="vh-100">
        <div class="container-fluid">
            <div class="row">
                <div class="text-black col-sm-6">

                    <div class="px-5 ms-xl-4">
                        <i class="pt-5 fas fa-crow fa-2x me-3 mt-xl-4" style="color: #709085;"></i>
                        <span class="mb-0 h1 fw-bold">Logo</span>
                    </div>

                    <div class="px-5 pt-5 mt-5 d-flex align-items-center h-custom-2 ms-xl-4 pt-xl-0 mt-xl-n5">

                        <form style="width: 23rem;">

                            <h3 class="pb-3 mb-3 fw-normal" style="letter-spacing: 1px;">Log in</h3>

                            <div class="mb-4 form-outline">
                                <input type="email" id="form2Example18" class="form-control form-control-lg" />
                                <label class="form-label" for="form2Example18">Email address</label>
                            </div>

                            <div class="mb-4 form-outline">
                                <input type="password" id="form2Example28" class="form-control form-control-lg" />
                                <label class="form-label" for="form2Example28">Password</label>
                            </div>

                            <div class="pt-1 mb-4">
                                <button class="btn btn-info btn-lg btn-block" type="button">Login</button>
                            </div>

                            <p class="mb-5 small pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a></p>
                            <p>Don't have an account? <a href="#!" class="link-info">Register here</a></p>

                        </form>

                    </div>

                </div>
                <div class="px-0 col-sm-6 d-none d-sm-block">
                    <img src="https://images.unsplash.com/photo-1568667256549-094345857637?auto=format&fit=crop&q=80&w=1915&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
                </div>
            </div>
        </div>
    </section>
</body>

</html>

<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>
