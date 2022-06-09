<?php require_once 'vendor/phpti-master/src/ti.php'; ?>
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="shortcut icon" type="image/png" href="dist/img/dummy_logo.ico">  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DRCMS | <?php emptyblock('title'); ?></title>

  <?php startblock('css_assets'); ?>
  	<?php include 'public/css_main.php'; ?>
  <?php endblock() ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed accent-success">
  <div class="wrapper">
  	<?php startblock('navbar') ?>
      <?php include 'navbar_main.php'; ?>
    <?php endblock(); ?>

  	<?php startblock('sidebar') ?>
    	<?php include 'public/sidebar_main.php'; ?>
    <?php endblock(); ?>

    <div class="content-wrapper">

      <div class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <?php emptyblock('breadcrumbs') ?>
	        </div>
	      </div>
	    </div>
      
      <section class="content">
        <div class="container-fluid">
          <?php emptyblock('content') ?>
        </div>
      </section>

     </div>

    <footer class="main-footer">
      <strong>Copyright &copy; 2022 <b>DILG IV-A CALABARZON</b>.</strong>
      All rights reserved.
    </footer>

  </div>

  <?php startblock('js_assets') ?>
    <?php include 'public/js_main.php'; ?>
  <?php endblock(); ?>

</body>
</html>