<form>
    <input type="hidden" name="r_id" value="<?= $r_id ?>">
    <div class="container d-flex justify-content-center">
    <div class="col-12 col-sm-6 col-md-4 col-lg-5">
        <div class="">
            <label>รหัสนักศึกษา</label>
            <input placeholder="โปรดใส่รหัสนักศึกษาคนแรก" type="text" class="form-control">
        </div>

        <div class="">
            <label>จำนวณคนที่เข้าใช้ห้อง</label>
            <input type="number" class="form-control">
        </div>

        <div class="form-group">
            <label for="datetime">เลือกวันที่และเวลาที่ต้องการจะจอง</label>
            <input type="text" class="form-control" id="datetime" name="datetime" placeholder="โปรดเลือกเวลาที่จอง">
        </div>
        <button onclick="console_date()" class="btn mt-4 btn-primary" type="button">Console Time</button>
    </div>
    </div>



</form>

<script>
    function console_date() {

        var selectedDateTime = document.getElementById('datetime').value;
        
        fetch('<?= base_url() ?>debug/time', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'date_time=' + encodeURIComponent(selectedDateTime)  // Sending the datetime value to PHP
        })
            .then(response => response.json())  // You can also use .json() if you're expecting JSON response
            .then(data => {
                console.log('Response from PHP: ' , data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>