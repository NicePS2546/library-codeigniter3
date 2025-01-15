<div class="container">
    <div class="col-12 col-sm-6 pb-4 col-md-4 col-lg-6 mt-4 mx-auto">
        <h1>Reserve a Time Slot</h1>
        <form action="<?php echo base_url('index.php/music/reserv/submit'); ?>" method="POST">
            <input type="hidden" name="r_id" value="<?= $r_id ?>">
            <div>
                <label class="form-label" for="st_id">รหัสนักศึกษา</label>
                <input type="text" class="form-control" name="st_id" id="st_id">
            </div>
            <div>
                <label class="form-label" for="total">จำนวนคนเข้าใช้</label>
                <input type="number" class="form-control" name="total" id="total">
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

               if(availableSlots['availableSlots'].length > 0){
                // Add the available slots to the select element
                $.each(availableSlots['availableSlots'], function (index, slot) {
                    timeSlotSelect.append('<option value="' + slot + '">' + slot + '</option>');
                });
            }else{
                reservBtn.prop('disabled',true);
                timeSlotSelect.prop('disabled',true);
                timeSlotSelect.html('<option>ไม่เหลือช่วงเวลาให้จองแล้ว</option>');
            }
            },
            error: function () {
                alert("Error: Unable to fetch data.");
            }
        });
    });
</script>