<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-5EW505E87W"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-5EW505E87W');
    </script>
    <!---->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos Cortos Duoc UC Sede Viña del Mar</title>
    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;1,300&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/cursos.css">
    <!-- Favicon -->
    <link rel="icon" href="assets/img/favicon.ico" sizes="32x32" />
<link rel="icon" href="assets/img/favicon.ico" sizes="192x192" />
<link rel="apple-touch-icon-precomposed" href="assets/img/favicon.ico" />
<meta name="msapplication-TileImage" content="assets/img/favicon.ico" />
</head>
<body class="bg-dark">
    <!-- Header -->
    <section class="header bg-dark">
        <header class="header-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 mx-auto bg-dark d-flex align-items-center justify-content-center">
                        <a class="header-logo" href="https://viveduocvivetuvocacion.cl/sedevina/" target="_blank">
                            <img src="assets/img/logo/duoc_vina.svg">
                        </a>
                    </div>
                </div>
            </div>
        </header>
    </section>
    <!-- Section: Sede -->
    <section class="py-5 bg-dark">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-6 col-lg-5 col-xl-4 mx-auto">
                    <h2 class="text-center text-primary text-uppercase font-weight-bold mb-4">Inscripciones</h2>
                    <!-- Generación de reporte -->
                    <div id="id01" class="card" style="display: block;">

                        <form class="card-body p-4 text-center" action="src/ImprimirExcel.php" method="post">
                            <!-- 
                            <div class="imgcontainer">
                            <span onclick="location.href='index.html';" class="close" title="Close Modal">×</span>
                            <img src="img_avatar2.png" alt="Avatar" class="avatar">
                            </div> 
                            -->

                            <div class="form-group">
                                <label class="mb-1" for="uname"><b>Nombre de usuario</b></label>
                                <input class="form-control text-center" type="text" placeholder="Ingrese nombre de usuario" name="uname" required="">
                            </div>

                            <div class="form-group mb-4">
                                <label class="mb-1" for="psw"><b>Contraseña</b></label>
                                <input type="password" class="form-control text-center" placeholder="Ingrese contraseña" name="psw" required="">
                                <input type="hidden" name="request" value="request_1">
                            </div>

                            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-download mr-2"></i>Generar reporte</button>

                            
                        </form>
                    </div>
                    <!-- // -->
                    <div class="mt-4 text-center">
                        <a href="index.html" class="cancelbtn btn btn-link"><i class="fas fa-caret-left mr-2"></i>Volver a la portada</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Scripts -->
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <!-- Custom Script -->
    <script src="assets/js/pinBox/jquery.pinBox.min.js"></script>
    <script src="assets/js/cursos.js"></script>

</body>
</html>