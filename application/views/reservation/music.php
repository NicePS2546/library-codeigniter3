<style>



</style>

<div class="container">
    <div class="col-12 col-sm-6 pb-4 col-md-4 col-lg-6 mt-4 mx-auto">
        <h1>Reserve a Time Slot</h1>
        <form action="<?php echo base_url('index.php/music/reserv/submit'); ?>" id="formId"
            onsubmit="return Submit(event)" method="POST">
            <input type="hidden" name="r_id" value="<?= $r_id ?>">
            <div>
                <label class="form-label" for="st_id">รหัสนักศึกษา</label>
                <input type="text" class="form-control" name="st_id" id="st_id1">
                <div id="result" class="mt-4 mb-2">



                </div>

            </div>
            <div>
                <label class="form-label" for="total">จำนวนคนเข้าใช้</label>
                <input type="number" class="form-control" name="total" id="total">
            </div>
            <div id="results" class="mt-3">
                <!-- Fetched results will appear here -->
            </div>
            <div>
                <label class="form-label" for="time_slot">Select Time Slot:</label>
                <select name="time_slot" class="form-control" id="time_slot">
                    <!-- Available time slots will be populated here -->
                </select>
            </div>

            <button class="btn mt-4 btn-primary" id="reservBtn" type="submit">Reserve</button>
            <div id="roomData">
                <!-- Room data will be displayed here after selection -->
            </div>
        </form>
    </div>
</div>

<div id="toast-container" class="position-fixed bottom-0 end-0 p-3" style="z-index: 11;">
    <div id="liveToast" class="toast hide custom-toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="<?= base_url('public/assets/img/logo.png') ?>" width="50" height="50" class="rounded me-2"
                alt="...">
            <strong class="me-auto">แจ้งเตือน</strong>
            <small>ณ ขณะนี้</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <!-- Flash data message will be dynamically inserted -->
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>





<script>
    $(document).ready(function () {

        // Fetch available time slots when the page loads
        $.ajax({
            url: '<?= site_url("music/time/$r_id") ?>',
            type: 'GET',
            success: function (response) {
                var availableSlots = JSON.parse(response); // Parse the returned JSON data
                var timeSlotSelect = $('#time_slot');
                var reservBtn = $('#reservBtn');
                console.log(response);
                // Clear existing options
                timeSlotSelect.empty();

                if (availableSlots['availableSlots'].length > 0) {
                    // Add the available slots to the select element
                    $.each(availableSlots['availableSlots'], function (index, slot) {
                        timeSlotSelect.append('<option value="' + slot + '">' + slot + '</option>');
                    });
                } else {
                    reservBtn.prop('disabled', true);
                    timeSlotSelect.prop('disabled', true);
                    timeSlotSelect.html('<option>ไม่เหลือช่วงเวลาให้จองแล้ว</option>');
                }
            },
            error: function () {
                alert("Error: Unable to fetch data.");
            }
        });
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
                    data: { uid: query },
                    success: function (response) {
                        // Parse the JSON response
                        const data = JSON.parse(response);
                        const results = data.userdata;
                        let output = '';

                        // Check the message from the API response
                        if (data.message == "Success") {
                            // Display the full name if successful
                            output = `<p class="card border-success py-2 px-2 w-50 text-center">${results.fullname}</p>`;
                        } else if (data.message == "fail") {
                            // Show message if no results
                            output = '<div class="card border-danger text-center py-2 px-2 w-50"><div>ไม่เจอผู้ใช้ในระบบ <a href="#">สมัครตรงนี้</a></div></div>';
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


    function Submit(event) {
        event.preventDefault(); // Prevent default form submission

        const query = $('#st_id1').val(); // Get input value

        if (!query) {

            showToast('โปรดใส่รหัสผู้ใช้', 'error');
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

                    showToast('ไม่พบผู้ใช้งาน', 'error'); // Show error toast
                    return false; // Stop execution if validation fails
                }


                
                showToast('กำลังดำเนินการ....', 'success');
                setTimeout(function () {
                    document.getElementById('formId').submit(); // Submit the form
                }, 800); // Wait 2 seconds (2000ms)
            },
            error: function () {


                showToast('เว็บไซต์ขัดข้องโปรดติดต่อเจ้าหน้าที่', 'error');
                return false; // Stop execution on error
            }
        });

        return false; // Prevent default submission until AJAX completes
    }

</script>
<script>

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