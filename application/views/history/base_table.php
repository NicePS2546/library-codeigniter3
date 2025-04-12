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
    .swal2-confirm{
        background-color: red;
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
    .table-title{
        font-size: 24px;
    }
    th,td{
        text-align: center;
    }
</style>

<div class="container">
    <div class="">
    <div class="table-title"><?= $table == 'old_history' ? 'ประวัติการเข้าใช้บริการ' : 'ข้อมูลการจอง' ?></div>
        <table class="table table-striped nowrap" style="width:100%" id="<?= $table ?>">

            <!-- <table class="table table-bordered" id="Table"> -->
            <?php
            
            if ($table === "current_history") {
                echo $this->load->view('history/section/current_history', [
                    'rows' => $current_history,
                    'url' => 'music'
                ], true);
            } else if ($table == "old_history") {
                echo $this->load->view('history/section/old_history', ['rows' => $old_history, 'url' => 'vdo'], true);
            } 
            ?>   
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
    // ฟังก์ชันสาหรับแสดงกล่องยืนยัน ํ SweetAlert2
    function showDeleteConfirmation(id,s_id,total_pp, name) {
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: 'คุณแน่ใจใช่ใหมว่าจะยกเลิกการจอง ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'ยกเลิก',
            cancelButtonText: 'ปิด',
        }).then((result) => {
            if (result.isConfirmed) {
                // หากผู้ใชยืนยัน ให ้ส ้ งค่าฟอร์มไปยัง ่ delete.php เพื่อลบข ้อมูล
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '<?= base_url("index.php/history/delete/") ?>'+s_id+'/'+ id;
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'total_pp';
                input.value = total_pp;
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
    // แนบตัวตรวจจับเหตุการณ์คลิกกับองค์ปุ่ มลบทั้งหมดที่มีคลาส delete-button
    // const deleteButtonsCurrent = document.querySelectorAll('.delete-button-current');
    // deleteButtonsCurrent.forEach((button) => {
    //     button.addEventListener('click', () => {
    //         const get_id = button.getAttribute('data-user-id');
    //         const name = button.getAttribute('data-user-fullname');
    //         showDeleteConfirmation(get_id, name);
    //     });
    // });

    // const deleteButtonsOld = document.querySelectorAll('.delete-button-old');
    // deleteButtonsOld.forEach((button) => {
    //     button.addEventListener('click', () => {
    //         const get_id = button.getAttribute('data-user-id');
    //         const name = button.getAttribute('data-user-fullname');
    //         showDeleteConfirmation(get_id, name);
    //     });
    // });



    document.addEventListener('DOMContentLoaded', () => {
    // Event delegation for both tables
    const currentTable = document.querySelector('#current_history');
    const oldTable = document.querySelector('#old_history');

    // Listen for click events in the current table
    currentTable.addEventListener('click', (event) => {
        const button = event.target.closest('button');  // Find the nearest button if the icon is clicked
        if (button && button.classList.contains('delete-button-current')) {
            const get_id = button.getAttribute('data-reserv-id');
            const get_s_id = button.getAttribute('data-s-id');
            const get_total_pp = button.getAttribute('data-total-pp');
            const name = button.getAttribute('data-user-fullname');
            showDeleteConfirmation(get_id,get_s_id,get_total_pp, name);
        }
    });

    // Listen for click events in the old table
    oldTable.addEventListener('click', (event) => {
        const button = event.target.closest('button');  // Find the nearest button if the icon is clicked
        if (button && button.classList.contains('delete-button-old')) {
            const get_id = button.getAttribute('data-user-id');
            const get_s_id = button.getAttribute('data-s-id');
            const name = button.getAttribute('data-user-fullname');
            showDeleteConfirmation(get_id,get_s_id, name);
        }
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
                <p><strong>รหัสผู้ใช้:</strong> <span id="reserved-uid"></span>
                </p>
                <p><strong>ชื่อ-นามสกุล:</strong> <span id="reserved-name"></span></p>
                <p><strong>หมายเลขห้อง:</strong> <span id="reserved-r_numb"></span></p>

                <p><strong>จำนวนผู้เข้าใช้งาน:</strong> <span id="reserved-people"></span></p>
                <p><strong>เวลาที่เริ่ม:</strong> <span id="reserved-start"></span></p>
                <p><strong>หมดเวลา:</strong> <span id="reserved-exp"></span></p>
                <p><strong>วันที่จอง:</strong> <span id="reserved-date"></span></p>
                <p><strong>สถานะ:</strong> <span class="text-success" id="reserved-status"></span></p>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
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