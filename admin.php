<?php
session_start();
include_once "config/inc.connection.php";
include_once "config/inc.library.php"; 

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING |E_DEPRECATED));

//security goes here

$_SESSION['warnabar'] = 'blue';
$_SESSION['warnatombol'] = 'blue';
 
?>
<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.1.1
Version: 2.0.2
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>PT. PUNGKOOK</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link href="assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/themes/grey.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-switch/css/bootstrap-switch.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/plugins/jquery-tags-input/jquery.tagsinput.css"/>
<link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">
<link rel="stylesheet" type="text/css" href="assets/plugins/typeahead/typeahead.css">
<link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2-metronic.css"/>
<link rel="stylesheet" href="assets/plugins/data-tables/DT_bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="assets/plugins/jstree/dist/themes/default/style.min.css"/>

<link rel="stylesheet" type="text/css" href="assets/plugins/clockface/css/clockface.css"/>
<link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-datepicker/css/datepicker.css"/>
<link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-colorpicker/css/colorpicker.css"/>
<link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
<link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css"/>

<link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-select/bootstrap-select.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/plugins/jquery-multi-select/css/multi-select.css"/>
<link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" >

<!-- SCRIPT JS-->
<script src="assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class=" page-full-width">
<!-- BEGIN HEADER -->
<div class="header navbar navbar-fixed-top mega-menu" style="width:100%">
  <!-- BEGIN TOP NAVIGATION BAR -->
  <div class="header-inner" style="display: flex;
    justify-content: space-between; width:100%">
    <!-- BEGIN LOGO -->
    <a class="navbar-brand" style="margin-top: 0;" href="admin.php"> 
        &nbsp;&nbsp;&nbsp; <!-- <font size="6" letter-spacing: -13px; color='red'>D</font>
                        <font size="6" color='yellow'>S</font>
                        <font size="6" color='green'>I</font>
                        <font size="3" color='white'>Pustaka</font> -->
    <div style="display: inline-block; letter-spacing: -1px; transform: translate(5px, 7px);">
    <span style="font-size: 2.1rem; color: white;">P</span>
    <span style="font-size: 2.1rem; color: white;">T</span>
    <span style="font-size: 2.1rem; color: white;">.</span> 
    <span style="font-size: 2.1rem; color: white; margin-left:2px; letter-spacing: 0.1px">Pungkook</span> 
    <span style="font-size: 2.1rem; color: white; margin-left:2px; letter-spacing: 0.1px">Indonesia</span></div>



      <!-- <img src="assets/img/DSIPustaka.png" alt="logo" style="margin-top:3px" class="img-responsive" width="150px" /> -->
    </a>
    <!-- END LOGO -->
    <!-- BEGIN HORIZANTAL MENU -->
    <div class="hor-menu hidden-sm hidden-xs" style="flex:1; display: flex;
    justify-content: center; width:66%;">
      <ul class="nav navbar-bar" style="display:flex; justify-content: space-between;">
        <!-- <li class="classic-menu-dropdown"><a href="?content=home">Halaman Utama</a></li> -->
        <li><a href="?content=incoming_view" style="text-decoration: none;">INCOMING GOODS</a></li>
        <li><a href="?content=general_journal" style="text-decoration: none;">GENERAL JOURNAL</a></li>

        <!-- Tambahan elemen untuk bulan dan profil -->
  <div style="display: flex; align-items: center; gap: 15px; position: absolute; right: 20px;">
    <img src="moon-icon.png" alt="Dark Mode" style="width: 24px; height: 24px; cursor: pointer;">
    <img src="profile-icon.png" alt="Profile" style="width: 32px; height: 32px; border-radius: 50%; cursor: pointer;">
  </div>
        
          
              <!-- <li class="dropdown-submenu"><a href="#" class="dropdown-item">CD</a>
                  <ul class="dropdown-menu">
                    <li><a href="#" class="dropdown-item">Tambah CD</a></li>
                    <li><a href="#" class="dropdown-item">CD Rusak</a></li>
                    <li><a href="#" class="dropdown-item">Hapus CD</a></li>
                    <li><a href="#" class="dropdown-item">Cari CD</a></li>
                  </ul>
              </li>
              <li class="dropdown-submenu"><a href="#" class="dropdown-item">Majalah/Koran</a>
                  <ul class="dropdown-menu">
                    <li><a href="#" class="dropdown-item">Tambah Majalah/Koran</a></li>
                    <li><a href="#" class="dropdown-item">Hapus Majalah/Koran</a></li>
                    <li><a href="#" class="dropdown-item">Cari Majalah/Koran</a></li>
                  </ul>
              </li>   -->
            </ul>
          </li>
            </ul>
          </li>
          <!-- <li class="classic-menu-dropdown">
            <a data-toggle="dropdown" href="javascript:;">DATABASE<i class="fa fa-angle-down"></i></a>
            <ul class="dropdown-menu">
              <li><a href="?content=tabel">Cari Tabel</a></li>
            </ul>
          </li> -->
            
         
        <a class="navbar-brand" style="margin-top: 0px; width: 25px;" href="admin.php">
          </a>
      </ul>
    </div>
    <p style="font-size:10px; color: yellow; margin-top:10px;"></p>
    <!-- END HORIZANTAL MENU -->
    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
    <!-- <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
      <img src="assets/img/menu-toggler.png" alt=""/>
    </a> -->
    <!-- END RESPONSIVE MENU TOGGLER -->
    <!-- BEGIN TOP NAVIGATION MENU -->
    <ul class="nav navbar-nav pull-right">
      <!-- BEGIN NOTIFICATION DROPDOWN -->
      <!-- END USER LOGIN DROPDOWN -->
    </ul>
    <!-- END TOP NAVIGATION MENU -->
  </div>
  <!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
  <!-- BEGIN EMPTY PAGE SIDEBAR -->
  
  <!-- END EMPTY PAGE SIDEBAR -->
  <!-- BEGIN CONTENT -->
  <div class="page-content-wrapper">
  <div class="page-sidebar navbar-collapse collapse">
      <ul class="page-sidebar-menu" data-slide-speed="200" data-auto-scroll="true">
          <li>
            <a href="#">Laporan<span class="arrow"></span></a>
            <ul class="sub-menu">
              <li><a href="#">Pemasukan Barang Per Dok Pabean</a></li>
              <li><a href="#">Pengeluaran Barang Per Dok Pabean</a></li>
              <li><a href="#">Pertanggungjawaban WIP</a></li>
              
              <li><a href="#">Pertanggungjawaban Bahan Baku</a></li>
              <li><a href="#">Pertanggungjawaban Barang Jadi</a></li>
              <li><a href="#">Pertanggungjawaban Scrap</a></li>
              <li><a href="#">Pertanggungjawaban Mesin dan Peralatan</a></li>
              
            </ul>
          </li> 
      </ul>
    </div>  
    <div class="page-content">
      
        <?php 
          if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
              echo '<div class="alert alert-success alert-dismissable">
                      <button type="but ton" class="close" data-dismiss="alert" aria-hidden="true"></button>
                      <i class="fa fa-check"></i>&nbsp;'.$_SESSION['pesan'].'.
                    </div>';
            }
            $_SESSION['pesan'] = '';
              
              
          if(isset($_GET['content'])){
             include("content.php");
            }
            else{
              //include("content/home_administrator.php");
              echo "<img src='assets/img/pungkook.jpg' class='img-responsive' style='align :center'  />";
            }
          ?>
     
      <!-- END PAGE CONTENT-->
    </div>
  </div>
  <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="footer">
  <div class="footer-inner">
     @NABEEL JEVICKO
  </div>
  <div class="footer-tools">
    <span class="go-top">
      <i class="fa fa-angle-up"></i>
    </span>
  </div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
  <script src="assets/plugins/excanvas.min.js"></script>
  <script src="assets/plugins/respond.min.js"></script>  
  <![endif]-->
  <script src="assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<script type="text/javascript" src="assets/plugins/fuelux/js/spinner.min.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script type="text/javascript" src="assets/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
<script type="text/javascript" src="assets/plugins/jquery.input-ip-address-control-1.0.min.js"></script>
<script src="assets/plugins/jquery.pwstrength.bootstrap/src/pwstrength.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-tags-input/jquery.tagsinput.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script>
<script src="assets/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
<script src="assets/plugins/typeahead/typeahead.min.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="assets/plugins/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/plugins/data-tables/DT_bootstrap.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="assets/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>

<script type="text/javascript" src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="assets/plugins/clockface/js/clockface.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/scripts/core/app.js"></script>
<script src="assets/scripts/custom/components-form-tools.js"></script>
<script src="assets/scripts/custom/table-managed.js"></script>
<script src="assets/scripts/custom/components-dropdowns.js"></script>
<script src="assets/scripts/custom/components-pickers.js"></script>
<script src="assets/plugins/jstree/dist/jstree.min.js"></script>
<script src="assets/scripts/custom/ui-tree.js"></script>

<link href="assets/plugins/tree/css/dtree.css" rel="stylesheet" />
<script src="assets/plugins/tree/js/jquery-2.1.1.min.js"></script>
<script src="assets/plugins/tree/js/dtree.js"></script>
<script type="text/javascript">
  $(window).load(function() {
    $(".loader").fadeOut("slow");
  });
</script>

<script>
    jQuery(document).ready(function() {    
       App.init();
       TableManaged.init();
       ComponentsDropdowns.init();
       ComponentsPickers.init();
       UITree.init();
    });
  </script>

<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>