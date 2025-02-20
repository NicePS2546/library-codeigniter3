<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ? $title : 'My Website'; ?></title>
  <script src="<?= base_url('public/assets/js/popper.js') ?>"></script>


  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE/plugins/fontawesome-free/css/all.min.css') ?>">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=K2D&display=swap" rel="stylesheet">
  <!--- online CDN --->

  <!--- offline CDN --->
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?= base_url('public/cdn/boostrap5_3_0/css/bootstrap.min.css') ?>">
  <!-- Bootstrap JS -->
  <script src="<?= base_url('public/cdn/boostrap5_3_0/js/bootstrap.bundle.min.js') ?>"></script>

  <!-- Flatpickr CSS -->
  <link href="<?= base_url('public/cdn/flatpicker/css/flatpickr.min.css') ?>" rel="stylesheet">
  <!-- Flatpickr JS -->
  <script src="<?= base_url('public/cdn/flatpicker/js/flatpickr.min.js') ?>"></script>
  <!-- Flatpickr TH -->
  <script src="<?= base_url('public/cdn/flatpicker/js/flatpickr.min.js') ?>"></script>



  <!--- offline CDN --->



  <link rel="stylesheet" href="<?= base_url('public/assets/css/loading.css') ?>?v=<?= time(); ?>" />
  <!-- Custom Loader CSS -->
  <link rel="stylesheet" href="<?= base_url('public/assets/css/component.css') ?>?v=<?= time(); ?>" />
  <link rel="stylesheet" href="<?= base_url('public/assets/css/nav_active.css') ?>?v=<?= time(); ?>" />
  <link rel="stylesheet" href="<?= base_url('public/assets/css/dropdown.css') ?>?v=<?= time(); ?>" />
  <link rel="stylesheet" href="<?= base_url('public/assets/fonts/icomoon/style.css') ?>?v=<?= time(); ?>" />
  <link rel="stylesheet" href="<?= base_url('public/cdn/animated.css') ?>" />
  <script src="<?= base_url('public/cdn/sweetaleart2@11.js') ?>"></script>
  <link rel="stylesheet" href="<?= base_url("public/assets/cdn/sweet2.min.css") ?>">


  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    /* body {
      font-family: Arial, sans-serif;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      padding-top: 70px;
    } */


   
  </style>


</head>

<body>
  <!-- Loading Page -->
  <div id="loading">
    <div class="jumper">
      <div class="shadow-loading">
        <div class="loader"></div>
      </div>
    </div>
  </div>

  <!-- Navbar -->
  <?= $layout['navbar']; ?>



  <!-- Modal Structure -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" id="modal-form" action="<?= base_url() ?>index.php/sso/login" onsubmit="return Submit(event)" >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">เข้าสู่ระบบ SSO</h5>
            <!-- Correctly add data-bs-dismiss="modal" to close the modal -->
            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
          </div>
          <div class="modal-body  d-flex justify-content-center">
            <div class="col-10 col-sm-10 pb-4 col-md-10 col-lg-10">
              <div class="text-center">
                <img src="<?= base_url("public/assets/img/logo.png") ?>" class="rounded rounded-circle" width="150"
                  height="150" alt="...">
              </div>
              <div>
                <label for="st_id">รหัสนักศึกษา</label>
                <input type="text" placeholder="โปรดใส่รหัสนักศึกษา" name="st_id" class="form-control" id="st_id">
              </div>
              <div>
                <label for="password">รหัสผ่าน</label>
                <input type="password" class="form-control" name="password" placeholder="โปรดใส่รหัสผ่าน" id="password">
              </div>
              <label class="form-label text-danger">รหัส SSO ที่เข้าใช้ WI-Fi มหาวิทยาลัย</label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="modal" data-bs-dismiss="modal">ปิด</button>
            <button type="submit" class="btn btn-primary" id="modal">เข้าสู่ระบบ</button>

          </div>
        </div>
      </div>
    </form>
  </div>


        <?= $layout['content'] ?>
        <?= $this->load->view('component/toast_alert', [], true); ?>
      

  

  <?= $layout['notice'] ? $layout['notice'] : '' ?>
    <?= $layout['footer'] ?>

  <script>
    // Page loading animation
    $(window).on('load', function () {
      $("#loading").animate({
        'opacity': '0'
      }, 1500, function () {
        setTimeout(function () {
          $("#loading").css("visibility", "hidden").fadeOut();
        }, 100);
      });
    });
    $(document).ready(function () {
      // Initialize Flatpickr with both Date and Time picker
      flatpickr("#datetime", {
        enableTime: true,          // Enable time selection
        dateFormat: "Y-m-d H:i",   // Date and time format (24-hour)
        time_24hr: true,           // Use 24-hour time format
        minuteIncrement: 1,
        locale: 'th'         // Increment minutes by 1
      });
    });





  </script>
  <script>

    $(document).ready(function () {
      $('#nav-icon1,#nav-icon2,#nav-icon3,#nav-icon4').click(function () {
        $(this).toggleClass('open');
      });
    });

  </script>


  <script>
    function Submit(event) {
      event.preventDefault(); // Prevent default form submission

      const uid = $('#st_id').val(); // Get input value
      const password = $('#password').val();

      const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.onmouseenter = Swal.stopTimer;
          toast.onmouseleave = Swal.resumeTimer;
        }
      });

      if (!uid) {
        showSweet('warn', 'โปรดใส่รหัสผู้ใช้')
        return false; // Stop execution if input is empty
      } else if (!password) {
        showSweet('warn', 'โปรดใส่รหัสผ่าน')
        return false; // Stop execution if input is empty
      }


      setTimeout(function () {
        document.getElementById('modal-form').submit(); // Submit the form
      }, 800); // Wait 2 seconds (2000ms)

      return false; // Prevent default submission until AJAX completes
    }

  </script>
  <script>
  function showSweet(status, msg, title) {
      if (status == 'success') {
        Swal.fire({
          title: title ? title : "สำเร็จ",
          text: msg,
          icon: 'success',
          confirmButtonText: 'โอเค'
        });
      } else if (status == 'warn') {
        Swal.fire({
          title: title ? title : "แจ้งเตือน",
          text: msg,
          icon: 'warning',
          confirmButtonText: 'โอเค'
        });
      } else {
        Swal.fire({
          title: title ? title : "ผิดพลาด",
          text: msg,
          icon: 'error',
          confirmButtonText: 'โอเค'
        });
      }
    }</script>
</body>

</html>