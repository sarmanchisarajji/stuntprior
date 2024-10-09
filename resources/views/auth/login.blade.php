<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../../../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <link rel="shortcut icon" href="{{ url('') }}/assets/auth/assets/images/favicon-32x32.png">
    <title>Halaman Login | STUNTPRIOR</title>
    <link rel="stylesheet" href="{{ url('') }}/assets/auth/assets/css/dashlite.css?ver=3.1.2">
    <link id="skin-default" rel="stylesheet" href="{{ url('') }}/assets/auth/assets/css/theme.css?ver=3.1.2">
    <style>
        body {
            background-image: url('{{ url('') }}/assets/auth/assets/images/dinkes.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            position: relative;
            z-index: 1;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* background-color: rgba(255, 255, 255, 0.5); */
            background-color: rgba(0, 0, 0, 0.5);
            /* Overlay untuk meningkatkan kontras */
            z-index: -1;
        }

        .logo-link {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-img {
            width: auto;
            height: 120px;
            /* Ukuran logo yang lebih besar */
            /* filter: drop-shadow(0 0 5px rgba(0, 0, 0, 0.7)); */
        }

        h3 {
            font-size: 2rem;
            /* Ukuran teks yang lebih besar */
            color: #36eb60;
            margin-left: 8px;
            /* Jarak antara logo dan teks */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
        }

        .btn-success {
            background-color: #28a745;
            border: none;
            border-radius: 30px;
            transition: background-color 0.3s ease;
            padding: 10px 20px;
            font-size: 1.1rem;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        @media (max-width: 768px) {
            .logo-link {
                flex-direction: column;
            }

            h3 {
                margin-left: 0;
                margin-top: 10px;
            }
        }
    </style>
</head>

<body class="nk-body bg-white npc-general pg-auth">
    <div class="nk-app-root">
        <div class="nk-main">
            <div class="nk-wrap nk-wrap-nosidebar">
                <div class="nk-content">
                    <div class="nk-block nk-block-middle nk-auth-body wide-xs">
                        <div class="brand-logo mb-2 text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                <a href="/guest/dashboard" class="logo-link">
                                    <img class="logo-light logo-img logo-img-lg"
                                        src="{{ url('') }}/assets/auth/assets/images/stuntprior.png"
                                        srcset="{{ url('') }}/assets/auth/assets/images/stuntprior.png 2x"
                                        alt="logo">
                                    <img class="logo-dark logo-img logo-img-lg"
                                        src="{{ url('') }}/assets/auth/assets/images/stuntprior.png"
                                        srcset="{{ url('') }}/assets/auth/assets/images/stuntprior.png 2x"
                                        alt="logo-dark">
                                </a>
                                <h3 class="ml-3">STUNTPRIOR</h3>
                            </div>
                        </div>
                        <div class="card card-bordered">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Selamat Datang!</h4>
                                    </div>
                                </div>
                                <form action="{{ url('/login/auth') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Username</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg" id="default-01"
                                                placeholder="Username" name="username">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password">Password</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch lg"
                                                data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" class="form-control form-control-lg" id="password"
                                                placeholder="Password" name="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-success btn-block">Masuk</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ url('') }}/assets/auth/assets/js/bundle.js?ver=3.1.2"></script>
    <script src="{{ url('') }}/assets/auth/assets/js/scripts.js?ver=3.1.2"></script>
</body>

</html>
