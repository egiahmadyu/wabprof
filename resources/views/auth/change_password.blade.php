<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Sign In | DMS WABPROF</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Minimal Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/icon/Wabprof.ico') }}">

    <!-- Layout config Js -->
    <script src="{{ asset('assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<body>

    <section class="auth-bg-cover min-vh-100 p-4 p-lg-5 d-flex align-items-center justify-content-center">
        <div class="bg-overlay"></div>
        <div class="container-fluid px-0">
            <div class="row g-0">
                <div class="col-xl-8 col-lg-6">
                    <div class="h-100 mb-0 p-4 d-flex flex-column justify-content-between">
                        {{-- <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <img src="assets/images/logo-light-full.png" alt="" height="32" />
                            </div>
                        </div> --}}

                        {{-- <div class="text-white mt-4">
                            <p class="mb-0">&copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> Hybrix. Crafted with <i class="mdi mdi-heart text-danger"></i>
                                by Themesbrand
                            </p>
                        </div> --}}
                    </div>
                </div>
                <!--end col-->
                <div class="col-xl-4 col-lg-6">
                    <div class="card mb-0" style="opacity: 0.9;">

                        <div class="card-body p-3 p-sm-5 m-lg-2">
                            <div class="text-center">
                                <img width="40%" src="{{ asset('assets/images/logo/wabprof.png') }}" alt="">
                                <h5 class="text-primary fs-22">Welcome Back !</h5>
                                <p class="text-muted">Sign in to continue to Propam Integrated System.</p>
                            </div>
                            <div class="p-2 mt-3">
                                <form action="{{ route('reset.action') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" for="password-input">Password</label>
                                        <div class="position-relative auth-pass-inputgroup">
                                            <input type="password" class="form-control pe-5 password-input border-dark" onpaste="return false" placeholder="Enter password" id="password-input" aria-describedby="passwordInput" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="password" required>
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                        <div id="passwordInput" class="form-text">Password harus berisi 8-20 karakter.</div>
                                    </div>
                    
                                    <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                                        <h5 class="fs-13">Password harus berisi :</h5>
                                        <p id="pass-length" class="invalid fs-12 mb-2"> Minimal <b>8 karakter</b></p>
                                        <p id="pass-lower" class="invalid fs-12 mb-2"> Minimal huruf <b>kecil</b> (a-z)</p>
                                        <p id="pass-upper" class="invalid fs-12 mb-2"> Minimal huruf <b>kapital</b> (A-Z)</p>
                                        <p id="pass-number" class="invalid fs-12 mb-0"> Minimal ada <b>angka</b> (0-9)</p>
                                    </div>
                    
                                    <div class="mt-4">
                                        <button class="btn btn-primary w-100" type="submit">Reset Password</button>
                                    </div>
                                    
                                    
                                </form>
                                {{-- <div class="text-center mt-5">
                                    <p class="mb-0">Don't have an account ? <a href="auth-signup-cover.html"
                                            class="fw-semibold text-secondary text-decoration-underline"> SignUp</a>
                                    </p>
                                </div> --}}
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end conatiner-->
    </section>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/pages/passowrd-create.init.js') }}"></script>

    <script src="{{ asset('assets/js/pages/password-addon.init.js') }}"></script>

</body>

</html>
