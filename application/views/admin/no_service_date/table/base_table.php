<link rel="stylesheet" href="<?= base_url('public/cdn/dataTable/css/twitter-bootstrap.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('public/cdn/dataTable/css/dataTables.bootstrap5.css') ?>">
<link rel="stylesheet" href="<?= base_url('public/cdn/dataTable/css/responsive.bootstrap5.css') ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
            <?= $this->load->view('admin/no_service_date/table/table_content', ['rows' => $rows], true); ?>
        </table>
    </div>

</div>

<div class="modal fade" id="EditDate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" id="modal-form" action="<?= base_url() ?>index.php/admin/add/submit"
        onsubmit="return add_admin(event)">
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


<div class="modal fade" id="AddDate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" id="modal-form-add-date" action="<?= base_url() ?>index.php/admin/system/date/holiday/submit"
        onsubmit="return add_holiday(event)">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มวันหยุด</h5>
                    <!-- Correctly add data-bs-dismiss="modal" to close the modal -->
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body  d-flex justify-content-center">
                    <div class="col-10 col-sm-10 pb-4 col-md-10 col-lg-10">
                        <div class="text-start">
                            <label class="" for="title">ชื่อวัน</label>
                            <input type="text" placeholder="โปรดใส่ชื่อวัน" name="title" class="form-control my-2"
                                id="title">
                        </div>
                        <div class="text-start">
                            <label class="" for="date">วันที่</label>
                            <input name="date" class="form-control w-50 flatpickrDay" id="date" type="date">
                        </div>
                        <div class="text-start d-flex flex-column mt-2">
                            <label class="" for="title">สี</label>
                            <input type="color" id="color" name="color" value="#ff0000">

                            <!-- Optional: Display the selected color -->
                            <div id="colorBox"
                                style="width:50px; height:50px; border-radius: 5px; margin-top:10px; border:1px solid #000; background-color: red;">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="modal" data-bs-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-primary" id="modal">เพิ่ม</button>
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

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/th.js"></script>

<!-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.bootstrap5.js"></script> -->

<script>


    // let table = new DataTable('#productTable');
    function intializingDataTable(table) {
        new DataTable(table, {
            responsive: true,

        });

    };

    intializingDataTable('#Table');

</script>
<script>
    flatpickr(".flatpickrDay", {
        // You can add custom options here, for example:
        dateFormat: "Y-m-d",
        locale: "th",
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

</script>
<script>
    const picker = document.getElementById('color');
    const box = document.getElementById('colorBox');

    picker.addEventListener('input', function () {
        box.style.backgroundColor = picker.value;
    });
</script>
<script>
    // ฟังก์ชันสาหรับแสดงกล่องยืนยัน ํ SweetAlert2
    function showDeleteConfirmation(date, title) {
        let text = '';
        if (title.includes("วัน")) {
            text = title;
        } else {
            text = 'วัน '+title;
        }
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: 'คุณแน่ใจใช่ใหมว่าจะลบ'+text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'ลบ',
            cancelButtonText: 'ยกเลิก',
            confirmButtonColor: '#d33', // red
            // cancelButtonColor: '#3085d6' // optional (blue)
        }).then((result) => {
            if (result.isConfirmed) {
                // หากผู้ใชยืนยัน ให ้ส ้ งค่าฟอร์มไปยัง ่ delete.php เพื่อลบข ้อมูล
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '<?= base_url("index.php/admin/system/date/holiday/delete/") ?>' + date;
                document.body.appendChild(form);
                form.submit();
            }
        });
    }




    document.addEventListener('click', function (event) {
        // ตรวจสอบว่าคลิกที่ปุ่มที่มีคลาส .delete-button หรือไม่
        if (event.target.classList.contains('delete-button')) {
            const button = event.target;
            const date = button.getAttribute('data-date');
            const title = button.getAttribute('data-title');
            showDeleteConfirmation(date, title);
        }
    });

</script>

<script>
    function add_holiday(event) {
        event.preventDefault(); // Prevent default form submission

        const title = $('#title').val(); // Get input value
        const date = $('#date').val();
        const color = $('#color').val();

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


        if (!title) {
            showSweet('warn', 'โปรดใส่ชื่อวัน')
            return false; // Stop execution if input is empty
        }
        if (!date) {
            showSweet('warn', 'โปรดเลือกวันที่จะเพิ่ม')
            return false; // Stop execution if input is empty
        }
        if (!color) {
            showSweet('warn', 'โปรดเลือกสี')
            return false; // Stop execution if input is empty
        }
        document.getElementById('modal-form-add-date').submit();
    }

</script>