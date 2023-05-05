<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LionSoft</title>

    <link href="{{asset("/vendor/bootstrap5/bootstrap.css")}}" rel="stylesheet">
    <link href="{{asset("/vendor/sweetalert2/dist/sweetalert2.min.css")}}" rel="stylesheet">
    @yield('customCSS')
</head>
<body>
<div class="container">
    <main>
        <section class="vh-100">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card shadow-2-strong" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

<!-- Pills content -->
<script src="{{asset("/vendor/bootstrap5/bootstrap.js")}}"></script>
<script src="{{asset("/vendor/jquery/jquery.min.js")}}"></script>
<script src="{{asset("/vendor/sweetalert2/dist/sweetalert2.min.js")}}"></script>
<script src="{{asset("/_assets/js/utils/utils.js")}}"></script>
@yield('customJS')
</body>
</html>
