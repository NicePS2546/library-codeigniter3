<style>

    .card-body{
        border: 1px solid rgb(214, 214, 214) !important;
    }

</style>

<div class="card card-shadow">
    <div class="card-body">
<div class="text-start">
    <label class="form-label pl-1" for="st_id1">รหัสนักศึกษา</label>
    <input type="text" class="form-control" name="st_id" id="st_id1">
    <div id="result" class="mt-4 mb-2">

    </div>

</div>
<div class="text-start">
    <label class="form-label" for="total">จำนวนคนเข้าใช้</label>
    <input type="number" class="form-control" name="total" id="total">
</div>
<div id="results" class="mt-3">
    <!-- Fetched results will appear here -->
</div>
<div class="text-start">
    <label class="form-label" for="time_slot">เลือกช่วงเวลา:</label>
    <select name="time_slot" class="form-control" id="time_slot">
        <!-- Available time slots will be populated here -->
    </select>
</div>
<button class="btn mt-4 btn-primary" id="reservBtn" type="submit">จอง</button>
</div>
</div>