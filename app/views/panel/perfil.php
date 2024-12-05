<?php
    //Importar librerias
    require_once '../../helpers/menu_lateral.php';
    require_once '../../helpers/funciones_globales.php';

    //Reintancias la variable
    session_start();

     //Importar Modelo
    require_once '../../models/Tabla_usuarios.php';

    if(!isset($_SESSION["is_logged"]) || ($_SESSION["is_logged"] == false)){
        header("location: ../../../index.php?error=No has iniciado sesión&type=warning");
    }//end if 

    // echo print("<pre>".print_r($_SESSION,true)."</pre>");

    //Instanciar el modelo
    $tabla_usuario = new Tabla_usuarios();
    $usuario = $tabla_usuario->readGetUser($_SESSION['id_usuario']);
    // echo print("<pre>".print_r($usuario,true)."</pre>");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Blank Page</title>

    <!-- Icon -->
    <link rel="icon" href="../../../recursos/img/system/mtv-logo.jpg" type="image/x-icon">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../../recursos/recursos_panel/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../../recursos/recursos_panel/css/adminlte.min.css">

    <!-- Toastr -->
    <link rel="stylesheet" href="../../../recursos/recursos_panel/plugins/toastr/toastr.min.css">

</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="./dashboard.php" class="nav-link">Inicio</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="./perfil.php" class="nav-link">Mi perfil</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="../../backend/panel/liberate_user.php" class="nav-link">Cerrar Sesión</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Maximizar -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <!-- Cerrar Sesión -->
                <li class="nav-item">
                    <a class="nav-link" href="../../backend/panel/liberate_user.php" role="button" data-toggle="tooltip"
                        data-placement="top" title="Cerrar Sesión">
                        <i class="fa fa-window-close"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="../../index3.html" class="brand-link">
                <img src="../../../recursos/img/system/mtv-logo.jpg" alt="AdminLTE Logo" class="brand-image elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">MTV Awards</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../../../recursos/img/users/<?= $_SESSION["img"] ?>" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= $_SESSION["nickname"] ?></a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="¿Qué deseas buscar?"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <?= mostrar_menu_lateral($_SESSION, "") ?>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php
                    $breadcrumb = array(
                        array(
                            'tarea' => 'Mi Perfil',   
                            'href' => '#'
                        ),
                    );    
                    echo mostrar_breadcrumb('Mi Perfil', $breadcrumb); 
                ?>
            <!-- Content Header (Page header) -->


            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-3">
                        <!-- Profile Image -->
                        <div class="card card-dark card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="../../../recursos/img/users/<?= $_SESSION["img"] ?>" alt="User profile picture">
                                </div>

                                <!-- <h5 class="profile-username text-center"><?= $_SESSION["name"] ?></h5> -->

                                <p class="pt-3 text-muted text-center"><?= $_SESSION["name"] ?></p>

                                <a href="../../backend/panel/liberate_user.php" class="btn btn-primary btn-block"><b>Cerrar Sesión</b></a>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#activity"
                                            data-toggle="tab">Información</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#timeline"
                                            data-toggle="tab">Contraseña</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="activity">
                                        <form id="form-usuario" action="../../backend/panel/update_perfil.php" method="post" enctype="multipart/form-data">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <center>
                                                            <img src="../../../recursos/img/users/<?= ($usuario->imagen_usuario == '') ? 'user.png' : $usuario->imagen_usuario ;?>" class="img-rounded" alt="" id="img-preview" width="20%">
                                                        </center>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="id_usuario" class="form-control" id="id_usuario" placeholder="Nombre(s)" value="<?= $usuario->id_usuario ?>">

                                                <input type="hidden" name="perfil_aterior" class="form-control" id="perfil_aterior" placeholder="Nombre(s)" value="<?= ($usuario->imagen_usuario != NULL) ? $usuario->imagen_usuario : '' ?>">

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Nombre(s)</label>
                                                            <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre(s)" value="<?= $usuario->nombre_usuario ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Apellido Paterno</label>
                                                            <input type="text" name="apellido_paterno" class="form-control" id="apellido_paterno" placeholder="Apelldio Paterno" value="<?= $usuario->ap_usuario ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Apellido Materno</label>
                                                            <input type="text" name="apellido_materno" class="form-control" id="apellido_materno" placeholder="Apelldio Paterno" value="<?= $usuario->am_usuario ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Sexo</label>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="sexo" value="2" <?= $usuario->sexo_usuario == 2 ? 'checked' : '' ?>>
                                                                <label class="form-check-label">Femenino</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="sexo" value="1" <?= $usuario->sexo_usuario == 1 ? 'checked' : '' ?>>
                                                                <label class="form-check-label">Masculino</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Correo electrónico</label>
                                                            <input type="email" name="email" class="form-control" id="email" placeholder="Correo electrónico" value="<?= $usuario->email_usuario ?>">
                                                        </div>
                                                    </div>
                                                    
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="exampleInputEmail1">Foto perfil</label>
                                                        <input type="file" name="foto_perfil" onchange="previsualizar_imagen('previsualizar_imagen','foto-input')" class="form-control" id="foto-input">
                                                    </div>
                                                </div>
                                            
                                            </div>
                                            <!-- /.card-body -->
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-info">Editar</button>
                                            </div>
                                        </form>   
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="timeline">
                                        <form id="form-usuario" action="../../backend/panel/update_password.php" method="post">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <center>
                                                            <img src="../../../recursos/img/users/<?= ($usuario->imagen_usuario == '') ? 'user.png' : $usuario->imagen_usuario ;?>" class="img-rounded" alt="" id="img-preview" width="20%">
                                                        </center>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="id_usuario" class="form-control" id="id_usuario" placeholder="Nombre(s)" value="<?= $usuario->id_usuario ?>">

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Contraseña</label>
                                                            <input type="password" name="password" class="form-control" id="password" placeholder="***********">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Repetir Contraseña</label>
                                                            <input type="password" name="repassword" class="form-control" id="repassword" placeholder="***********">
                                                        </div>
                                                    </div>
                                                </div>

                                            
                                            </div>
                                            <!-- /.card-body -->
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-info">Editar contraseña</button>
                                            </div>
                                        </form>
                                    </div>
                                    
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>

                <!-- /.card -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>

    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../../../recursos/recursos_panel/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../../recursos/recursos_panel/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../../recursos/recursos_panel/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../../recursos/recursos_panel/js/demo.js"></script>
    <!-- Toastr -->
    <script src="../../../recursos/recursos_panel/plugins/toastr/toastr.min.js"></script>
    <!-- Mensaje Notificación -->
    <script>
        document.addEventListener("DOMContentLoaded", function (event) {
            <?php
                if (isset($_SESSION['message'])) {
                    echo mostrar_alerta_mensaje(
                        $_SESSION['message']["type"], 
                        $_SESSION['message']["description"],
                        $_SESSION['message']["title"]
                    );
                unset($_SESSION['message']);
                } 
            ?>
        });
    </script>
</body>

</html>