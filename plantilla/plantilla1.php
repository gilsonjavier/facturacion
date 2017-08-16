
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b></b></span>
      <!-- logo -->
      <span class="logo-lg"></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="">Close</span>
      </a>

      <div class="navbar-custom-menu">
       
         
        
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
     
      <!-- search form -->
    
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENU</li>
        <li class="treeview">
          <a href="../productos/registro_productos.php">
            <i class="glyphicon glyphicon-briefcase"></i> <span>Productos</span>
            <span class="pull-right-container">
              <!--<i class="fa fa-angle-left pull-right"></i>-->
              <span class="label label-primary pull-right">Products</span>
            </span>
          </a>
          <?php function camino($url) 
             {
               $pre = "";
               echo $pre.$url;
             }
             ?>
        
        </li>

       


        <li>
          <a href="../clientes/registro_clientes.php"?>
            <i class="glyphicon glyphicon-user"></i> <span> Clientes</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">Clients</small>
            </span>
          </a>
        </li>

         <li>
          <a href="../usuarios/usuarios.php"?>
            <i class="glyphicon glyphicon-user"></i> <span> Usuarios</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">Users</small>
            </span>
          </a>
        </li>

        <li>
          <a href="../factura/nueva_factura.php"?>
            <i class="glyphicon glyphicon-plus"></i> <span> Nueva Factura</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">New</small>
            </span>
          </a>
        </li>

         <li>
          <a href="../factura/facturas.php"?>
            <i class="glyphicon glyphicon-cog"></i> <span> Administrar Facturas</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">Admin</small>
            </span>
          </a>
        </li>

        <li>
          <a href="../cuadre/cuadre.php"?>
            <i class="glyphicon glyphicon-list-alt"></i> <span> Reporte Facturas</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">Report</small>
            </span>
          </a>
        </li>

        <li>
          <a href="../sistema/sistema.php"?>
            <i class="glyphicon glyphicon-globe"></i> <span> Configuracion</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">System</small>
            </span>
          </a>
        </li>

         <li>
          <a href="../../../login.php?logout"?>
            <i class="glyphicon glyphicon-off"></i> <span> Salir</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">Out</small>
            </span>
          </a>
        </li>


    <!--   <li>        
   <a href="../../../login.php?logout"><i class='glyphicon glyphicon-off'></i> Salir</a>
      </li>   -->   

    <!--    <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Opciones</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">6</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-circle-o"></i> Asignaturas Programas</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Microcurriculos</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Carga Academica</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Planeador</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Auditoria</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Registro de Clases</a></li>
          </ul>
        </li>-->

       <!--    <li>
          <a href="#">
            <i class="fa fa-files-o"></i> <span>Asignaturas Programas</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"></small>
            </span>
          </a>
        </li>   

        <li>
          <a href="#">
            <i class="fa fa-files-o"></i> <span>Microcurriculos</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"></small>
            </span>
          </a>
        </li>   

     <li>
          <a href=<?php camino("/index.php/carga/")?>
            <i class="fa fa-files-o"></i> <span>Carga Academica</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"></small>
            </span>
          </a>
        </li>   

        <li>
          <a href="#">
            <i class="fa fa-files-o"></i> <span>Planeador</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"></small>
            </span>
          </a>
        </li>   

        <li>
          <a href="#">
            <i class="fa fa-files-o"></i> <span>Auditoria</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"></small>
            </span>
          </a>
        </li>   

        <li>


        
   <a href="../../../login.php?logout"><i class='glyphicon glyphicon-off'></i> Salir</a>
   
          <a href="#">
            <i class="fa fa-files-o"></i> <span>Registro de Clases</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"></small>
            </span>
          </a>
        </li>   

      </ul>-->

    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     



    </section>


    <section class="content">







     
 
  <!--    </div>
    

    </section>
  
  </div>

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.6
    </div>
    <strong>footer <a href="">www</a>.</strong> 
  </footer>

  <div class="control-sidebar-bg"></div>
</div>
</body>
</html>-->