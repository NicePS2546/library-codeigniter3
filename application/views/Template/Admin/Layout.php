<?php 
 if (!$this->session->has_userdata('admin_data')) {
    // If no admin session, redirect to homepage
    $this->session->set_flashdata('error', 'คุณไม่มีสิทธิ์ในการเข้าถึงหน้านี้!');
    redirect('/');  // Replace 'home' with the appropriate controller or URL
}
?>

<?= $layout['header']; ?>

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
<?= $layout['sidebar']; ?>

      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">แผงควบคุม</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="<?= base_url('index.php/admin') ?>">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
          <?= $layout['content'] ?>
         
          
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
      <?= $this->load->view('component/toast_alert', [], true); ?>
      <?= $layout['notice'] ? $layout['notice'] : '' ?>
      <?= $layout['footer'] ?>
<!--end::App Wrapper-->

<!--begin::Script-->
<!--begin::Third Party Plugin(OverlayScrollbars)-->
<!-- jQuery -->
<script src="<?= base_url('public/admin/assets/plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('public/admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- Summernote -->
<script src="<?= base_url('public/admin/assets/plugins/summernote/summernote-bs4.min.js') ?>"></script>
<!-- Page specific script -->

<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
  integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
<!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
  integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
  integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
<script src="<?= base_url('public/admin/dist/js/adminlte.js') ?>"></script>
<!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->

<script>
  const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
  const Default = {
    scrollbarTheme: 'os-theme-light',
    scrollbarAutoHide: 'leave',
    scrollbarClickScroll: true,
  };
  document.addEventListener('DOMContentLoaded', function () {
    const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
    if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
      OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
        scrollbars: {
          theme: Default.scrollbarTheme,
          autoHide: Default.scrollbarAutoHide,
          clickScroll: Default.scrollbarClickScroll,
        },
      });
    }
  });
</script>



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
<script>

  
</script>
<!--end::Script-->
</body>
<!--end::Body-->

</html>


