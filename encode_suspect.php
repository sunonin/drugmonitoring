<?php require_once 'manager/MenuCheckerManager.php'; ?> 
<?php $menuchecker = menuChecker('suspects'); ?> 

<?php include 'public/base.php'; ?>

<?php startblock('title') ?>
  Suspects
<?php endblock('title') ?>

<?php startblock('breadcrumbs') ?>
  <div class="col-sm-6">
    <h1 class="m-0">Encode Suspect</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
      <li class="breadcrumb-item">Suspects List</li>
      <li class="breadcrumb-item active">Encode Suspect</li>
    </ol>
  </div>
<?php endblock('breadcrumbs') ?>

<?php startblock('content') ?>
  <?php include('views/suspects/form.php'); ?>
<?php endblock() ?>

<script type="text/javascript">
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


</script>
