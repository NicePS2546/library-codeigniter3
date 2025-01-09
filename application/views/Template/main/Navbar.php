<style>
  .nav-link {
    transition: transform ease-in-out 0.5s !important;
  }

  .nav-link:hover {
    transform: scale(1.08);
    color: black;

  }

  .btn#modal {
    transition: all 250ms ease-in-out !important;

  }

  .btn#modal:hover {
    transform: scale(1.12);
    transition: all 250ms ease-in-out;
  }

  .navbar-nav {
    margin: 0 auto;
    display: flex;
    justify-content: center;
    width: 100%;
  }

  .navbar-toggler {
    margin-left: auto;
    /* Push the hamburger icon to the right */
  }

  /* Optional: Custom styles if you want to tweak the appearance */
  .modal-header {
    background-color: #007bff;
    color: white;
  }

  /* Adjust Login button spacing */
  .btn-login {
    margin-left: auto;
    transition: transform 0.4s ease-in-out !important;
  }

  .btn-login:hover {
    transform: scale(1.04);

  }
  .btn-admin {
    margin-left: auto;
    transition: transform 0.4s ease-in-out !important;
  }

  .btn-admin:hover {
    transform: scale(1.04);

  }

  .shadow {
    box-shadow: 20px;

  }

  .fixed-nav {
    position: fixed;
    top: 0;
    width: 100%;
    /* Make sure the navbar spans the width of the viewport */
    z-index: 1020;
    /* Ensures the navbar stays above other elements */
    background-color: #f8f9fa;
    /* Set a background color */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    /* Optional: Add a shadow for better visibility */
  }

  .margin-nav {
    margin-bottom: 4%;
  }
</style>

<nav class="navbar navbar-expand-lg fixed-nav shadow bg-body-tertiary">
  <div class="container">
  <div class="text-center">
    <a href="<?= base_url() ?>">
  <img src="<?= base_url('public/assets/img/logo.png') ?>" width="50" height="50" class="rounded" alt="...">
  </a>
</div>

    <!-- Hamburger Menu Icon -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Links & Login Button -->
    <div class="collapse nav-align navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mb-2 mb-lg-0" id="main">
        <li class="nav-item <?= $page == "home" ? "active1" : '' ?>">
          <a class="nav-link" href="<?= base_url() ?>">Home</a>
        </li>
        <li class="nav-item <?= $page == "music" ? "active2" : '' ?>">
          <a class="nav-link" href="<?= base_url() ?>index.php/music"><?= $type['music'] ?></a>
        </li>
        <li class="nav-item <?= $page == "vdo" ? "active3" : '' ?>">
          <a class="nav-link" href="<?= base_url() ?>index.php/vdo"><?= $type['vdo'] ?></a>
        </li>
        <li class="nav-item <?= $page == "mini" ? "active4" : '' ?>">
          <a class="nav-link" href="<?= base_url() ?>index.php/mini"><?= $type['mini'] ?></a>
        </li>
        <li class="nav-item <?= $page == "Debug" ? "active5" : '' ?>">
          <a class="nav-link" href="<?= base_url() ?>index.php/admin/debug">Debugging</a>
        </li>
        <div id="marker"></div>
      </ul>
      <!-- Login Button -->
       <div class="d-flex align-items-center gap-4">
      <?php if ($this->session->has_userdata('userData')) {
        $userinfo = $this->session->userdata('userData');
        
        if($this->session->has_userdata('admin_data')){
          $admin_info = $this->session->userdata('admin_data');
         
        ?>
        
        <a style="color:white; text-decoration: none; width: 150px;" class="btn btn-success" href="<?= base_url() ?>index.php/admin/debug">Admin Panel</a>

        <?php } ?>
      <div class="dropdown custom-dropdown">
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
    </div>

       
      <?php } else { ?>
        <button class="btn my-auto btn-primary btn-login" style="width:100px" data-bs-toggle="modal"
          data-bs-target="#exampleModal">เข้าสู่ระบบ</button>
      <?php } ?>
    </div>
  </div>
</nav>
<div class="margin-nav"></div>