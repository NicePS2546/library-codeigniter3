<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ? $title : 'My Website'; ?></title>
  <script src="<?= base_url('public/assets/js/popper.js') ?>"></script>
  <!--- online CDN --->

  <!-- Bootstrap CSS -->
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> -->

  <!-- Flatpickr CSS -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css" rel="stylesheet"> -->
  
  <!-- Bootstrap JS -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->

  <!-- Flatpickr JS -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script> -->
  <!-- Thai Language Locale for Flatpickr -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/l10n/th.js"></script> -->


  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE/plugins/fontawesome-free/css/all.min.css') ?>">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=K2D&display=swap" rel="stylesheet">
<!--- online CDN --->

<!--- offline CDN --->
  <!-- Bootstrap CSS -->
<link rel="stylesheet" href="<?= base_url('public/cdn/boostrap5_3_0/css/bootstrap.min.css')?>">
<!-- Bootstrap JS -->
<script src="<?= base_url('public/cdn/boostrap5_3_0/js/bootstrap.bundle.min.js')?>"></script>

 <!-- Flatpickr CSS -->
  <link href="<?= base_url('public/cdn/flatpicker/css/flatpickr.min.css')?>" rel="stylesheet">
<!-- Flatpickr JS -->
  <script src="<?= base_url('public/cdn/flatpicker/js/flatpickr.min.js')?>"></script>
  <!-- Flatpickr TH -->
  <script src="<?= base_url('public/cdn/flatpicker/js/flatpickr.min.js')?>"></script>



<!--- offline CDN --->


  <!-- Custom Loader CSS -->
  <link rel="stylesheet" href="<?= base_url('public/assets/css/loading.css') ?>?v=<?= time(); ?>" />
  <link rel="stylesheet" href="<?= base_url('public/assets/css/component.css') ?>?v=<?= time(); ?>" />
  <link rel="stylesheet" href="<?= base_url('public/assets/css/nav_active.css') ?>?v=<?= time(); ?>" />
  <link rel="stylesheet" href="<?= base_url('public/assets/css/dropdown.css') ?>?v=<?= time(); ?>" />
  <link rel="stylesheet" href="<?= base_url('public/assets/fonts/icomoon/style.css') ?>?v=<?= time(); ?>" />




  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: Arial, sans-serif;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      padding-top: 70px;
    }

    #app-container {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      width: 100%;
      margin: 0;
    }

    .content {
      flex: 1;+
      /* Makes the content section grow and take up available space */
    }

    .footer {
  background-color: #f4f4f4;
  text-align: center;
  padding: 10px 0;
  margin-top: auto; /* Pushes the footer to the bottom */
  width: 100%;
  border-top: 1px solid #ddd;
}


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
    <form method="post" action="<?= base_url() ?>index.php/sso/login">
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

  <div id="app-container" class="row mt-4">
    <div class="col-12">
    <div class="content">

      <?= $layout['content'] ?>
      <?= $this->load->view('component/toast_alert', [], true); ?>
    </div> <!-- Footer -->
    </div>
    </div>

    <footer class="footer mt-auto py-3 bg-light">
      <div class="container text-center">
        <p>ฝ่ายบริการโสตทัศนวัสดุ ชั้น 6 อาคารบรรณราชนครินทร์</p>
        <p>สำนักวิทยบริการและเทคโนโลยีสารสนเทศ มหาวิทยาลัยราชภัฏนครปฐม</p>
        <p>&copy; 2019 ARIT LibraryNPRU</p>
      </div>
    </footer>
    
  
  <?= $layout['notice'] ? $layout['notice'] : ''  ?>
  <!-- jQuery -->
  <script src="<?= base_url('public/cdn/jQuery/jquery-3.6.0.min.js') ?>"></script>
  
  <script src="<?= base_url('public/assets/js/dropdown.js') ?>"></script>



  <!-- Owl Carousel JS -->
  <script src="<?= base_url('assets/node_modules/owl.carousel/dist/owl.carousel.min.js') ?>"></script>

  <!-- Custom Scripts -->

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
    // Initialize Owl Carousel
    $(document).ready(function () {
      $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        responsive: {
          0: { items: 1 },
          800: { items: 1 },
          900: { items: 5 },
          1500: { items: 6 }
        }
      });
    });




  </script>




</body>

</html>