<?php require_once 'controller/SuspectsController.php'; ?>

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
	<div class="col-md-12">
		<div class="row">
			
			<div class="col-md-12">
				<div class="card">
					<div class="card-header d-flex p-0">
						<h3 class="card-title p-3">Suspect <b><?= isset($data['name']) ? ' - '.$data['name'] : ''; ?></b></h3>
						<ul class="nav nav-pills ml-auto p-2">
							<li class="nav-item">
								<a class="nav-link active" href="#tab_1" data-toggle="tab"><i class="fa fa-exclamation-circle"></i> Information</a>
							</li>
						</ul>
					</div>

					<div class="card-body">
						
						<div class="tab-content">
							<div class="tab-pane active" id="tab_1">
								<?php include 'information.php'; ?>
							</div>

							<div class="tab-pane" id="tab_2">
								<?php include 'products.php'; ?>
							</div>
						</div>

					</div>
				</div>

			</div>
		</div>
	</div>

</div>
