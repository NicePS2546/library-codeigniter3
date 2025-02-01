<link rel="stylesheet" href="<?= base_url('public/cdn/dataTable/css/twitter-bootstrap.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('public/cdn/dataTable/css/dataTables.bootstrap5.css') ?>">
<link rel="stylesheet" href="<?= base_url('public/cdn/dataTable/css/responsive.bootstrap5.css') ?>">

<style>

.nav-link {
    transition: transform ease-in-out 0.5s !important;
  }

  .nav-link:hover {
    transform: scale(1.08) !important;
    color: black !important;

  }

  .btn#modal {
    transition: all 250ms ease-in-out !important;

  }

  .btn#modal:hover {
    transform: scale(1.12) !important;
    transition: all 250ms ease-in-out !important;
  }

  .navbar-nav {
    margin: 0 auto !important;
    display: flex !important;
    justify-content: center !important;
    width: 100% !important;
  }

  .navbar-toggler {
    margin-left: auto !important;
    /* Push the hamburger icon to the right */
  }

  /* Optional: Custom styles if you want to tweak the appearance */
  .modal-header {
    background-color: #007bff !important;
    color: white !important;
  }

  /* Adjust Login button spacing */
  .btn-login {
    margin-left: auto !important;
    transition: transform 0.4s ease-in-out !important;
  }

  .btn-login:hover {
    transform: scale(1.04) !important;

  }

  .btn-admin {
    margin-left: auto !important;
    transition: transform 0.4s ease-in-out !important;
  }

  .btn-admin:hover {
    transform: scale(1.04) !important;

  }

  .shadow {
    box-shadow: 20px !important;

  }

  .fixed-nav {
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    right: 0;
    z-index: 1030 !important;
    /* Higher z-index to ensure it stays on top */
    width: 100% !important;
    /* Make sure the navbar spans the width of the viewport */
    z-index: 1020 !important;
    /* Ensures the navbar stays above other elements */
    background-color: #f8f9fa !important;
    /* Set a background color */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1) !important;
    /* Optional: Add a shadow for better visibility */
  }




  
    table#Table {
        border-collapse: separate;
        /* Separate borders for proper rounding */
        border-spacing: 0;
        /* Ensures no gaps between cells */
        border-radius: 6px !important;
        /* Apply overall rounded corners */
        overflow: hidden;
        /* Ensures content respects the border-radius */
    }

    table#Table thead th {
        text-align: center;
    }

    table#Table tbody td {
        border: 1px solid #ddd;
        text-align: center;
    }

    /* Top-left corner */
    table#Table thead tr:first-child th:first-child {
        border-top-left-radius: 6px !important;
    }

    /* Top-right corner */
    table#Table thead tr:first-child th:last-child {
        border-top-right-radius: 6px !important;
    }

    /* Bottom-left corner */
    table#Table tbody tr:last-child td:first-child {
        border-bottom-left-radius: 6px !important;
    }

    /* Bottom-right corner */
    table#Table tbody tr:last-child td:last-child {
        border-bottom-right-radius: 6px !important;
    }
</style>
<div class="container">
    <?php if (!empty($rows)) {
        ?>

        <div class="">
            <table class="table table-striped nowrap" style="width:100%" id="Table">
                <!-- <table class="table table-bordered" id="Table"> -->

                <?php
                if ($table === "music") {
                    echo $this->load->view('component/table/music', ['rows' => $rows], true);
                } ?>
            </table>
        </div>

    </div>
    <?php
    } else {
        echo $this->load->view('component/table/no_data', ['page' => 'music'], true);
    } ?>

<script src="<?= base_url('public/cdn/jQuery/jquery-3.7.1.js') ?>"></script>
<script src="<?= base_url('public/cdn/dataTables.min.js') ?>"></script>
<script src="<?= base_url('public/cdn/dataTable/js/responsive/dataTables.bootstrap5.js')?>"></script>
<script src="<?= base_url('public/cdn/dataTable/js/responsive/dataTables.responsive.js')?>"></script>
<script src="<?= base_url('public/cdn/dataTable/js/responsive/responsive.bootstrap5.js')?>"></script>



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

    intializingDataTable('#Table');


</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        setInterval(() => {
            const className = <?= !empty($rooms) ? "'.ani-element'" : "'.notFound'" ?>;
            const elements = document.querySelectorAll(className);
            console.log("Selected elements:", elements);
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