<link rel="stylesheet" href="<?= base_url('public/cdn/dataTable/css/twitter-bootstrap.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('public/cdn/dataTable/css/dataTables.bootstrap5.css') ?>">
<link rel="stylesheet" href="<?= base_url('public/cdn/dataTable/css/responsive.bootstrap5.css') ?>">

<style>
    @media (min-width: 992px) and (max-width: 1199px) {
        .col-lg-3 {
            flex: 0 0 50%;
            /* 50% width for 2 cards in a row */
            max-width: 50%;
        }
    }

    .info-box {
        display: flex !important;
        align-items: center !important;
        text-align: center !important;
    }

    .info-box-content {
        flex-grow: 1 !important;
    }

    /* .mdtp__wrapper {
    top: 1% !important;
    left: 50% !important;
    position: absolute !important;
    
} */

    .mdtp__wrapper {
        position: fixed !important;
        /* Fixed to center on the screen */
        top: 50% !important;
        left: 50% !important;
        transform: translate(-50%, -50%) scale(1) !important;
        /* Ensures perfect centering */
        bottom: auto !important;
        /* Remove bottom constraint */
        opacity: 1 !important;
        min-width: 280px;
        z-index: 9999 !important;
        /* Ensures it appears above everything */
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
    <div class="">
        <table class="table table-striped nowrap" style="width:100%" id="Table">

            <!-- <table class="table table-bordered" id="Table"> -->
            <?php

            if ($table === "time") {
                echo $this->load->view('admin/time_setting/time_table', [
                    'rows' => $rows,
                    'url' => 'music'
                ], true);
            }
            ?>
        </table>
    </div>

</div>


<!-- Load Styles -->

<link rel="stylesheet" href="<?= base_url("public/assets/cdn/sweet2.min.css") ?>">

<!-- Load jQuery First -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Load MDTimePicker -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/dmuy/MDTimePicker/mdtimepicker.min.css">
<script src="https://cdn.jsdelivr.net/gh/dmuy/MDTimePicker/mdtimepicker.min.js"></script>

<!-- Other Libraries -->
<script src="<?= base_url('public/cdn/dataTables.min.js') ?>"></script>
<script src="<?= base_url('public/cdn/dataTable/js/responsive/dataTables.bootstrap5.js') ?>"></script>
<script src="<?= base_url('public/cdn/dataTable/js/responsive/dataTables.responsive.js') ?>"></script>
<script src="<?= base_url('public/cdn/dataTable/js/responsive/responsive.bootstrap5.js') ?>"></script>
<script src="<?= base_url('public/cdn/sweetaleart2@11.js') ?>"></script>
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
    $(document).ready(function () {
        console.log("jQuery Loaded:", !!window.jQuery);
        console.log("MDTimePicker Loaded:", !!$.fn.mdtimepicker);

        if ($.fn.mdtimepicker) {
            $('#timepicker_start').mdtimepicker({
                theme: 'dark',
                format: 'hh:mm tt',
                hourPadding: true
            });
            $('#timepicker_end').mdtimepicker({
                theme: 'dark',
                format: 'hh:mm tt',
                hourPadding: true
            });
        } else {
            console.error("MDTimePicker failed to load!");
        }
    });


</script>

<div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" id="modal-form" action="<?= base_url() ?>index.php/admin/time/setting/submit"
        onsubmit="return update_time(event)">
        <input type="hidden" id="s_id" name="s_id" value="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขเวลา</h5>
                    <!-- Correctly add data-bs-dismiss="modal" to close the modal -->
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body  d-flex justify-content-center">
                    <div class="col-10 col-sm-10 pb-4 col-md-10 col-lg-10 text-start">

                        <div class="d-flex gap-4">
                            <div class="col-lg-6">
                                <label for="st_id">เลือกเวลาเริ่มจอง</label>
                                <div class="input-group">
                                    <input type="text" id="timepicker_start" name="t_start" class="form-control"
                                        placeholder="Select a time">
                                    <label for="timepicker_start" class="input-group-text">
                                        <i class="bi bi-clock"></i> <!-- Bootstrap Icon -->
                                    </label>
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <label for="st_id">เลือกเวลาสิ้นสุดการจอง</label>
                                <div class="input-group">
                                    <input type="text" id="timepicker_end" name="t_end" class="form-control"
                                        placeholder="Select a time">
                                    <label for="timepicker_end" class="input-group-text">
                                        <i class="bi bi-clock"></i> <!-- Bootstrap Icon -->
                                    </label>
                                </div>

                            </div>
                        </div>
                        <div>
                            <label for="interval_time">ช่วงเวลาการจอง</label>
                            <input type="number" placeholder="โปรดใส่ช่วงเวลาการจอง" name="interval_time" class="form-control my-2"
                                id="interval_time">
                        </div>
                        
                        <!-- <div id="results" class="mt-3">
                          
                        </div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="modal" data-bs-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-primary" id="modal">แก้ไขเวลา</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function () {
        $('.edit-time-button').click(function () {
            var s_id = $(this).data('s-id'); // Get s_id from button
            var start = $(this).data('t-start'); // Get s_id from button
            var end = $(this).data('t-end'); // Get s_id from button
            var interval_time = $(this).data('t-interval'); // Get s_id from button
            $('#s_id').val(s_id); // Set s_id in the hidden input
            $('#timepicker_start').val(start); // Set s_id in the hidden input
            $('#timepicker_end').val(end); // Set s_id in the hidden input
            $('#interval_time').val(interval_time); // Set s_id in the hidden input
        });
    });

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
    function update_time(event) {
        event.preventDefault(); // Prevent default form submission

        const time_start = $('#timepicker_start').val(); 
        const time_end = $('#timepicker_end').val();
        const interval_time = $('#interval_time').val();
        

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


        if (!time_start) {
            showSweet('warn', 'โปรดใส่เวลาเริ่มจองห้อง')
            return false; // Stop execution if input is empty
        } else if (!time_end) {
            showSweet('warn', 'โปรดใส่เวลาสิ้นสุดจองห้อง')
            return false; // Stop execution if input is empty
        } else if (!interval_time) {
            showSweet('warn', 'โปรดเลือกช่วงเวลาการจอง')
            return false; // Stop execution if input is empty
        } 
        Toast.fire({
            icon: "success",
            title: "กำลังดำเนินการ"
        });
        setTimeout(function () {
            document.getElementById('modal-form').submit(); // Submit the form
        }, 800); // Wait 2 seconds (2000ms)
        // document.getElementById('modal-form').submit(); // Submit the form

      
    }

</script>