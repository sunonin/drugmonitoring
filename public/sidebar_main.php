<aside class="main-sidebar elevation-4 sidebar-light-success">
  <a href="dashboard.php" class="brand-link bg-success">
    <img src="dist/img/dummy_logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-1" style="opacity: .8">
    <span class="brand-text font-weight-light">DRCMS</span>
  </a>

  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="suspects.php" class="nav-link <?= $menuchecker['suspects'] ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Drug Suspects
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="lgu_information.php" class="nav-link <?= $menuchecker['lgu_information'] ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-info-circle"></i>
            <p>
              LGU Information
            </p>
          </a>
        </li>
        <li class="nav-item <?php if ($menuchecker['reports'] || $menuchecker['masterlist'] || $menuchecker['statistics_status'] || $menuchecker['statistics_population'] || $menuchecker['statistics_age']) echo 'menu-open' ; ?>">
          <a href="#" class="nav-link <?php if ($menuchecker['reports'] || $menuchecker['masterlist'] || $menuchecker['statistics_status'] || $menuchecker['statistics_population'] || $menuchecker['statistics_age']) echo 'active' ; ?>">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Reports Generation
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="masterlist.php" class="nav-link <?= $menuchecker['masterlist'] ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Masterlist</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="statistics_status.php" class="nav-link <?= $menuchecker['statistics_status'] ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Statistics - Status</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="statistics_population.php" class="nav-link <?= $menuchecker['statistics_population'] ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Statistics - Population</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="statistics_age.php" class="nav-link <?= $menuchecker['statistics_age'] ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Statistics - Age Bracket</p>
              </a>
            </li>
            
          </ul>
        </li>


      </ul>
    </nav>
    
  </div>
</aside>