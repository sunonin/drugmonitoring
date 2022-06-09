<?php require_once 'manager/MenuCheckerManager.php'; ?> 
<?php $menuchecker = menuChecker('suspects'); ?> 

<?php include 'public/base.php'; ?>

<?php startblock('title') ?>
  Suspects
<?php endblock('title') ?>

<?php startblock('breadcrumbs') ?>
  <div class="col-sm-6">
    <h1 class="m-0">Edit Suspect</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
      <li class="breadcrumb-item">Suspects List</li>
      <li class="breadcrumb-item active">Edit Suspect</li>
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

  <?php include('views/suspects/form.php'); ?>
<?php endblock() ?>

<script type="text/javascript">
  $(document).ready(function(){
    $('select').select2();

    $('#reservationdate').datetimepicker({
      format: 'L'
    });
    
    $('#region').on('change', function(){
      let region = $(this).val();
      let path = 'route/suspects/generate_province.php?region='+region;

      $.get(path, function(data){
        $('#province').empty();
        $('#province').append('<option selected disabled>Please Select Region</option>');
        data = JSON.parse(data);

        $.each(data, function(key, item){
          $opt = '<option value="'+key+'">'+item+'</option>';
          $('#province').append($opt);
        });
      });
    });

    $('#province').on('change', function(){
      let province = $(this).val();
      let path = 'route/suspects/generate_lgu.php?province='+province;

      $.get(path, function(data){
        $('#lgu').empty();
        $('#lgu').append('<option selected disabled>Please Select LGU</option>');
        data = JSON.parse(data);

        $.each(data, function(key, item){
          $opt = '<option value="'+key+'">'+item+'</option>';
          $('#lgu').append($opt);
        });
      });
    });
  })

</script>
