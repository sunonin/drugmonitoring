<?php require_once 'manager/MenuCheckerManager.php'; ?> 
<?php $menuchecker = menuChecker('dashboard'); ?> 

<?php include 'public/base.php'; ?>

<?php startblock('title') ?>
  Dashboard
<?php endblock('title') ?>

<?php startblock('breadcrumbs') ?>
  <div class="col-sm-6">
    <h1 class="m-0">Dashboard</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </div>
<?php endblock('breadcrumbs') ?>

<?php startblock('content') ?>
  <?php include('views/Dashboard/index.php'); ?>
<?php endblock() ?>
