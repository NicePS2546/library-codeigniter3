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
        transition: opacity 1s ease-in;
    }
</style>

<div class="container">
    <div class="col-12 col-sm-6 pb-4 col-md-4 col-lg-6 mt-4 mx-auto ani-element">
    <?= $this->load->view('admin/reservation/edit/component/title',[],true)?>
        <form class="text-end" action="<?php echo base_url('index.php/admin/room/edit/music'); ?>" id="formId"
            onsubmit="return reserv(event)" method="POST">
            <input type="hidden" name="reserv_id" value="<?= $row['reserv_id'] ?>">
            <?= $this->load->view('admin/reservation/edit/form_content',['row'=>$row],true) ?>

          
           
        </form>
    </div>
</div>


<script src="<?= base_url('public/cdn/jQuery/jquery-3.6.0.min.js') ?>"></script>




<script>

    $(document).ready(async () => {
    try {
        const timeUrl = "<?= site_url("music/time/".$row['r_id']) ?>"; // Ensure this is a valid URL string
        const res = await fetch(timeUrl);

        if (!res.ok) throw new Error("Failed to fetch data");

        const data = await res.json(); // Parse JSON response
        console.log(data);

        const timeSlotSelect = document.getElementById("time_slot");
        const reservBtn = document.getElementById("reservBtn");

        if (data.availableSlots.length > 0) {
            <?php 
            $startTime = date("H:i", strtotime($row['start_time']));
            $expTime = date("H:i", strtotime($row['exp_time']));FF ?>
           
           data.availableSlots.unshift("<?= $startTime .'-'.$expTime ?>");
            // Populate dropdown with available time slots
            console.log(data.availableSlots);
            timeSlotSelect.innerHTML = data.availableSlots
                .map(slot => `<option value="${slot}">${slot}</option>`)
                .join("");
        } else {
            reservBtn.disabled = true;
            timeSlotSelect.disabled = true;
            timeSlotSelect.innerHTML = '<option>ไม่เหลือช่วงเวลาให้จองแล้ว</option>';
        }
    } catch (error) {
        console.error("Error:", error);
        alert("Error: Unable to fetch data.");
    }
});

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


    function reserv(event) {
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


        // if (!query) {
        //     showToast('โปรดใส่รหัสผู้ใช้', 'error');
        //     return false; // Stop execution if input is empty
        // }else if(!total){
        //     showToast('โปรดใส่จำนวนผู้เข้าจอง', 'error');
        //     return false; // Stop execution if input is empty
        // }else if(total <= 4){
        //     showToast('จำนวนผู้เข้าใช้งานต้องไม่น้อยกว่า 4 คน', 'error');
        //     return false; // Stop execution if input is empty
        // }else if(total >= 6){
        //     showToast('จำนวนผู้เข้าใช้งานต้องไม่มากกว่า 6 คน', 'error');
        //     return false; // Stop execution if input is empty
        // }

        if (!query) {
            showSweet('warn','โปรดใส่รหัสผู้ใช้')
            return false; // Stop execution if input is empty
        } else if (!total) {
            showSweet('warn','โปรดใส่จำนวนผู้เข้าจอง')
            return false; // Stop execution if input is empty
        } else if (total < 4) {
            showSweet('warn','จำนวนผู้เข้าใช้งานต้องไม่น้อยกว่า 4 คน')
            return false; // Stop execution if input is empty
        } else if (total > 7) {
            showSweet('warn','จำนวนผู้เข้าใช้งานต้องไม่มากกว่า 7 คน')
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
                    document.getElementById('formId').submit(); // Submit the form
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