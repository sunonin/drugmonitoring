<?php require_once 'manager/MenuCheckerManager.php'; ?> 
<?php $menuchecker = menuChecker('suspects'); ?> 

<?php include 'public/base.php'; ?>

<?php startblock('title') ?>
  Suspects
<?php endblock('title') ?>

<?php startblock('breadcrumbs') ?>
  <div class="col-sm-6">
    <h1 class="m-0">Suspects</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item active">Suspects List</li>
    </ol>
  </div>
<?php endblock('breadcrumbs') ?>

<?php startblock('content') ?>
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

  <?php include('views/suspects/index.php'); ?>
<?php endblock() ?>

<script type="text/javascript">
  $('select').select2();

  $('#reservationdate').datetimepicker({
    format: 'L'
  });

  $("#tb-suspects").DataTable({
    "responsive": true, 
    "lengthChange": false, 
    "autoWidth": false,
    "buttons": ["excel"],
    "columns": [
      { "data": "id", "visible": false },
      { "data": "name", "width": "15%", "className": 'text-center' },
      { "data": "address", "width": "15%", "className": 'text-center' },
      { "data": "birthdate", "width": "15%", "className": 'text-center' },
      { "data": "age", "width": "8%", "className": 'text-center' },
      { "data": "contact_no", "width": "15%", "className": 'text-center' },
      { "data": "status", "width": "15%", "className": 'text-center' },
      { "data": "action", "width": "15%", "className": 'text-center' }
    ],
    "order": [[0, 'asc']],
  }).buttons().container().appendTo('#tb-user_wrapper .col-md-6:eq(0)');
</script>
