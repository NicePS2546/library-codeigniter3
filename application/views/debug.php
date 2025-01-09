<style>

#debug{
    margin-bottom: 10%;
}



</style>
<?php 
 if (!$this->session->has_userdata('admin_data')) {
    // If no admin session, redirect to homepage
    $this->session->set_flashdata('error', 'คุณไม่มีสิทธิ์ในการเข้าถึงหน้านี้!');
    redirect('/');  // Replace 'home' with the appropriate controller or URL
}else{
    $admin_info = $this->session->userdata['admin_data'];
}


 ?>
<section id="debug" class="container">
    <div>
        <h1>ยินดีต้อนรับ ผู้ดูแล <?= $admin_info['fname']." ". $admin_info['lname']; ?> </h1>
    </div>
    <form action="<?= base_url() ?>index.php/debug/insert" method="post">
        <div>
            <label>debug room</label>
            <select class="form-control" name="room_t">
                <option value="music">Music</option>
                <option value="vdo">VDO</option>
                <option value="mini">Mini</option>
            </select>
        </div>
        <div>
            <label class="form-label" for="room_n">Room Number</label>
            <input id="room_n" type="text" class="form-control" name="room_n" />
        </div>
        <div>
            <label class="form-label" for="room_status">Status</label>
            <select name="room_status" class="form-control" id="room_status">
                <option value="1">True</option>
                <option value="0">False</option>
            </select>
        </div>

        <div>
            <label class="form-label" for="room_d">Room Description</label>
            <textarea class="form-control" id="room_d" type="text" rows="5" cols="10" name="room_d"></textarea>
        </div>
        <button class="btn btn-primary mt-3" type="submit">Submit</button>
    </form>

    <div>
        <h1>Select Room Type</h1>

        <select id="roomType" name="select">
            <option value="">Select Room Type</option>
            <option value="music">Music</option>
            <option value="vdo">Vdo</option>
            <option value="mini">Mini</option>
        </select>

        <h2>Room Details</h2>

        <select id="roomList">
            <option value="">No rooms found for this type.</option>
        </select>
        <button type="button" class="btn btn-danger" id="deleteButton">Delet Select Option</button>

    </div>
    <div id="roomData">
        <!-- Room data will be displayed here after selection -->
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    var roomsData = []; // Store room data globally
    function fetchRoomList(type) {
        if (!type) {
            $('#roomList').html('<option value="">Please select a type first.</option>');
            return;
        }

        // Clear the room list and show a loading message
        $('#roomList').html('<option value="">Loading...</option>');

        // Fetch the room list for the selected type
        $.ajax({
            url: '<?= site_url('debug/room') ?>',
            type: 'POST',
            data: { type: type },
            success: function (response) {
                $('#roomList').html(''); // Clear the dropdown
                roomsData = response;

                if (response.length > 0) {
                    response.forEach(function (room) {
                        $('#roomList').append(
                            '<option value="' +
                            room.r_id +
                            '">' +
                            'ห้องที่ ' +
                            room.r_number +
                            ' คำอธิบาย ' +
                            room.r_desc +
                            '</option>'
                        );
                    });

                    // Display the selected room data
                    $('#roomData').html(
                        `
                        <p><strong>Room Number:</strong> ${response[0].r_number}</p>
                        <p><strong>Status:</strong> ${(response[0].r_status) == 1 ? "True" : "False" }</p>
                 <p><strong>Description:</strong> ${response[0].r_desc}</p>
                 
                 `
                    );

                } else {
                    $('#roomList').html('<option value="">No rooms found for this type.</option>');
                    $('#roomData').html('Room data not found.');
                }
            },
            error: function () {
                alert('Error fetching room data.');
            },
        });
    }

    // Trigger fetching on room type selection
    $('#roomType').change(function () {
        var type = $(this).val(); // Selected room type
        fetchRoomList(type); // Call the fetch function
    });

    $('#roomList').change(function () {
        var selectedRoomId = $(this).val(); // Get selected room ID
        display(selectedRoomId, roomsData);

    });

    function display(selectedRoomId, roomsData) {
        if (!selectedRoomId) {
            $('#roomData').html(''); // Clear current data display if nothing is selected
            return;
        }

        // Find the room data based on selected room ID from the globally stored data
        var selectedRoom = roomsData.find(room => room.r_id == selectedRoomId);
        console.log(selectedRoom);
        if (selectedRoom) {
            // Display the selected room data
            $('#roomData').html(
                `<p><strong>Room Number:</strong> ${selectedRoom.r_number}</p>
                 <p><strong>Status:</strong> ${selectedRoom.r_status == 1 ? "True" : "False" }</p>
                 <p><strong>Description:</strong> ${selectedRoom.r_desc}</p>`
            );
        } else {
            $('#roomData').html('Room data not found.');
        }
    }
    // Example: Trigger fetching manually after a delete operation
    $('#deleteButton').click(function () {
        var selectedRoomId = $('#roomList').val(); // Get selected room ID
        var selectedRoomType = $('#roomType').val(); // Get selected room type

        if (!selectedRoomId || !selectedRoomType) {
            alert('Please select both a room type and a room to delete.');
            return;
        }

        // Confirm deletion
        if (!confirm('Are you sure you want to delete this room?')) {
            return;
        }

        // Send delete request
        $.ajax({
            url: '<?= site_url('debug/delete') ?>',
            type: 'POST',
            data: {
                id: selectedRoomId,
                type: selectedRoomType,
            },
            success: function (response) {
                if (response.success) {
                    alert(response.message);
                    console.log(response.message);
                    // Refresh the room list without reloading the page
                    fetchRoomList(selectedRoomType);
                } else {
                    alert(response.message);
                    console.log(response.message);
                }
            },
            error: function () {
                alert('Error deleting the room.');
            },
        });
    });
</script>

</body>

</html>