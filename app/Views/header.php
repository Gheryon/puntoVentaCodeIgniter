<?php
$session_user=session();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Punto de venta</title>
  <link href="<?php echo base_url();?>css/datatables-style.min.css" rel="stylesheet" />
  <link href="<?php echo base_url();?>js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
  <link href="<?php echo base_url();?>css/styles.css" rel="stylesheet" />
  <script src="<?php echo base_url();?>js/all.min.js"></script>
  <script src="<?php echo base_url();?>js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>js/jquery-ui/jquery-ui.min.js"></script>
</head>

<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="<?php echo base_url();?>/Inicio">Punto de venta</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto me-3 me-lg-4">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $session_user->nombre;?><i class="fas fa-user fa-fw"></i></a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="<?php echo base_url();?>Usuarios/cambiar_pass">Cambiar contraseña</a></li>
          <li><a class="dropdown-item" href="#!">Activity Log</a></li>
          <li>
            <hr class="dropdown-divider" />
          </li>
          <li><a class="dropdown-item" href="<?php echo base_url();?>Usuarios/cerrar_sesion">Cerrar sesión</a></li>
        </ul>
      </li>
    </ul>
  </nav>
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
              <div class="sb-nav-link-icon"><i class="fas fa-shopping-basket"></i></div>
              Productos
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="<?php echo base_url();?>Productos">Productos</a>
                <a class="nav-link" href="<?php echo base_url();?>Unidades">Unidades</a>
                <a class="nav-link" href="<?php echo base_url();?>Categorias">Categorías</a>
              </nav>
            </div>
            <a class="nav-link" href="<?php echo base_url();?>Clientes"><div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>Clientes</a>

            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#menuCompras" aria-expanded="false" aria-controls="menuCompras">
              <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
              Compras
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="menuCompras" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="<?php echo base_url();?>Compras/Nuevo">Nueva compra</a>
                <a class="nav-link" href="<?php echo base_url();?>Compras">Compras</a>
              </nav>
            </div>

            <a class="nav-link" href="<?php echo base_url();?>Ventas/caja"><div class="sb-nav-link-icon"><i class="fas fa-cash-register"></i></div>Caja</a>

            <a class="nav-link" href="<?php echo base_url();?>Ventas"><div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>Ventas</a>
            
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#menuReportes" aria-expanded="false" aria-controls="menuReportes">
              <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
              Reportes
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="menuReportes" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="<?php echo base_url();?>Productos/mostrarMinimos">Reporte mínimos</a>
              </nav>
            </div>

            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#subAdministracion" aria-expanded="false" aria-controls="subAdministracion">
              <div class="sb-nav-link-icon"><i class="fas fa-tools"></i></div>
              Administración
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="subAdministracion" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="<?php echo base_url();?>Configuracion">Configuración</a>
                <a class="nav-link" href="<?php echo base_url();?>Usuarios">Usuarios</a>
                <a class="nav-link" href="<?php echo base_url();?>Roles">Roles</a>
                <a class="nav-link" href="<?php echo base_url();?>Cajas">Cajas</a>
              </nav>
            </div>
          </div>
        </div>
      </nav>
    </div>