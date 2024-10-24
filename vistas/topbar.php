<?php 
session_start();
if (empty($_SESSION["nombres"])){
 header ("location: login.html");}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>APPSI - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-solid fa-brain"></i>
                </div>
              <div class="sidebar-brand-text mx-3">Consultorio de salud mental</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Inicio</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Salud Mental</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">DASS 21:</h6>
                        <a class="collapse-item" href="depresion.php">Depresión</a>
                        <a class="collapse-item" href="ansiedad.php">Ansiedad</a>
                      <a class="collapse-item" href="estres.php">Estrés</a>
                      <h6 class="collapse-header">Ideación :</h6>
                      <a class="collapse-item" href="columbia.php">Columbia</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Mapas</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Encuestados:</h6>
                        <a class="collapse-item" href="encuestados_cluster.php">Ubicaciones</a>
                        <a class="collapse-item" href="columbia_dass21.php">Columbia-Dass21</a>
                        <!--<a class="collapse-item" href="infraestructura.html">Infraestructura</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>-->
                      <h6 class="collapse-header">Infraestructura:</h6>
                        <a class="collapse-item" href="alcohol.php">Alcohol</a>
                      <a class="collapse-item" href="casinos.php">Casinos</a>
                      <a class="collapse-item" href="cines.php">Cines</a>
                      <a class="collapse-item" href="doctores.php">Doctores</a>
                      <a class="collapse-item" href="estadios.php">Estadios</a>
                      <a class="collapse-item" href="farmacias.php">Farmacias</a>
                      <a class="collapse-item" href="hospitales.php">Hospitales</a>
                      <a class="collapse-item" href="iglesias.php">Iglesias</a>
                      <a class="collapse-item" href="museos.php">Museos</a>
                      <a class="collapse-item" href="parques.php">Parques</a>
                      <a class="collapse-item" href="estadios.php">Estadios</a>
                      <h6 class="collapse-header">Educación:</h6>
                      <a class="collapse-item" href="preescolar.php">Preescolar</a>
                      <a class="collapse-item" href="primarias.php">Primarias</a>
                      <a class="collapse-item" href="secundarias.php">Secundarias</a>
                      <a class="collapse-item" href="preparatorias.php">Preparatorias</a>
                      <a class="collapse-item" href="universidades.php">Universidades</a>
                      
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="tables.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Encuestados</span></a>
            </li>
          
          <?php
if ($_SESSION["rol"]==0) {
    echo '<li class="nav-item active">
    <a class="nav-link" href="register.html">
        <i class="fas fa-solod fa-user"></i>
        <span>Registro de usuarios</span></a>
</li>';}
?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
 

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php
                                echo $_SESSION["nombres"];
                                ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->