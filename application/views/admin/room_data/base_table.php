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
</style>

<div class="container">
    <div class="">
        <table class="table table-striped nowrap" style="width:100%" id="Table">

            <!-- <table class="table table-bordered" id="Table"> -->
            <?php

            if ($table === "music") {
                echo $this->load->view('admin/room_data/room/music', [
                    'rows' => $rows,
                    'url' => 'music'
                ], true);
            } else if ($table == "vdo") {
                echo $this->load->view('admin/room_data/room/vdo', ['rows' => $rows, 'url' => 'vdo'], true);
            } else if ($table == "mini") {
                echo $this->load->view('admin/room_data/room/mini', ['rows' => $rows, 'url' => 'mini'], true);
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
    setInterval(() => {
        location.reload();
    }, 180000);
</script>

<script>
    function showDeleteConfirmation(r_id) {
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่?',
        text: 'คุณแน่ใจใช่ไหมว่าจะลบห้องหมายเลขที่ ' + r_id + '?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ลบ',
        cancelButtonText: 'ยกเลิก',
    }).then((result) => {
        if (result.isConfirmed) {
            // หากผู้ใช้ยืนยัน ให้ส่งค่าฟอร์มไปยัง delete.php เพื่อลบข้อมูล
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '<?= base_url("index.php/admin/remove/room/$table/") ?>' + r_id; // ใช้ r_id ที่รับมา
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'id';
            input.value = r_id; // ใช้ r_id ที่รับมา
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    });
}

// แนบตัวตรวจจับเหตุการณ์คลิกกับปุ่มลบทั้งหมดที่มีคลาส delete-button
document.querySelectorAll('.delete-button').forEach((button) => {
    button.addEventListener('click', () => {
        const r_id = button.getAttribute('data-r-id'); // ใช้ r_id ให้ตรงกัน
        showDeleteConfirmation(r_id);
    });
});
</script>

<div class="modal fade" id="reservedModal" tabindex="-1" arialabelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="memberModalLabel">รายละเอียดข้อมูลห้อง</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex flex-column">
                <!-- แสดงรายละเอียดข้อมูลใน Modal -->
                <p><strong>หมายเลขห้อง:</strong> <span id="room-numb"></span></p>
                <p><strong>คำอธิบายห้อง:</strong> <span id="room-desc"></span></p>
                <p><strong>คำอธิบายตอนปิดห้อง: </strong> <span id="room-close-desc"></span></p>
                <p><strong>สถานะ:</strong> <span id="room-status"></span></p>
                <p><strong>วันที่สร้าง:</strong> <span id="room-date"></span></p>
                <p><strong>รูปห้อง:</strong></p>
                <!-- รูปถ่าย -->
                <img class="" style="margin:auto;" id="room-img" width="200px"  src="" alt="รูปภาพสมาชิก" class="img-fluid">
                

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        <?php $post_url = base_url("index.php/admin/room/view/"); ?>
        
        // เมื่อคลิกปุ่ ม View
        $('.view-room-button').on('click', function () {

            const r_id = $(this).data('r-id');
            const table = $(this).data('table');
            console.log('<?= $post_url ?>')
            $.ajax({ // ส่ง AJAX
                url: '<?= $post_url ?>'+table,
                type: 'POST', // ใช้เมธอด POST
                data: { // ส่งข้อมูลไปด้วย
                    r_id: r_id,
                },
                success: function (response) { // ถ้าสําเร็จ
                    // นําข้อมูลที่ได้มาแสดงใน Modal
                    const reserved = response; // แปลงข้อความ JSON ให้กลายเป็นObject
                    console.log(reserved);
                    const img = '<?= base_url('public/assets/img/room_img/') ?>' + reserved.r_img;
            
                    const status = reserved.r_status == 1 ? ' เปิดใช้งาน' : ' ปิดใช้งาน';
                    const close_desc = reserved.r_close_desc ? reserved.r_close_desc : 'ยังไม่ได้ตั้ง';
                    $('#room-numb').text(reserved.r_number); // แสดงข้อมูลใน Modal โดยใช้ ID ของแต่ละข้อมูล
                    $('#room-desc').text(reserved.r_desc);
                    $('#room-close-desc').text(close_desc);
                    $('#room-status').text(status);
                    $('#room-date').text(reserved.created_at);
                    $('#room-img').attr("src",img);
                    
                    if (reserved.r_status == 1) {
                        $('#room-status').removeClass('text-danger').addClass('text-success');
                    } else {
                        $('#room-status').removeClass('text-success').addClass('text-danger');
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