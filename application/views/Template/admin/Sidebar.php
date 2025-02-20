
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <div style="display: flex; flex-direction: column; align-items: center;">
      <img src="<?php echo $imageURL ?>" style="width: 50%; max-width: 150px; height: auto;" class="img-circle ">
      <!-- <br> -->
      <span class="brand-text font-weight-light">Nice Pasit</span>
    </div>
  </a>

 
 

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-home" style="color:gold;"></i>
              <p>
                หน้าหลัก
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="view_all_member.php" class="nav-link">
              <i class="nav-icon fas fa-chart-pie" style="color:gold;"></i>
              <p>
                แสดงข้อมูลสมาชิก
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="show_member.php" class="nav-link">
              <i class="nav-icon fas fa-chart-pie" style="color:gold;"></i>
              <p>
                จัดการข้อมูลสมาชิก
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="tmp_form.php" class="nav-link">
              <i class="nav-icon far fa-edit"></i>
              <p>
                จัดการข้อมูลประเภทกลุ่ม
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="tmp_datatable.php" class="nav-link">
              <i class="nav-icon fas fa-border-all"></i>
              <p>
                จัดการข้อมูลส่วนย่อย
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="admin.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                จัดการข้อมูลชมรม
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="admin.php" class="nav-link">
              <i class="nav-icon fas fa-cat"></i>
              <p>
                จัดการข้อมูลกิจกรรม
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="admin.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                จัดการเข้าร่วมกิจกรรม
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../logout.php" class="nav-link">
              <i class="nav-icon fas fa-door-open" style="color:gold;"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>