<style>
    @keyframes bounceIn {
        0% {
            transform: scale(0);
            opacity: 0;
        }

        50% {
            transform: scale(1.1);
            opacity: 1;
        }

        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    #result {
        animation: bounceIn 0.5s ease-out;
    }

    .ani-element {
        opacity: 0;
    }

    .ani-element.visible {
        opacity: 1;
        transition: opacity 0.3s ease-in;
    }
</style>

<div class="container">
    <div class="col-12 col-sm-8 pb-4 col-md-6 col-lg-10 mt-4 mx-auto ani-element">
<?php print($r_id) ?>
        <form class="text-end" action="<?php echo base_url('index.php/admin/room/edit/submit'); ?>"  id="formId"
            onsubmit="return update_room(event)" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="r_id" value="<?= $r_id ?>">
            <input type="hidden" name="type" value="<?= $type ?>">
            <?= $this->load->view('admin/room_data/room/component/form_content', ['row' => $row], true) ?>

        </form>
    </div>
</div>


<script src="<?= base_url('public/cdn/jQuery/jquery-3.6.0.min.js') ?>"></script>




<script>

    document.addEventListener("DOMContentLoaded", function () {
        setInterval(() => {
            const className = '.ani-element';
            const elements = document.querySelectorAll(className);

            elements.forEach((el, index) => {
                // Delay each element by a factor of its index (300ms = 0.3 second per element)
                setTimeout(() => {
                    el.classList.add('visible');
                }, index * 300); // The delay increases for each element
            });
        }, 500);
    });

    let typingTimer; // Timer identifier
    const doneTypingInterval = 500; // Set the time delay for detecting stop typing (500ms)

    $('#st_id1').on('input', function () {
        const query = $(this).val();  // Get the input value
        const result = $('#result');

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
                    data: { uid: query, reserv: 1 },
                    success: function (response) {
                        // Parse the JSON response
                        const data = JSON.parse(response);
                        console.log(data);
                        const results = data.userdata;
                        let output = '';

                        // Check the message from the API response
                        if (data.message == "Success") {
                            // Display the full name if successful
                            output = `<p class="card border-success py-2 px-2 w-50 d-flex align-items-center text-center">${results.fullname}</p>`;
                        } else if (data.message == "fail") {
                            // Show message if no results
                            output = '<div class="card border-danger text-center py-2 px-2 w-50"><div>ไม่เจอผู้ใช้ในระบบ <a href="https://sso.npru.ac.th/">สมัครตรงนี้</a></div></div>';
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

    $(document).ready(function () {
        // Initial check to set the class based on the selected option
        updateClassBasedOnStatus();

        // Listen for change events on the select element
        $('#status').change(function () {
            updateClassBasedOnStatus();
        });

        // Function to update the class of the select element
        function updateClassBasedOnStatus() {
            var statusValue = $('#status').val(); // Get the current value of the select
            if (statusValue == '1') {
                $('#status').removeClass('text-danger').addClass('text-success');
            } else {
                $('#status').removeClass('text-success').addClass('text-danger');
            }
        }
    });

    function update_room(event) {
        event.preventDefault(); // Prevent default form submission

        const r_number = $('#r_numb').val(); // Get input value
        const r_status = $('#status').val();
        const r_desc = $('#r_desc').val();
        const r_close_desc = $('#r_close_desc').val();
        console.log(r_status)

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


        if (!r_number) {
            showSweet('warn', 'โปรดใส่หมายเลขห้อง')
            return false; // Stop execution if input is empty
        } else if (!r_desc) {
            showSweet('warn', 'โปรดใส่คำอธิบายห้อง')
            return false; // Stop execution if input is empty
        } else if (!r_status) {
            showSweet('warn', 'โปรดเลือกสถานะห้อง')
            return false; // Stop execution if input is empty
        } else if (!r_close_desc && r_status == 0) {
            showSweet('warn', 'โปรดใส่คำอธิบายการปิดห้อง')
            return false; // Stop execution if input is empty
        }
        Toast.fire({
            icon: "success",
            title: "กำลังดำเนินการ"
        });
        setTimeout(function () {
            document.getElementById('formId').submit(); // Submit the form
        }, 800); // Wait 2 seconds (2000ms)
        document.getElementById('formId').submit(); // Submit the form

        // AJAX call
        // $.ajax({
        //     url: '<?= site_url("music/get/user") ?>', // API endpoint
        //     type: 'POST',
        //     data: { uid: query },
        //     success: function (response) {
        //         const data = JSON.parse(response);

        //         if (data.message === "fail" || !data.userdata) {

        //             showSweet('warn', 'ไม่พบผู้ใช้งาน') // Show error toast
        //             return false; // Stop execution if validation fails
        //         }

        //         Toast.fire({
        //             icon: "success",
        //             title: "กำลังดำเนินการ"
        //         });
        //         setTimeout(function () {
        //             document.getElementById('formId').submit(); // Submit the form
        //         }, 800); // Wait 2 seconds (2000ms)
        //     },
        //     error: function () {
        //         showSweet('error', 'เว็บไซต์ขัดข้องโปรดติดต่อเจ้าหน้าที่')
        //         return false; // Stop execution on error
        //     }
        // });

        // return false; 
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