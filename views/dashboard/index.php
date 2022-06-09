<?php require_once 'controller/DashboardController.php'; ?>

<?php if (isset($_SESSION['alert'])): ?>
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-<?php echo $_SESSION['alert']['type']; ?> alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-<?php echo $_SESSION['alert']['icon']; ?>"></i> <?php echo $_SESSION['alert']['title']; ?>!</h5>
        <?php echo $_SESSION['alert']['message']; ?>
      </div>
      <?php unset($_SESSION['alert']); ?>
    </div>  
  </div>
<?php endif ?>

<div class="row">
  <div class="col-sm-2 col-6">
    <div class="small-box bg-info">
      <div class="inner">
        <h3></h3>

        <p>Under Investigation</p>
      </div>
      <div class="icon">
        <i class="fas fa-cart-arrow-down"></i>
      </div>
      <a href="barcode_scanner_list.php" class="small-box-footer">---</a>
    </div>
  </div>
  
  <div class="col-sm-2 col-6">
    <div class="small-box bg-success">
      <div class="inner">
        <h3></h3>

        <p>Surrendered</p>
      </div>
      <div class="icon">
        <i class="fas fa-truck"></i>
      </div>
      <a href="barcode_scanner_list.php" class="small-box-footer">---</a>
    </div>
  </div>
  
  <div class="col-sm-2 col-6">
    <div class="small-box bg-warning">
      <div class="inner">
        <h3></h3>

        <p>Apprehended </p>
      </div>
      <div class="icon">
        <i class="fas fa-cubes"></i>
      </div>
      <a href="inventory.php" class="small-box-footer">---</a>
    </div>
  </div>
  
  <div class="col-sm-2 col-6">
    <div class="small-box bg-danger">
      <div class="inner">
        <h3></h3>

        <p>Escaped</p>
      </div>
      <div class="icon">
        <i class="fas fa-exclamation-triangle"></i>
      </div>
      <a href="inventory.php" class="small-box-footer">---</a>
    </div>
  </div>

  <div class="col-sm-2 col-6">
    <div class="small-box bg-secondary">
      <div class="inner">
        <h3></h3>

        <p>Deceased</p>
      </div>
      <div class="icon">
        <i class="fas fa-exclamation-triangle"></i>
      </div>
      <a href="inventory.php" class="small-box-footer">---</a>
    </div>
  </div>
  
</div>
