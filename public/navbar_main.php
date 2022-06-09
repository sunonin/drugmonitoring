<nav class="main-header navbar navbar-expand navbar-white navbar-light bg-success">

  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: white;"></i></a>
    </li>
  </ul>

  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown user-menu">
      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <div style="width: 35px; height: 35px;">
          <img src="<?= $_SESSION['currentuser']['profile']; ?>" class="user-image img-circle elevation-2" alt="User Image" style="height: 100% !important; width: 100% !important; object-fit: cover;">
        </div>
      </a>
      <ul class="dropdown-menu dropdown-menu-md dropdown-menu-right">
        <li class="user-header bg-success">
          <div style="width: 100px; height: 100px; display: inline-block;">
            <img src="<?= $_SESSION['currentuser']['profile']; ?>" class="img-circle elevation-2" alt="User Image" style="height: 100% !important; width: 100% !important; object-fit: cover;">
          </div>
          <p>
            <?= $_SESSION['currentuser']['uname']; ?>
            <small>Personnel</small>
          </p>
        </li>
        <li class="user-footer">
          <div class="row">
            <div class="span6" style="float: none; margin: 0 auto;">
              <div class="btn-group">
                <a href="route/login/post_logout.php" class="btn btn-default float-right"><i class="fas fa-sign-out-alt"></i> Sign out</a>
              </div>
            </div>
            
          </div>

        </li>
      </ul>
    </li>
  </ul>
</nav>