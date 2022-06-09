<?php require_once 'manager/MenuCheckerManager.php'; ?> 
<?php $menuchecker = menuChecker('lgu_information'); ?> 

<?php include 'public/base.php'; ?>

<?php startblock('title') ?>
  LGU Information
<?php endblock('title') ?>

<?php startblock('breadcrumbs') ?>
  <div class="col-sm-6">
    <h1 class="m-0">LGU Information</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item active">LGU Information</li>
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

  <?php include('views/lguinfo/index.php'); ?>
<?php endblock() ?>

<script type="text/javascript">
  function generateTableData($data) {
      let tr='';
      $.each($data, function(key, item){
        tr += '<tr>';
        tr += '<td>'+key+'</td>';
        tr += '<td style="vertical-align: middle;">'+item.region+'</td>';
        tr += '<td style="vertical-align: middle;">'+item.province+'</td>';
        tr += '<td style="vertical-align: middle;">'+item.lgu+'</td>';
        tr += '<td style="vertical-align: middle;">'+item.population+'</td>';
        tr += '</tr>';
      });

    $('#tbody-suspects').append(tr);

    return 0;
  }

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
      { "data": "region", "width": "15%", "className": 'text-center' },
      { "data": "province", "width": "15%", "className": 'text-center' },
      { "data": "lgu", "width": "15%", "className": 'text-center' },
      { "data": "population", "width": "15%", "className": 'text-center' }
    ],
    "order": [[0, 'asc']],
  }).buttons().container().appendTo('#tb-user_wrapper .col-md-6:eq(0)');


  $(document).on('click', '.btn-filter', function(){
    let region = $('#region').val();
    let province = $('#province').val();
    let lgu = $('#lgu').val();
    let path = "route/reports/filter_statistics_population.php?region="+region+"&province="+province+"&lgu="+lgu;
    
    $.get(path, function(data){
      let dd = JSON.parse(data);

      $('#tb-suspects').dataTable().fnClearTable();
      $('#tb-suspects').dataTable().fnDestroy();

      generateTableData(dd);
      $("#tb-suspects").DataTable({
        "responsive": true, 
        "lengthChange": false, 
        "autoWidth": false,
        "buttons": ["excel"],
        "columns": [
          { "data": "id", "visible": false },
          { "data": "region", "width": "15%", "className": 'text-center' },
          { "data": "province", "width": "15%", "className": 'text-center' },
          { "data": "lgu", "width": "15%", "className": 'text-center' },
          { "data": "population", "width": "15%", "className": 'text-center' }
        ],
        "order": [[0, 'asc']],
      }).buttons().container().appendTo('#tb-user_wrapper .col-md-6:eq(0)');
    })
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
      $('#lgu').append('<option value="" selected disabled>Please Select LGU</option>');
      data = JSON.parse(data);

      $.each(data, function(key, item){
        $opt = '<option value="'+key+'">'+item+'</option>';
        $('#lgu').append($opt);
      });
    });
  });

</script>
