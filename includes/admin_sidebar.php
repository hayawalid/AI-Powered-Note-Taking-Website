<div class="sidebar" data-color="white">
  <div class="logo">
    <a href="" class="simple-text logo-normal">
      📝  SMARTNOTES
    </a>
  </div>
  <div class="sidebar-wrapper" id="sidebar-wrapper">
    <ul class="nav">
      <li class="<?php echo ($current_page == 'Dashboard') ? 'active' : ''; ?>">
        <a href="./admin_dashboard.php">
          <i class="now-ui-icons design_app"></i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="<?php echo ($current_page == 'User Profile') ? 'active' : ''; ?>">
        <a href="./admin_user.php">
          <i class="now-ui-icons users_single-02"></i>
          <p>User Profile</p>
        </a>
      </li>
      <li class="<?php echo ($current_page == 'Users Table List') ? 'active' : ''; ?>">
        <a href="./admin_tables.php">
          <i class="now-ui-icons design_bullet-list-67"></i>
          <p>Users Table List</p>
        </a>
      </li>
      <li class="active-pro">
        <a href="./upgrade.html">
          <i class="now-ui-icons sport_user-run" style="transform: scaleX(-1);"></i>
          <p>Log out</p>
        </a>
      </li>
    </ul>
  </div>
</div>
