<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Usina Bar</title>

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
            background: linear-gradient(90deg,#00c4cc,#7d2ae8);
            background-image: -moz-linear-gradient(0deg,#f61daf 0%,#691cff 100%);
            background-image: -webkit-linear-gradient(0deg,#f61daf 0%,#691cff 100%);
            background-image: -ms-linear-gradient(0deg,#f61daf 0%,#691cff 100%);
            background-image: -webkit-linear-gradient(0deg,#ED2BA2 0%,#8a2091 100%);
        }
    </style>

</head>
<body style="background-color: white;">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm" style="background-image: url(images/usina-bg.jpg)">
            <div class="container" style="height: 100px">
                <div style="background: #231f20; border: 3px solid #122700; border-radius: 100%; width: 200px; height: 200px; position: absolute; top: 25px; left: calc(50% - 100px);">
                <img src="images/logo.png" style="width: 150px; margin-top: 55px; margin-left: 25px;">
            </div>
<!--             <div class="container">
                <a href="https://menu.appget.in/865L5L1j/100" class="font-weight-bold" style="position: absolute; right: 250px; color: white!important;">CARDÁPIO</a>
            </div> -->
        </nav>

        <main class="py-4">
            <div class="container text-white">
                <div class="row">
                    <div class="col-12 pb-3 text-center">
                        <div class="row justify-content-center text-dark" style="margin-top: 100px;">
                            <div class="col-12">
                                <h3>Usina com os primos - 20/08/2022</h3>
                            </div>
                            <?php for ($i = 1; $i <= 91; $i++) { 
                                $fileName = 'image ('.$i.').jpg';

                                if(file_exists("images/fotos/20-08/$fileName")) { ?>
                                    <a class="col-md-2 mb-2" href="images/fotos/20-08/<?= $fileName ?>" target="_blank">
                                        <div style="height: 200px; background-image: url('images/fotos/20-08-min/<?= $fileName ?>'); background-size: cover; background-position: center;"></div>
                                    </a>
                                <?php }
                            } ?>
                            <div class="col-12">
                                <h3>Sexta - 17/06/2022</h3>
                            </div>
                            <?php for ($i = 0; $i < 9999; $i++) { 
                                $fileName = 'DSC_'.str_pad($i, 4, '0', STR_PAD_LEFT).'.jpg';

                                if(file_exists("images/fotos/17-06/$fileName")) { ?>
                                    <a class="col-md-2 mb-2" href="images/fotos/17-06/<?= $fileName ?>" target="_blank">
                                        <div style="height: 200px; background-image: url(images/fotos/17-06-min/<?= $fileName ?>); background-size: cover; background-position: center;"></div>
                                    </a>
                                <?php }
                            } ?>
                            <div class="col-12">
                                <h3>Domingo - 29/05/2022</h3>
                            </div>
                            <?php for ($i = 0; $i < 9999; $i++) { 
                                $fileName = 'DSC_'.str_pad($i, 4, '0', STR_PAD_LEFT).'.jpg';

                                if(file_exists("images/fotos/29-05/$fileName")) { ?>
                                    <a class="col-md-2 mb-2" href="images/fotos/29-05/<?= $fileName ?>" target="_blank">
                                        <div style="height: 200px; background-image: url(images/fotos/29-05-min/<?= $fileName ?>); background-size: cover; background-position: center;"></div>
                                    </a>
                                <?php }
                            } ?>
                            <div class="col-12">
                                <h3>Domingo - 28/05/2022</h3>
                            </div>
                            <?php for ($i = 0; $i < 9999; $i++) { 
                                $fileName = 'DSC_'.str_pad($i, 4, '0', STR_PAD_LEFT).'.jpg';

                                if(file_exists("images/fotos/28-05/$fileName")) { ?>
                                    <a class="col-md-2 mb-2" href="images/fotos/28-05/<?= $fileName ?>" target="_blank">
                                        <div style="height: 200px; background-image: url(images/fotos/28-05-min/<?= $fileName ?>); background-size: cover; background-position: center;"></div>
                                    </a>
                                <?php }
                            } ?>
                            <div class="col-12">
                                <h3>Domingo - 15/05/2022</h3>
                            </div>
                            <?php for ($i = 0; $i < 9999; $i++) { 
                                $fileName = 'DSC_'.str_pad($i, 4, '0', STR_PAD_LEFT).'.jpg';

                                if(file_exists("images/fotos/15-05/$fileName")) { ?>
                                    <a class="col-md-2 mb-2" href="images/fotos/15-05/<?= $fileName ?>" target="_blank">
                                        <div style="height: 200px; background-image: url(images/fotos/15-05-min/<?= $fileName ?>); background-size: cover; background-position: center;"></div>
                                    </a>
                                <?php }
                            } ?>
                            <div class="col-12">
                                <h3>Sábado - 14/05/2022</h3>
                            </div>
                            <?php for ($i = 0; $i < 9999; $i++) { 
                                $fileName = 'DSC_'.str_pad($i, 4, '0', STR_PAD_LEFT).'.jpg';

                                if (file_exists("images/fotos/14-05/$fileName")) { ?>
                                    <a class="col-md-2 mb-2" href="images/fotos/14-05/<?= $fileName ?>" target="_blank">
                                        <div style="height: 200px; background-image: url(images/fotos/14-05-min/<?= $fileName ?>); background-size: cover; background-position: center;"></div>
                                    </a>
                                <?php }
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <footer class="page-footer font-small bg-dark" style="background-image: url(images/usina-bg.jpg); color: white;">
        <div class="footer-copyright text-center py-3">Copyright ©️ 2022 - Feito com <i class="fa fa-heart" style="color: red"></i> por <a target="_blank" href="https://marcosamoraes.com" style="color: #122700"><b>Marcos Moraes</b></a></div>
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
