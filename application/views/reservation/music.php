<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reservation</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Reserve a Time Slot</h1>

    <form action="<?php echo base_url('reservation/check_availability'); ?>" method="POST">
        <label for="time_slot">Select Time Slot:</label>
        <select name="time_slot" id="time_slot">
            <!-- Available time slots will be populated here -->
        </select>

        <button type="submit">Reserve</button>
    </form>

    <script>
        $(document).ready(function() {
            // Fetch available time slots when the page loads
            $.ajax({
                url: '<?= site_url("music/time/$r_id") ?>',
                type: 'GET',
                success: function(response) {
                    var availableSlots = JSON.parse(response); // Parse the returned JSON data
                    var timeSlotSelect = $('#time_slot');
                    console.log(response);
                    // Clear existing options
                    timeSlotSelect.empty();

                    // Add the available slots to the select element
                    $.each(availableSlots['availableSlots'], function(index, slot) {
                        timeSlotSelect.append('<option value="' + slot + '">' + slot + '</option>');
                    });
                },
                error: function() {
                    alert("Error: Unable to fetch data.");
                }
            });
        });
    </script>

</body>
</html>
