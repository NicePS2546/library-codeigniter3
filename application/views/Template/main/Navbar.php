<link rel="stylesheet" href="<?= base_url('public/assets/css/nav.css') ?>?v=<?= time(); ?>" />

<nav class="navbar navbar-expand-lg fixed-nav shadow bg-body-tertiary">
  <div class="container">
    <div class="text-center">
      <a href="<?= base_url() ?>">
        <img src="<?= base_url('public/assets/img/logo.png') ?>" width="50" height="50" class="rounded" alt="...">
      </a>
    </div>

    <!-- Hamburger Menu Icon -->
    <!-- <button class="navbar-toggler" id="nav-icon2" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
      aria-label="Toggle navigation">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>

    </button> -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Navbar Links & Login Button -->
    <div class="collapse nav-align navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mb-2 mb-lg-0" id="main">
        <li class="nav-item <?= $page == "home" ? "active1" : '' ?>">
          <a class="nav-link <?= $page == "home" ? "active" : '' ?>" href="<?= base_url() ?>">Home</a>
        </li>
        <li class="nav-item <?= $page == "music" ? "active2" : '' ?>">
          <a class="nav-link <?= $page == "music" ? "active" : '' ?>"
            href="<?= base_url() ?>index.php/music"><?= $type['music'] ?></a>
        </li>
        <li class="nav-item <?= $page == "vdo" ? "active3" : '' ?>">
          <a class="nav-link <?= $page == "vdo" ? "active" : '' ?>"
            href="<?= base_url() ?>index.php/vdo"><?= $type['vdo'] ?></a>
        </li>
        <li class="nav-item <?= $page == "mini" ? "active4" : '' ?>">
          <a class="nav-link <?= $page == "mini" ? "active" : '' ?>"
            href="<?= base_url() ?>index.php/mini"><?= $type['mini'] ?></a>
        </li>
        <!-- <li class="nav-item <?= $page == "Debug" ? "active5" : '' ?>">
          <a class="nav-link <?= $page == "Debug" ? "active" : '' ?>"
            href="<?= base_url() ?>index.php/admin/debug">Debugging</a>
        </li> -->
        <div id="marker"></div>
      </ul>
      <!-- Login Button -->
      <div class="d-flex align-items-center gap-4">
        <?php if ($this->session->has_userdata('userData')) {
          $userinfo = $this->session->userdata('userData');

          if ($this->session->has_userdata('admin_data')) {
            $admin_info = $this->session->userdata('admin_data');

            ?>

            <!-- <a style="color:white; text-decoration: none; width: 150px;" class="btn btn-success"
              href="<?= base_url() ?>index.php/admin/debug">Admin Panel</a> -->

          <?php } ?>
          <!-- <div class="dropdown custom-dropdown">
            <a href="#" data-toggle="dropdown" class="align-items-center d-flex  dropdown-link " aria-haspopup="true"
              aria-expanded="false" data-offset="-70, 20">
              Menu
              <span class="arrow icon-keyboard_arrow_down"></span>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <h3 class="menu-heading">Help &amp; Feedback</h3>
              <a class="dropdown-item" href="#"> <span class="icon icon-dashboard"></span> Getting started</a>
              <a class="dropdown-item" href="#"><span class="icon icon-mail_outline"></span>Help center <span
                  class="number">3</span></a>
              <a class="dropdown-item" href="#"><span class="icon icon-people"></span>Contact us</a>
              <hr>
              <h3 class="menu-heading">About</h3>
              <a class="dropdown-item" href="#"><span class="icon icon-comment"></span>Blog</a>
              <a class="dropdown-item" href="#"><span class="icon icon-lock_outline"></span>Privacy</a>
              <a class="dropdown-item" href="#"><span class="icon icon-security"></span>Security</a>
              <a class="dropdown-item" href="#"><span class="icon icon-featured_play_list"></span>Terms of service</a>
            </div>
          </div> -->
          <div class="dropdown show">
            <a class="btn dropdown-toggle"  role="button" id="dropdownMenuLink"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?= $userinfo['fullname'] ?>
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <?php if($admin_info){
              echo '<a class="dropdown-item " href="'.base_url('index.php/admin').'">หน้า Admin</a>';
              } ?>  
              <a class="dropdown-item" href="<?= base_url('index.php/user/history') ?>">ประวัติการจอง</a>
              <a class="dropdown-item" href="<?= base_url('index.php/sso/logout') ?>">ออกจากระบบ</a>
            </div>
          </div>

        <?php } else { ?>
          <button class="btn my-auto btn-primary btn-login" style="width:100px" data-bs-toggle="modal"
            data-bs-target="#exampleModal">เข้าสู่ระบบ</button>
        <?php } ?>
      </div>
    </div>
</nav>

<div class="margin-nav"></div>

