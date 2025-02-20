














      
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
              <div class="col-sm-6"><h3 class="mb-0">Dashboard v2</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard v2</li>
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
          <?= $layout['content'] ?>
          <?= $layout['content'] ?>
          <?= $layout['content'] ?>
          <?= $layout['content'] ?>
          <?= $layout['content'] ?>
          <?= $layout['content'] ?>
          <?= $layout['content'] ?>
          <?= $layout['content'] ?>
          <?= $layout['content'] ?>
          <?= $layout['content'] ?>
          <?= $layout['content'] ?>
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
<!--end::OverlayScrollbars Configure-->
<!-- OPTIONAL SCRIPTS -->
<!-- apexcharts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
  integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
<script>
  // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
  // IT'S ALL JUST JUNK FOR DEMO
  // ++++++++++++++++++++++++++++++++++++++++++

  /* apexcharts
   * -------
   * Here we will create a few charts using apexcharts
   */

  //-----------------------
  // - MONTHLY SALES CHART -
  //-----------------------

  const sales_chart_options = {
    series: [
      {
        name: 'Digital Goods',
        data: [28, 48, 40, 19, 86, 27, 90],
      },
      {
        name: 'Electronics',
        data: [65, 59, 80, 81, 56, 55, 40],
      },
    ],
    chart: {
      height: 180,
      type: 'area',
      toolbar: {
        show: false,
      },
    },
    legend: {
      show: false,
    },
    colors: ['#0d6efd', '#20c997'],
    dataLabels: {
      enabled: false,
    },
    stroke: {
      curve: 'smooth',
    },
    xaxis: {
      type: 'datetime',
      categories: [
        '2023-01-01',
        '2023-02-01',
        '2023-03-01',
        '2023-04-01',
        '2023-05-01',
        '2023-06-01',
        '2023-07-01',
      ],
    },
    tooltip: {
      x: {
        format: 'MMMM yyyy',
      },
    },
  };

  const sales_chart = new ApexCharts(
    document.querySelector('#sales-chart'),
    sales_chart_options,
  );
  sales_chart.render();

  //---------------------------
  // - END MONTHLY SALES CHART -
  //---------------------------

  function createSparklineChart(selector, data) {
    const options = {
      series: [{ data }],
      chart: {
        type: 'line',
        width: 150,
        height: 30,
        sparkline: {
          enabled: true,
        },
      },
      colors: ['var(--bs-primary)'],
      stroke: {
        width: 2,
      },
      tooltip: {
        fixed: {
          enabled: false,
        },
        x: {
          show: false,
        },
        y: {
          title: {
            formatter: function (seriesName) {
              return '';
            },
          },
        },
        marker: {
          show: false,
        },
      },
    };

    const chart = new ApexCharts(document.querySelector(selector), options);
    chart.render();
  }

  const table_sparkline_1_data = [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54];
  const table_sparkline_2_data = [12, 56, 21, 39, 73, 45, 64, 52, 36, 59, 44];
  const table_sparkline_3_data = [15, 46, 21, 59, 33, 15, 34, 42, 56, 19, 64];
  const table_sparkline_4_data = [30, 56, 31, 69, 43, 35, 24, 32, 46, 29, 64];
  const table_sparkline_5_data = [20, 76, 51, 79, 53, 35, 54, 22, 36, 49, 64];
  const table_sparkline_6_data = [5, 36, 11, 69, 23, 15, 14, 42, 26, 19, 44];
  const table_sparkline_7_data = [12, 56, 21, 39, 73, 45, 64, 52, 36, 59, 74];

  createSparklineChart('#table-sparkline-1', table_sparkline_1_data);
  createSparklineChart('#table-sparkline-2', table_sparkline_2_data);
  createSparklineChart('#table-sparkline-3', table_sparkline_3_data);
  createSparklineChart('#table-sparkline-4', table_sparkline_4_data);
  createSparklineChart('#table-sparkline-5', table_sparkline_5_data);
  createSparklineChart('#table-sparkline-6', table_sparkline_6_data);
  createSparklineChart('#table-sparkline-7', table_sparkline_7_data);

  //-------------
  // - PIE CHART -
  //-------------

  const pie_chart_options = {
    series: [700, 500, 400, 600, 300, 100],
    chart: {
      type: 'donut',
    },
    labels: ['Chrome', 'Edge', 'FireFox', 'Safari', 'Opera', 'IE'],
    dataLabels: {
      enabled: false,
    },
    colors: ['#0d6efd', '#20c997', '#ffc107', '#d63384', '#6f42c1', '#adb5bd'],
  };

  const pie_chart = new ApexCharts(document.querySelector('#pie-chart'), pie_chart_options);
  pie_chart.render();

  //-----------------
  // - END PIE CHART -
  //-----------------
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

    // $(document).ready(function () {
    //     // Initialize Flatpickr with both Date and Time picker
    //     flatpickr("#datetime", {
    //         enableTime: true,          // Enable time selection
    //         dateFormat: "Y-m-d H:i",   // Date and time format (24-hour)
    //         time_24hr: true,           // Use 24-hour time format
    //         minuteIncrement: 1,
    //         locale: 'th'         // Increment minutes by 1
    //     });
    // });
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

    setInterval(() => {
        location.reload();
    }, 80000);
</script>
<!--end::Script-->
</body>
<!--end::Body-->

</html>


