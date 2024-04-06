<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-0MEY0YXK6T"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-0MEY0YXK6T');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="1hQeQSr6rFoCjwLUGvU2FCIDYsIICxQ6ZzGJ5vOW">

    <title>CETECH - Sistema de Información Escolar</title>
    <link rel="stylesheet" href="https://cetech.sjuanrio.tecnm.mx/css/app.css">
    <link rel="stylesheet" href="https://cetech.sjuanrio.tecnm.mx/css/autocompleter.css">
    <link rel="stylesheet" href="https://cetech.sjuanrio.tecnm.mx/jqueryui-editable/css/jqueryui-editable.css">
    <link rel="stylesheet" href="https://cetech.sjuanrio.tecnm.mx/css/checkbox_off.css">
    <link rel="stylesheet" href="https://cetech.sjuanrio.tecnm.mx/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!--  estilo institucion -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- chosen -->
    <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css">

</head>
<style>
    #main-header,
    #content-wrapper {
        margin: 0px !important;
        width: 100%;
    }
</style>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

<body class="hold-transition sidebar-mini sidebar-collapse">
    <div id="app" class="wrapper">
        <!-- Navbar -->
        <nav id="main-header" class="main-header navbar navbar-expand navbar-white navbar-light border-bottom shadow">
            <!-- Left navbar links -->
            <!-- SEARCH FORM -->
            <!--form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form-->

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fas fa-home"></i>
                            Home</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt"></i>
                            Entrar</a>
                    </li>
                @endauth

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <!-- Content Wrapper. Contains page content -->
        <div id="content-wrapper" class="content-wrapper">

            <!-- Content Header (Page header) -->
            <div class="content-header">
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">Bienvenida</div>

                                        <div class="card-body">
                                            @auth
                                                <div class="text-center">Bienvenido(a) ya ha iniciado sesión, volver a la página de inicio
                                                    <a class="" href="{{ route('home') }}"> <i
                                                            class="fas fa-home"></i> Home</a>
                                                </div>
                                            @else
                                                <div class="text-center">Bienvenido(a) al sistema de asistencia docente,
                                                    para comenzar presiona el enlace
                                                    <a class="" href="{{ route('login') }}"> <i
                                                            class="fas fa-sign-in-alt"></i> Entrar</a>
                                                    y proporciona tus credenciales de acceso.
                                                </div>
                                            @endauth
                                            <hr>
                                            <div class="text-center">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong> Copyright&copy; 2023 .</strong>
            All
            rights reserved.

            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0
            </div>
            <div class="d-none d-sm-inline-block">
                <strong> Gestión de Proyectos de Software - Qualitec </strong>
            </div>

        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <script src="https://cetech.sjuanrio.tecnm.mx/js/app.js"></script>
    <script src="https://cetech.sjuanrio.tecnm.mx/js/bootstrap3-typeahead.js"></script>
    <script src="https://cetech.sjuanrio.tecnm.mx/jqueryui-editable/js/jqueryui-editable.min.js"></script>
    <script src="https://cetech.sjuanrio.tecnm.mx/js/chosen.jquery.js"></script>
    <script src="https://cetech.sjuanrio.tecnm.mx/js/chosen.proto.js"></script>
    <script src="https://cetech.sjuanrio.tecnm.mx/js/checkbox_off.js"></script>
    <script src="https://cetech.sjuanrio.tecnm.mx/js/jquery.mask.min.js"></script>

    <script src="https://cetech.sjuanrio.tecnm.mx/js/jquery.dataTables.min.js"></script>
    <script src="https://cetech.sjuanrio.tecnm.mx/js/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".chosen-select").chosen();
            //new DataTable('#data-table');
            new DataTable('#data-table', {
                info: false,
                ordering: false,
                paging: false,
                language: {
                    search: 'Buscar'
                }
            });
        });
    </script>

</body>

</html>
