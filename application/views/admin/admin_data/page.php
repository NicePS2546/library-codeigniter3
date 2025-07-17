<?php

$music = $statistic['music'];
$vdo = $statistic['vdo'];
$mini = $statistic['mini'];
$card_res = "col-12 col-sm-2 col-md-2 col-lg-1";
?>

<style>
    .font-title {
        font-size: 32px;
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

<div class="info-box">
    <div class="info-box-content title-container">
        <span class="info-box-text font-title"><?= $title ?></span>
        <button class="btn my-auto btn-primary" style="width:120px" data-bs-toggle="modal"
            data-bs-target="#exampleModal">เพิ่มแอดมิน</button>

    </div>
</div>

<div class="col-md-12 ">
    <div class="info-box ">
        <div class="info-box-content">
            <div>
                <?= $this->load->view('admin/admin_data/base_table', ['table' => $table], true) ?>
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

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" id="modal-form" action="<?= base_url() ?>index.php/admin/add/submit" onsubmit="return add_admin(event)">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มผู้ดูแล</h5>
                    <!-- Correctly add data-bs-dismiss="modal" to close the modal -->
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body  d-flex justify-content-center">
                    <div class="col-10 col-sm-10 pb-4 col-md-10 col-lg-10">
                        <div class="text-center">
                            <img src="<?= base_url("public/assets/img/logo.png") ?>" class="rounded rounded-circle"
                                width="150" height="150" alt="logo">
                        </div>
                        <div>
                            <label for="st_id">รหัสผู้ใช้</label>
                            <input type="text" placeholder="โปรดใส่รหัสผู้ใช้" name="uid" class="form-control my-2"
                                id="st_id1">
                        </div>
                        <div id="results" class="mt-3">
                            <!-- Fetched results will appear here -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="modal" data-bs-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-primary" id="modal">เพิ่มผู้ดูแล</button>
                </div>
            </div>
        </div>
    </form>
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
    }, 60000);
</script>

<script>
    // ฟังก์ชันสาหรับแสดงกล่องยืนยัน ํ SweetAlert2
    function showDeleteConfirmation(id, name, url,msg,status) {
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: msg + name + '?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: status == 1 ? 'ปิด' : 'เปิด',
            cancelButtonText: 'ยกเลิก',
        }).then((result) => {
            if (result.isConfirmed) {
                // หากผู้ใชยืนยัน ให ้ส ้ งค่าฟอร์มไปยัง ่ delete.php เพื่อลบข ้อมูล
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = url + id;
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
            const status = button.getAttribute('data-status');
            if(status == 1){
                showDeleteConfirmation(get_id, name,'<?= base_url("index.php/admin/suspend/") ?>','คุณแน่ใจใช่ใหมว่าจะปิดการใช้งานผู้ดูแล ',status);
            }else{
                showDeleteConfirmation(get_id, name,'<?= base_url("index.php/admin/active/") ?>','คุณแน่ใจใช่ใหมว่าจะเปิดการใช้งานผู้ดูแล ',status);
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

<script>
      let typingTimer; // Timer identifier
    const doneTypingInterval = 500; // Set the time delay for detecting stop typing (500ms)
    $('#st_id1').on('input', function () {
        const query = $(this).val();  // Get the input value
        const result = $('#results');
       
        result.html('<p class="card py-2 px-2 w-50 text-center">กำลังโหลดผู้ใช้....</p>'); // Show loading message

        // Clear the previous timer
        clearTimeout(typingTimer);

        // Start a new timer
        typingTimer = setTimeout(function () {
            if (query.length > 0) {
                // Make the AJAX request
                $.ajax({
                    url: '<?= site_url('music/get/user') ?>',  // Mock API endpoint
                    type: 'POST',
                    data: { uid: query,reserv:1 },
                    success: function (response) {
                        // Parse the JSON response
                        const data = JSON.parse(response);
                        console.log(data);
                        const results = data.userdata;
                        let output = '';

                        // Check the message from the API response
                        if (data.message == "Success") {
                            // Display the full name if successful
                            output = `<p class="card border-success py-2 px-2 w-75 d-flex align-items-center text-center">${results.fullname}</p>`;
                        } else if (data.message == "fail") {
                            // Show message if no results
                            output = '<div class="card border-danger text-center py-2 px-2 w-75"><div>ไม่เจอผู้ใช้ในระบบ <a href="https://sso.npru.ac.th/">สมัครตรงนี้</a></div></div>';
                        }

                        // Display the results in the result div
                        result.html(output);
                    },
                    error: function () {
                        result.html('<p class="card text-danger py-2 px-2 w-50 text-center">ระบบขัดข้องโปรดติดต่อเจ้าหน้าที่</p>');
                    }
                });
            } else {
                result.html(''); // Clear results if input is empty
            }
        }, doneTypingInterval); // Set the delay time for the API request
    });
</script>

<script>
    function add_admin(event) {
        event.preventDefault(); // Prevent default form submission

        const query = $('#st_id1').val(); // Get input value
        const total = $('#total').val();

        console.log(query)
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


        if (!query) {
            showSweet('warn','โปรดใส่รหัสผู้ใช้')
            return false; // Stop execution if input is empty
        }


        // AJAX call
        $.ajax({
            url: '<?= site_url("music/get/user") ?>', // API endpoint
            type: 'POST',
            data: { uid: query },
            success: function (response) {
                const data = JSON.parse(response);

                if (data.message === "fail" || !data.userdata) {

                    showSweet('warn', 'ไม่พบผู้ใช้งาน') // Show error toast
                    return false; // Stop execution if validation fails
                }

                Toast.fire({
                    icon: "success",
                    title: "กำลังดำเนินการ"
                });
                setTimeout(function () {
                    document.getElementById('modal-form').submit(); // Submit the form
                }, 800); // Wait 2 seconds (2000ms)
            },
            error: function () {
                showSweet('error', 'เว็บไซต์ขัดข้องโปรดติดต่อเจ้าหน้าที่')
                return false; // Stop execution on error
            }
        });

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
        }else if(status == 'warn') {
            Swal.fire({
                title: title ? title : "แจ้งเตือน",
                text: msg,
                icon: 'warning',
                confirmButtonText: 'โอเค'
            });
        }else {
            Swal.fire({
                title: title ? title : "ผิดพลาด",
                text: msg,
                icon: 'error',
                confirmButtonText: 'โอเค'
            });
        }
    }
    function showToast(message, type = 'success') {
        const toast = document.getElementById('liveToast');
        const toastBody = toast.querySelector('.toast-body');
        const toastHeader = toast.querySelector('.toast-header');

        // Set the message
        toastBody.textContent = message;

        // Customize based on type
        if (type === 'success') {
            toast.classList.remove('text-danger');
        } else if (type === 'error') {
            toast.classList.add('text-danger');

        }

        // Use Bootstrap's Toast functionality
        const bootstrapToast = new bootstrap.Toast(toast);
        bootstrapToast.show();
    }
</script>