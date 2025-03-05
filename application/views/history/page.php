<?php

$music = $statistic['music'];
$vdo = $statistic['vdo'];
$mini = $statistic['mini'];
$card_res = "col-12 col-sm-2 col-md-2 col-lg-1";
$u_data = $this->session->userdata('userData');
?>
<link rel="stylesheet" href="<?= base_url('public/admin/dist/css/adminlte.css') ?>" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
<style>
    body{
        padding-top: 0px !important;
    }
    .font-title {
        font-size: 32px;
        text-align: start;
    }
    .font-user-data {
        font-size: 24px;
        text-align: start;
    }
   
    .fixed-height {
        min-height: 100vh;
    }

    .chart-container {
        display: flex;
        justify-content: center;
    }

    .type-selector {
        display: flex !important;

        align-items: center;
    }

    @media (min-width: 992px) {

        /* Large devices (lg) and up */
        .col-md-2 {
            flex: 0 0 7% !important;
            max-width: 7% !important;
        }

        .col-lg-1 {
            flex: 0 0 10% !important;
            max-width: 10% !important;
        }

        .col-sm-2 {
            flex: 0 0 10% !important;
            max-width: 10% !important;
        }
    }

    @media (max-width: 575px) {
        /* Large devices (lg) and up */

        .col-md-2 {
            flex: 0 0 20% !important;
            max-width: 20% !important;
        }

        .col-sm-2 {
            flex: 0 0 20% !important;
            max-width: 20% !important;
        }
    }

    @media (max-width: 450px) {
        /* Large devices (lg) and up */

        .col-md-2 {
            flex: 0 0 30% !important;
            max-width: 30% !important;
        }

    }

    .info-box-icon {
        position: relative;
        /* Needed for absolute positioning */
    }

    /* Tooltip text (hidden by default) */
    .info-box-icon::after {
        content: attr(data-label);
        /* Get text from data-label */
        position: absolute;
        bottom: 120%;
        /* Position above button */
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0, 0, 0, 0.75);
        color: #fff;
        padding: 6px 10px;
        border-radius: 4px;
        font-size: 14px;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease-in-out;
    }

    /* Show tooltip on hover */
    .info-box-icon:hover::after {
        opacity: 1;
        visibility: visible;
    }

    #add_admin {
        width: 150px;
    }
</style>
<div class="container">
    <div class="row col-lg-12">
<div class="col-md-12">
        <div class="info-box ">
            <div class="info-box-content title-container">
                <span class="info-box-text font-title">ข้อมูลส่วนตัว</span>

            </div>
        </div>
</div>

<div class="col-md-12">
        <div class="info-box ">
            <div class="info-box-content font-user-data ">
                <span class="info-box-text">ชื่อ-นามสกุล: <?= $u_data['fullname']  ?></span>
                <span class="info-box-text ">รหัสผู้ใช้: <?= $u_data['uid']  ?></span>

            </div>
        </div>
</div>


        <div class="col-md-12 ">
            <div class="info-box ">
                <div class="info-box-content">
                    <div>
                     
                        <?= $this->load->view('history/base_table', ['table' => 'current_history'], true) ?>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-12 ">
            <div class="info-box ">
                <div class="info-box-content">
                    <div>
                        <?= $this->load->view('history/base_table', ['table' => 'old_history'], true) ?>
                    </div>
                </div>
            </div>

        </div>


    </div>
</div>
<!-- /.col -->

<!-- <div class="col-md-12">
  <div class="info-box">
    <div class="info-box-content">
     
      <div id="chart">
      </div>
      
    </div>
  </div>
</div> -->



<script src="<?= base_url('public/cdn/jQuery/jquery-3.7.1.js') ?>"></script>
<script src="<?= base_url('public/cdn/dataTables.min.js') ?>"></script>
<script src="<?= base_url('public/cdn/dataTable/js/responsive/dataTables.bootstrap5.js') ?>"></script>
<script src="<?= base_url('public/cdn/dataTable/js/responsive/dataTables.responsive.js') ?>"></script>
<script src="<?= base_url('public/cdn/dataTable/js/responsive/responsive.bootstrap5.js') ?>"></script>
<script src="<?= base_url('public/cdn/sweetaleart2@11.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url("public/assets/cdn/sweet2.min.css") ?>">

<!-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.bootstrap5.js"></script> -->

<script>
    // let table = new DataTable('#productTable');
    function intializingDataTable(table) {
        new DataTable(table, {
            responsive: true
        });

    };

    intializingDataTable('#current_history');
    intializingDataTable('#old_history');

</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        setInterval(() => {
            const className = <?= !empty($rooms) ? "'.ani-element'" : "'.notFound'" ?>;
            const elements = document.querySelectorAll(className);

            elements.forEach((el, index) => {
                // Delay each element by a factor of its index (300ms = 0.3 second per element)
                setTimeout(() => {
                    el.classList.add('visible', 'animate__animated', 'animate__fadeInUp');
                }, index * 300); // The delay increases for each element
            });
        }, 500);
    });
    // Reload the page every 60,000 milliseconds (1 minute)
    setInterval(() => {
        location.reload();
    }, 60000);
</script>


