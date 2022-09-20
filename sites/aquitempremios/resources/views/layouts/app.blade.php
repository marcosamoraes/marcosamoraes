<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Aqui tem prêmios</title>

    <link rel="shortcut icon" href="/images/favicon.png" />

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">

    <style type="text/css">
        .gradient {
            background: #00e4e9;
        }
    </style>

</head>
<body class="gradient">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm" style="background-color: #ff9000!important">
            <div class="container">
                <a class="navbar-brand">
                    <img src="/sites/aquitempremios/public/images/logo.jpg" height="70">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <footer class="page-footer font-small bg-dark" style="color:#c43e82!important; background-color: #ff9000!important">
        <div class="footer-copyright text-center py-3"><b>Copyright ©️ 2022 - Aqui tem prêmios.</b></div>
    </footer>
    <style>
        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 61px;
        }
        html {
            position: relative;
            min-height: 100%;
        }

        body {
            margin-bottom: 61px;
        }

        /* td {
            white-space: -o-pre-wrap; 
            word-wrap: break-word;
            white-space: pre-wrap; 
            white-space: -moz-pre-wrap; 
            white-space: -pre-wrap; 
        }

        table { 
            table-layout: fixed;
            width: 100%
        } */
        </style>
</body>
</html>
