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
    .modal-side {
        max-width: 400px; /* Adjust size as necessary */
        min-width: 400px;
        position: fixed;
        top: 0;
        right: 100px;
        bottom: 0;
        height: 100%;
        z-index: 9999;
        transform: translateX(100%);
        transition: transform 0.3s ease-in-out;
    }

    .modal.show .modal-side {
        transform: translateX(0);
    }

    /* Smooth transition during dragging */
    .modal-dialog {
        transition: transform 0.2s ease-in-out;
    }

    .modal-header {
        cursor: move; /* Make the header draggable */
    }
    .info-box-content {
        flex-grow: 1 !important;
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

<div class="">
    <table class="table table-striped nowrap" style="width:100%" id="Modal-table">

        <!-- <table class="table table-bordered" id="Table"> -->
        <?php

        echo $this->load->view('admin/reservation/outdate/table', [
            'rows' => $expired_rows,
            'url' => 'music'
        ], true); ?>
    </table>
</div>





<script src="<?= base_url('public/cdn/jQuery/jquery-3.7.1.js') ?>"></script>
<script src="<?= base_url('public/cdn/dataTables.min.js') ?>"></script>
<script src="<?= base_url('public/cdn/dataTable/js/responsive/dataTables.bootstrap5.js') ?>"></script>
<script src="<?= base_url('public/cdn/dataTable/js/responsive/dataTables.responsive.js') ?>"></script>
<script src="<?= base_url('public/cdn/dataTable/js/responsive/responsive.bootstrap5.js') ?>"></script>
<script src="<?= base_url('public/cdn/sweetaleart2@11.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url("public/assets/cdn/sweet2.min.css") ?>">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
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

    intializingDataTable('#Modal-table');

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
    
</script>
<script>
    // ฟังก์ชันสาหรับแสดงกล่องยืนยัน ํ SweetAlert2
    function showDeleteConfirmation(id, name) {
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: 'คุณแน่ใจใช่ใหมว่าจะปิดห้องของ ' + name + '?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'ปืด',
            cancelButtonText: 'ยกเลิก',
        }).then((result) => {
            if (result.isConfirmed) {
                // หากผู้ใชยืนยัน ให ้ส ้ งค่าฟอร์มไปยัง ่ delete.php เพื่อลบข ้อมูล
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '<?= base_url("index.php/admin/expire/reserv/$table/") ?>' + id;
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'id';
                input.value = id;
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
    // แนบตัวตรวจจับเหตุการณ์คลิกกับองค์ปุ่ มลบทั้งหมดที่มีคลาส delete-button
    const deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const get_id = button.getAttribute('data-user-id');
            const name = button.getAttribute('data-user-fullname');
            showDeleteConfirmation(get_id, name);
        });
    });
</script>

 <!-- Modal Structure 2 (Side Modal)--> 
<div class="modal fade" id="CheckExpire" tabindex="9999" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-side">
        <div class="modal-content">
            <div class="modal-header bg-primary" id="modal-header">
                <h5 class="modal-title" id="memberModalLabel">รายละเอียดการจอง</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>รหัสผู้ใช้:</strong> <span id="expired-uid"></span></p>
                <p><strong>ชื่อ-นามสกุล:</strong> <span id="expired-name"></span></p>
                <p><strong>หมายเลขห้อง:</strong> <span id="expired-r_numb"></span></p>
                <p><strong>จำนวนผู้เข้าใช้งาน:</strong> <span id="expired-people"></span></p>
                <p><strong>เวลาที่เริ่ม:</strong> <span id="expired-start"></span></p>
                <p><strong>หมดเวลา:</strong> <span id="expired-exp"></span></p>
                <p><strong>วันที่จอง:</strong> <span id="expired-date"></span></p>
                <p><strong>สถานะ:</strong> <span class="text-success" id="expired-status"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function () {
        // Get the base URL for AJAX requests
        $(".modal-dialog").draggable({
            handle: "#modal-header", // Only allow dragging from the header
            containment: "body", // Prevent dragging outside the body
            scroll: false, // Prevent scrolling while dragging
            helper: "original", // Use the original modal
            cursor: "move", // Change cursor to move during drag
            drag: function (event, ui) {
                ui.position.top = Math.max(0, ui.position.top); // Prevent dragging outside the viewport vertically
                ui.position.left = Math.max(0, ui.position.left); // Prevent dragging outside the viewport horizontally
            }
        });
        
        <?php $post_url = base_url("index.php/admin/view/"); ?>

        // Event delegation for dynamic content to handle 'view-expire-button' click
        $(document).on('click', '.view-expire-button', function () {
            const reserv_id = $(this).data('reserved-id');
            const r_id = $(this).data('r-id');
            const table = $(this).data('r-table');

            $.ajax({
                url: '<?= $post_url ?>' + table,
                type: 'POST',
                data: {
                    id: r_id,
                    reserved_id: reserv_id
                },
                success: function (response) {
                    const reserved = response; // Parse the JSON response to an object
                    console.log(reserved);

                    const status = reserved.r_verify == 1 ? 'ยืนยันแล้ว' : 'ยังไม่ยืนยัน';

                    // Set data into the modal's HTML
                    $('#expired-uid').text(reserved.st_id);
                    $('#expired-name').text(reserved.fullname);
                    $('#expired-r_numb').text(reserved.r_number);
                    $('#expired-people').text(reserved.total_pp + " คน");
                    $('#expired-start').text(reserved.start_time);
                    $('#expired-exp').text(reserved.exp_time);
                    $('#expired-date').text(reserved.r_date);
                    $('#expired-status').text(status);

                    // Show the 'CheckExpire' modal
                    $('#CheckExpire').modal('show');
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                    console.log("Response Text:", xhr.responseText);
                    try {
                        const jsonResponse = JSON.parse(xhr.responseText);
                        console.log("Parsed JSON:", jsonResponse);
                    } catch (e) {
                        console.error("Invalid JSON Response:", xhr.responseText);
                    }
                }
            });
        });

         // When #CheckExpire modal is closed, open #exampleModal modal
         $('#CheckExpire').on('hidden.bs.modal', function () {
            $('#exampleModal').modal('show');
        });

        // Make the modal draggable with smooth transitions
       
    });
</script>
