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

    /* Ensure modal backdrop and modal-dialog of Modal 1 are in the correct stack */
    #exampleModal .modal-backdrop {
        z-index: 1040 !important;
    }

    #exampleModal .modal-dialog {
        z-index: 1050 !important;
    }

    /* Set a higher z-index for Modal 2 to ensure it comes in front of Modal 1 */
    #CheckExpire .modal-dialog {
        z-index: 9999 !important;
        position: fixed !important;
    }

    .head-outdate {
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
    }
</style>

<div class="container">
    <div class="">
        <table class="table table-striped nowrap" style="width:100%" id="Table">

            <!-- <table class="table table-bordered" id="Table"> -->
            <?php

            if ($table === "music") {
                echo $this->load->view('admin/reservation/music', [
                    'rows' => $rows,
                    'url' => 'music'
                ], true);
            } else if ($table == "vdo") {
                echo $this->load->view('admin/reservation/vdo', ['rows' => $rows, 'url' => 'vdo'], true);
            } else if ($table == "mini") {
                echo $this->load->view('admin/reservation/mini', ['rows' => $rows, 'url' => 'mini'], true);
            } else if ($table == 'admin_data') {
                echo $this->load->view('admin/admin_data/table', ['rows' => $rows, 'url' => 'admin_data'], true);
            } ?>
        </table>
    </div>

</div>



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

    intializingDataTable('#Table');

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

    function showDeleteAllConfirmation(table) {
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: 'คุณแน่ใจใช่ใหมว่าจะลบทั้งหมด ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'ลบ',
            cancelButtonText: 'ยกเลิก',
        }).then((result) => {
            if (result.isConfirmed) {
                // หากผู้ใชยืนยัน ให ้ส ้ งค่าฟอร์มไปยัง ่ delete.php เพื่อลบข ้อมูล
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '<?= base_url("index.php/admin/update/deleteAll/reserv") ?>';
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'table';
                input.value = table;
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

    const deleteAllBtn = document.querySelectorAll('.delete-all-btn');
    console.log(deleteAllBtn);
    deleteAllBtn.forEach((button) => {
        button.addEventListener('click', () => {
            const table = button.getAttribute('data-table');
            showDeleteAllConfirmation(table);
        });
    });
</script>

<div class="modal fade" id="reservedModal" tabindex="-1" arialabelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="memberModalLabel">รายละเอียดการจอง</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex flex-column">
                <!-- แสดงรายละเอียดข้อมูลใน Modal -->
                <p><strong>รหัสผู้ใช้: </strong> <span id="reserved-uid"></span>
                </p>
                <p><strong>ชื่อ-นามสกุล: </strong> <span id="reserved-name"></span></p>
                <p><strong>หมายเลขห้อง: </strong> <span id="reserved-r_numb"></span></p>

                <p><strong>จำนวนผู้เข้าใช้งาน:</strong> <span id="reserved-people"></span></p>
                <p><strong>เวลาที่เริ่ม: </strong> <span id="reserved-start"></span></p>
                <p><strong>หมดเวลา: </strong> <span id="reserved-exp"></span></p>
                <p><strong>วันที่จอง: </strong> <span id="reserved-date"></span></p>
                <p><strong>สถานะ: </strong> <span class="" id="reserved-status"></span></p>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal Structure -->
<div class="modal fade" id="exampleModal" tabindex="-200" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div id="modal-form">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="margin-left: 10px; margin-right: 10px;">
                    <h5 class="modal-title" id="exampleModalLabel">การจองที่หมดอายุ</h5> <button
                        data-table="<?= $table ?>" class="btn delete-all-btn btn-danger">ลบทั้งหมด</button>
                    <!-- Correctly add data-bs-dismiss="modal" to close the modal -->
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body d-flex justify-content-center">
                    <div class="col-10 col-sm-10 pb-4 col-md-10 col-lg-10">
                        <?= $this->load->view('admin/component/outdate/base_modal_table', ['rows' => $rows], true) ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="modal" data-bs-dismiss="modal">ปิด</button>


                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        <?php $post_url = base_url("index.php/admin/view/$table"); ?>
        // เมื่อคลิกปุ่ ม View
        $('.view-reserved-button').on('click', function () {
            const reserv_id = $(this).data('reserved-id');
            const r_id = $(this).data('r-id');
            console.log('<?= $post_url ?>')
            $.ajax({ // ส่ง AJAX
                url: '<?= $post_url ?>',
                type: 'POST', // ใช้เมธอด POST
                data: { // ส่งข้อมูลไปด้วย
                    id: r_id,
                    reserved_id: reserv_id
                },
                success: function (response) { // ถ้าสําเร็จ
                    // นําข้อมูลที่ได้มาแสดงใน Modal
                    const reserved = response; // แปลงข้อความ JSON ให้กลายเป็นObject
                    console.log(reserved);
                    const status = reserved.r_verify == 1 ? 'ยืนยันแล้ว' : 'ยังไม่ยืนยัน';
                    $('#reserved-uid').text(reserved.st_id); // แสดงข้อมูลใน Modal โดยใช้ ID ของแต่ละข้อมูล
                    $('#reserved-name').text(reserved.fullname);
                    $('#reserved-r_numb').text(reserved.r_number);
                    $('#reserved-people').text(reserved.total_pp + " คน");
                    $('#reserved-start').text(reserved.start_time);
                    $('#reserved-exp').text(reserved.exp_time);
                    $('#reserved-date').text(reserved.r_date);
                    $('#reserved-status').text(status);

                    if (reserved.r_verify == 1) {
                        $('#reserved-status').removeClass('text-danger').addClass('text-success');
                    } else {
                        $('#reserved-status').removeClass('text-success').addClass('text-danger');
                    }
                    $('#reservedModal').modal('show'); // แสดง Modal
                    
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

    });


</script>