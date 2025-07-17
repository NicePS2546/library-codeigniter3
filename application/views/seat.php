<style>
    /* Add your provided CSS here */
    .body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .room-container {
        margin: 20px 0;
        width: 90%;
        text-align: center;
    }

    .screen {
        width: 70%;
        height: 40px;
        background: #ccc;
        margin: 20px auto;
        border-radius: 5px;
        text-align: center;
        line-height: 40px;
        color: #333;
    }

    .seat-layout {
        display: grid;
        grid-template-columns: repeat(5, 60px);
        grid-gap: 10px;
        justify-content: center;
    }

    .seat {
        width: 60px;
        height: 60px;
        background-color: #ddd;
        border: 1px solid #bbb;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        display: flex;
        justify-content: center;
        align-items: center;
        user-select: none;
    }

    .seat.selected {
        background-color: #6c63ff;
        color: white;
    }

    .seat.occupied {
        background-color: red;
        cursor: not-allowed;
    }

    .legend {
        margin-top: 20px;
        display: flex;
        justify-content: center;
        gap: 20px;
    }

    .legend div {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .info {
        margin-top: 20px;
        text-align: center;
    }

    .btn {
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #6c63ff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }
</style>

<section class="container">

    <form class="body " onsubmit="return SubmitSeat()">
        <h1>โปรดเลือกที่นั่ง</h1>
       

        <?php

        $data = [
            ['r_number' => 1, 'r_status' => 1, 'r_desc' => "something"],
            ['r_number' => 2, 'r_status' => 1, 'r_desc' => "something"],
            ['r_number' => 3, 'r_status' => 1, 'r_desc' => "something"],
            ['r_number' => 4, 'r_status' => 1, 'r_desc' => "something"],
            ['r_number' => 5, 'r_status' => 1, 'r_desc' => "something"],
            ['r_number' => 6, 'r_status' => 1, 'r_desc' => "something"],
            ['r_number' => 7, 'r_status' => 1, 'r_desc' => "something"],
            ['r_number' => 8, 'r_status' => 1, 'r_desc' => "something"],
            ['r_number' => 9, 'r_status' => 1, 'r_desc' => "something"],
            ['r_number' => 10, 'r_status' => 1, 'r_desc' => "something"],


        ];
        $rooms = $data;

        ?>
        <div class="room-container">


            <div class="seat-layout">
                <?php
                $totalSeats = count($rooms) - 1;
                for ($i = 0; $i <= $totalSeats; $i++):
                    $occupiedSeats = [4, 5, 8, 1]; // Replace with data from DB
                    $isOccupied = in_array($i, $occupiedSeats); // Adjust logic for DB
                    ?>
                    <div id="seat" class="seat <?= $isOccupied ? 'occupied' : ''; ?>"
                        data-seat-number="<?= $rooms[$i]['r_number']; ?>">
                        <?= $rooms[$i]['r_number'] ?>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
        <div class="legend">
            <div>
                <div class="seat"></div> ห้องที่ว่าง
            </div>
            <div>
                <div class="seat selected"></div> กำลังเลือก
            </div>
            <div>
                <div class="seat occupied"></div> จองแล้ว
            </div>
        </div>
        <div class="info">
            <p><strong>ห้องที่กำลังเลือก:</strong> <span id="selected-seat">ไม่ได้เลือก</span></p>
        </div>
        <button class="btn" id="book-seats">Book Seats</button>
    </form>
</section>
<script>
    const seatLayout = document.querySelector('.seat-layout');
    const selectedSeatDisplay = document.getElementById('selected-seat');

    // Keep track of the selected seat
    let selectedSeat = null;

    // Seat selection handler
    seatLayout.addEventListener('click', (e) => {
        // Ensure we're clicking on a valid seat
        if (!e.target.classList.contains('seat') || e.target.classList.contains('occupied')) return;

        const seatNumber = parseInt(e.target.dataset.seatNumber);

        // If we clicked on the previously selected seat, deselect it
        if (selectedSeat === seatNumber) {
            document.querySelector(`.seat[data-seat-number="${selectedSeat}"]`).classList.remove('selected');
            selectedSeat = null; // Deselect
        } else {
            // Deselect the previously selected seat if any
            if (selectedSeat !== null) {
                document.querySelector(`.seat[data-seat-number="${selectedSeat}"]`).classList.remove('selected');
            }

            // Select the new seat
            e.target.classList.add('selected');
            selectedSeat = seatNumber;
        }

        // Update the display
        selectedSeatDisplay.textContent = selectedSeat ? selectedSeat : "ไม่ได้เลือกห้อง";
    });

    // Book seat button handler
    function SubmitSeat() {
        if (!selectedSeat) {
            alert('No seat selected!');
            return false;
        } else {
            alert(`You have booked seat number: ${selectedSeat}`);
            const seat = document.querySelector(`.seat[data-seat-number="${selectedSeat}"]`);
            seat.classList.remove('selected');
            seat.classList.add('occupied');
            selectedSeat = null;
            selectedSeatDisplay.textContent = "None";
            return true;
        }
    }

</script>