<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="shortcut icon" type="image/png" href="dist/img/dummy_logo.ico"> 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DRCMS | Log in</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="vendor/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="vendor/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="row">
      <div class="col-md-12">
        <?php if (isset($_SESSION['alert'])): ?>
          <div class="alert alert-<?= $_SESSION['alert']['type']; ?> alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-<?= $_SESSION['alert']['icon']; ?>"></i> <?= $_SESSION['alert']['title']; ?>!</h5>
            <?= $_SESSION['alert']['message']; ?>
          </div>
          <?php unset($_SESSION['alert']); ?>
        <?php endif ?>
      </div>
    </div>

    

    <div class="card card-outline card-success">
      <div class="card-header text-center">
        <p style="color:#016501;"><b><span style="font-size:50px;">DRCMS</span><br>DRUG RELATED CASES MONITORING SYSTEM</b></p>
      </div>
      <div class="card-body">
        <form action="route/login/post_login.php" method="post">
          <div class="input-group mb-3">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-success btn-block"><i class="fas fa-sign-in-alt"></i> Sign In</button>
            </div>
          </div>
        </form>

      </div>
    </div>
    <p class="text-center" style="font-size:9pt; padding-top:2%;">
      Copyright &copy; 2022 <b>DILG IV-A CALABARZON</b>.
    All rights reserved.
    </p>
  </div>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
